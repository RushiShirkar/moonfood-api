<?php

namespace fashiostreet\product;
use FS_Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{

    public function sendAppLink(Request $request)
    {
        //return FS_Response::success('Link send to your entered mobile number');
        $message = "Moonfood App Download Link: https://play.google.com/store/apps/details?id=in.moonfood.android";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=Fashio&route=4&mobiles=".$request->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=".$message,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $this->json_success('Link Send to your Entered mobile number');
    }

    /*
        Get city name to city search suggestion box
    */
    public function city_search(Request $request)
    {
        if(!isset($request->q))
        {
            return $this->json_error('Invalid URL found');
        }
        if($request->q == null || trim($request->q) == "" || empty($request->q))
        {
            return $this->json_success('');
        }
        try {
            $result = DB::table('city')->select(['name'])->where('name', 'like', $request->q . '%')->take(7)->get();
            if (count($result) > 0) {
                return $this->json_success($result);
            }
            else {
                $request->q = substr($request->q, 0, 3);
                $result = DB::table('city')->select(['name'])->where('name', 'like', $request->q . '%')->take(7)->get();
                if (count($result) > 0) {
                    return $this->json_success($result);
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->json_error($e->getMessage());
        }
        return $this->json_success('No Result Found');
    }


    /*
     * error json private function
     * */
    private function json_error($error)
    {
        return response()->json($error,500);
    }

    /*
     * success json private function
     * */

    private function json_success($message)
    {
        return response()->json($message,200);
    }


    public function allCustomerMsg(Request $request)
    {
        $customers = DB::select('select id,mobile from customer');
        $curl = curl_init();
        for($i=0;$i<count($customers);$i++)
        {
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=Fashio&route=4&mobiles=".$customers[$i]->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=".$request->message,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
        }
        curl_close($curl);
        return FS_Response::success('message','Sent successfully');
    }

    public function hdCartMsg(Request $request)
    {
        $customers = DB::select('select id,mobile from customer');
        $curl = curl_init();
        for($i=0;$i<count($customers);$i++)
        {
            $count = DB::select('select id from cart where deleted_at is NULL and users_id = ?',[$customers[$i]->id]);
            if(count($count)>0)
            {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=Fashio&route=4&mobiles=".$customers[$i]->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Fashiostreet :%0aYou have ".count($count)." item in your Delivery Bag.%0aWe advice you to buy before someone else buy's because shopkeeper usually has only 1 Qty in every product.%0aSo, Hurry! Shop Now: http://bit.ly/fashiostreet-app",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
            }
            $count = null;
        }
        curl_close($curl);
        return FS_Response::success('message','Sent successfully');
    }

    public function wishlistMsg(Request $request)
    {
        $customers = DB::select('select id,mobile from customer');
        $curl = curl_init();
        for($i=0;$i<count($customers);$i++)
        {
            $count = DB::select('select id from wishlist where deleted_at is NULL and users_id = ?',[$customers[$i]->id]);
            if(count($count)>0)
            {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=Fashio&route=4&mobiles=".$customers[$i]->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Fashiostreet :%0aYou have ".count($count)." item in your Wishlist.%0aWe advice you to buy before someone else buy's because shopkeeper mostly has only 1 Qty in every product.%0aSo, Hurry! Shop Now: http://bit.ly/fashiostreet-app",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
            }
            $count = null;
        }
        curl_close($curl);
        return FS_Response::success('message','Sent successfully');
    }

    public function visitShopMsg(Request $request)
    {
        $customers = DB::select('select number,shop_id from visit_shop where created_at>= CURDATE()-3 and created_at<CURDATE()');
        $curl = curl_init();
        for($i=0;$i<count($customers);$i++)
        {
            $shop_name = DB::select('select name from shop where id = ?',[$customers[$i]->shop_id]);
            curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=Fashio&route=4&mobiles=".$customers[$i]->number."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Fashiostreet :%0aHey, This is a reminder that you were about to visit ".$shop_name[0]->name." shop in this week.%0aHurry, because shopkeeper mostly have only 1 Qty in every product.",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                $shop_name = null;
        }
        curl_close($curl);
        return FS_Response::success('message','Sent successfully');
    }

    public function callMsg(Request $request)
    {
        $customers = DB::select('select mobile,shop_id from user_actions where (phone=1 or chat=1 or whatsapp=1) and created_at>= CURDATE()-1 and created_at<CURDATE()');
        $curl = curl_init();
        for($i=0;$i<count($customers);$i++)
        {
            $shop_name = DB::select('select name from shop where id = ?',[$customers[$i]->shop_id]);
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=Fashio&route=4&mobiles=".$customers[$i]->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Fashiostreet :%0aHey, you tried to contact ".$shop_name[0]->name." shop.%0aDid you get the information that you wanted?%0aIf not, feel free to whatsapp us: http://bit.ly/fashiostreet-chat",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $shop_name = null;
        }
        curl_close($curl);
        return FS_Response::success('message','Sent successfully');
    }

    public function walletMsg(Request $request)
    {
        $customers = DB::select('select customer_id,money from customer_wallet');
        $curl = curl_init();
        $mobile = 1;
        $a = null;
        for($i=0;$i<count($customers);$i++)
        {
            $a = $customers[$i]->customer_id;
            $mobile = DB::select('select mobile from customer where id = ?',[$a]);
            if($customers[$i]->money > 0)
            {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=Fashio&route=4&mobiles=".$mobile[$i]->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Fashiostreet :%0aYour money of Rs.".$customers[$i]->money." is getting bored in FS wallet.%0aShop now using your wallet money to get more off.%0aHurry! Shop Now: http://bit.ly/fashiostreet-app",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
            }
            else
            {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=Fashio&route=4&mobiles=".$mobile[$i]->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Fashiostreet :%0aHey, your FS wallet looks empty.%0aNow, Get extra 5% cashback on every shopping.%0aShop more !! Get more !!.%0aHurry! Shop Now: http://bit.ly/fashiostreet-app",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
            }
            $mobile = null;
            $a = null;
        }
        curl_close($curl);
        return FS_Response::success('data',$customers);
    }

    public function getAllOrders(Request $request)
    {
        $orders = DB::select('select * from orders order by id desc');
        for($i=0;$i<count($orders);$i++)
        {
            $orders[$i]->products = DB::select('select * from productordered where orders_id=?',[$orders[$i]->id]);
            for($j=0;$j<count($orders[$i]->products);$j++)
            {
                $orders[$i]->products[$j]->image = DB::select('select name,image from product where id = ?',[$orders[$i]->products[$j]->product_id]);
                $orders[$i]->products[$j]->image = $orders[$i]->products[$j]->image[0]->image;
                $orders[$i]->products[$j]->image = explode(',',$orders[$i]->products[$j]->image);
                for($k=0;$k < count($orders[$i]->products[$j]->image) ;$k++)
                {
                    $orders[$i]->products[$j]->image[$k] = env('IMAGE_URL','https://seller.fashiostreet.com').'/products/compress220X258/'.$orders[$i]->products[$j]->image[$k];
                }
                $orders[$i]->products[$j]->image = array_reverse($orders[$i]->products[$j]->image);
                $orders[$i]->products[$j]->size_name = DB::select('select name from size where id = ?',[$orders[$i]->products[$j]->size_id]);
                $orders[$i]->products[$j]->shop_name = DB::select('select name from shop where id = ?',[$orders[$i]->products[$j]->shop_id]);
                $name = DB::select('select name from product where id = ?',[$orders[$i]->products[$j]->product_id]);
                $orders[$i]->products[$j]->name = $name[0]->name;
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$orders[$i]->products[$j]->product_id]);
                /*$check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                if(count($check)>0)
                {
                    $orders[$i]->products[$j]->specialDiscount = true;
                    $orders[$i]->products[$j]->specialDiscountedPrice = $orders[$i]->products[$j]->mrp_price - (($orders[$i]->products[$j]->mrp_price*$check[0]->discount)/100);
                    $orders[$i]->products[$j]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $orders[$i]->products[$j]->specialDiscount = false;
                }
                $info = null;
                $check = null;*/
            }
        }
        $data = array(
            'orders' => $orders
        );
        return FS_Response::success('data',$data);
    }

    public function cancelledOrder(Request $request)
    {
        $status = DB::select('select completed,contact,cashback from orders where id = ?',[$request->order_id]);
        $qty1 = null;
        if($status[0]->completed != 2)
        {
            DB::table('orders')
             ->where('id',$request->order_id)
             ->update([
                'completed' => 2,
                'completed_at' => Carbon::now()
            ]);
            $products = DB::select('select product_id,size_id from productordered where orders_id=?',[$request->order_id]);
            for($i=0;$i<count($products);$i++)
            {
                $qty = DB::select('select qty,deleted_at from product_size where product_id = ? and size_id = ?',[$products[$i]->product_id,$products[$i]->size_id]);
                if($qty[0]->deleted_at==NULL)
                    $qty1 = $qty[0]->qty + 1;
                else
                    $qty1 = 1;
                DB::table('product_size')
                 ->where('product_id',$products[$i]->product_id)
                 ->where('size_id',$products[$i]->size_id)
                 ->update([
                    'qty' => $qty1,
                    'deleted_at' => NULL
                ]);
            }
            DB::table('productordered')
                ->where('orders_id',$request->order_id)
                ->update([
                    'deleted_at' => Carbon::now()
            ]);
            //$customer_id = DB::select('select id from customer where mobile = ?',[$status[0]->contact]);
            //$money = DB::select('select money from customer_wallet where customer_id = ?',[$customer_id[0]->id]);
            /*$wallet = 
            
            if($wallet<0)*/
            //$wallet = 0.3;
            /*$wallet = 5;
            DB::table('customer_wallet')
                ->where('customer_id',$customer_id[0]->id)
                ->update([
                    'money' => $wallet
            ]);*/
            return FS_Response::success('message','Cancelled successfully');
        }
        return FS_Response::success('message','Already Cancelled');
    }

    public function restockProduct(Request $request)
    {
        $size_id = DB::select('select id from size where name = ?',[$request->size_name]);
        DB::table('productordered')
            ->where('orders_id',$request->order_id)
            ->where('product_id',$request->product_id)
            ->where('size_id',$size_id[0]->id)
            ->delete();
        $qty = DB::select('select qty,deleted_at from product_size where product_id = ? and size_id = ?',[$request->product_id,$size_id[0]->id]);
        if($qty[0]->deleted_at==NULL)
            $qty = $qty[0]->qty + 1;
        else
            $qty = 1;
        DB::table('product_size')
            ->where('product_id',$request->product_id)
            ->where('size_id',$size_id[0]->id)
            ->update([
                'qty' => $qty,
                'deleted_at' => NULL
            ]);
        $status = DB::select('select deleted_at from product where id = ?',[$request->product_id]);
        if($status[0]->deleted_at==NULL)
        {

        }
        else
        {
            DB::table('product')
                ->where('id',$request->product_id)
                ->update([
                    'deleted_at' => NULL
                ]);
        }
        return FS_Response::success('message','Product Restock successfully');
    }

    public function deliveryMessage(Request $request)
    {
        $status = DB::select('select completed,contact from orders where id = ?',[$request->order_id]);
        if($status[0]->completed != 1)
        {
            DB::table('orders')
            ->where('id',$request->order_id)
            ->update([
                'completed' => 1,
                'completed_at' => Carbon::now()
            ]);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=Fashio&route=4&mobiles=".$status[0]->contact."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Your order has been delivered successfully.%0aThanks for shopping from Shop: ".$request->shop_name.", Kolhapur.%0a%0aRate Fashiostreet on Play store :%0ahttps://bit.ly/2v3hD8b%0a- Team Fashiostreet",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return FS_Response::success('message','Delivered successfully');
        }
        return FS_Response::success('message','Already delivered');
    }
}