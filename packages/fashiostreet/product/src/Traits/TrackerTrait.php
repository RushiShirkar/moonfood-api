<?php
namespace fashiostreet\product\Traits;
use fashiostreet\product\Exceptions\SystemException;
use Illuminate\Support\Facades\DB;

trait TrackerTrait{
    public function getSelectedProduct($order_id)
    {
        $product = (array) DB::select('CALL GetOrderedProduct(?,?,?)',[$order_id,0,30]);
		for($i=0;$i < count($product);$i++)
		{
			$image = explode(",",$product[$i]->image);
            $size = count($image);
			$image = 'https://seller.fashiostreet.com/products/compress220X258/'.$image[$size-1];
			$product[$i]->image = $image;
			unset($image);
            $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$product[$i]->product_id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($product[$i]->mrp_price - $product[$i]->selling_price)/$product[$i]->mrp_price)*100;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $product[$i]->specialDiscount = true;
                    $product[$i]->specialDiscountedPrice = $product[$i]->mrp_price - (($product[$i]->mrp_price*$check[0]->discount)/100);
                    $product[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $product[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
		}
        if(count($product) <= 0)
        {
            throw new SystemException('No product found at order');
        }
        return $product;
    }
}