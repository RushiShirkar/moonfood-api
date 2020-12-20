<?php
namespace fashiostreet\product\Traits;
use Carbon\Carbon;
use fashiostreet\product\Exceptions\ErrorException;
use fashiostreet\product\Exceptions\SystemException;
use fashiostreet\product\orders;
use fashiostreet\product\ProductController;
use fashiostreet\product\ProductOrdered;
use Illuminate\Support\Facades\DB;

trait OrderTrait{
    protected function getOrders($user_id,$startFrom,$paginate){
        return orders::select(['id as order_id','completed as status','customer_name','cashback','promocode','try_buy','address','contact','completed_at','created_at'])
                    ->where('customer_id',$user_id)
                    ->take($paginate)
                    ->offset($startFrom)
                    ->get();
    }
    protected function ChangeOrderStatus($order_id,$user_id)
    {
        $order = orders::where('customer_id',$user_id)
                        ->where('id',$order_id)
                        ->update([
                            'completed' => 2,
                            'completed_at' => Carbon::now()
                        ]);
        if($order <= 0 || $order == false || $order == null)
        {
            throw new SystemException('failed to update order status');
        }
        return true;
    }

    protected function createOrderData($request)
    {

    }
    protected function createOrderProductsData($order_id,$user_id)
    {
            $productData = (array) DB::select('SELECT cart.product_id as product_id,cart.size_id as size_id,product.shop_id as shop_id,product.mrp_price as mrp_price,product.selling_price as selling_price,cart.qty as qty from cart left join product ON product.id = cart.product_id where users_id = ? and cart.deleted_at IS NULL',[$user_id]);
            if(count($productData) > 0) {
                for ($i = 0; $i < count($productData); $i++) 
                 {
                    $this->addProductsToOrder($productData[$i], $order_id);
                    $obj = new ProductController();
                    $obj->decreaseProductSizeQty($productData[$i]->product_id, $productData[$i]->size_id);
		          //$obj->deleteProduct($productData[$i]->product_id);
                }
                return true;
            }
        throw new SystemException('failed to placed order,no product inside cart');
    }
    protected function addProductsToOrder($productsData,$order_id){

            $orderProduct = new ProductOrdered();
            $orderProduct->product_id = $productsData->product_id;
            $orderProduct->shop_id = $productsData->shop_id;
            $orderProduct->size_id = $productsData->size_id;
            $orderProduct->orders_id = $order_id;
            $orderProduct->qty = $productsData->qty;
            $orderProduct->mrp_price = $productsData->mrp_price;
            $orderProduct->selling_price = $productsData->selling_price;
            $orderProduct->save();
            return true;

    }
    protected function createOrder($orderData,$order_id)
    {
            $order = new orders();
            $order->customer_id = $order_id;
            $order->customer_name = $orderData->customer_name;
            $order->address = $orderData->address;
            $order->contact = $orderData->contact;
            $order->promocode = $orderData->promocode;
            $order->try_buy = $orderData->try_buy;
            $order->save();
            return $order;
    }
    protected function withError($callback)
    {
        try
        {
            $callback();
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            throw new ErrorException('Server error found '.$e->getCode());
        }
    }
}
