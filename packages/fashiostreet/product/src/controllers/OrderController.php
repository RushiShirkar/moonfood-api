<?php
namespace fashiostreet\product;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use fashiostreet\product\Auth\User;
use fashiostreet\product\Traits\OrderTrait;
use fashiostreet\product\Traits\TrackerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use FS_Response;

class OrderController extends Controller {
    use OrderTrait,TrackerTrait;
    protected $user_id;

    function __construct(Request $request)
    {
        $obj = new User();
        $this->user_id = $obj->getUserId($request);
    }

    /*
     * @param
     * address_id
     * product[{product_id,size_id,qty}]
     * @return
     * message
     * */
    public function usersOrders(Request $request,$mobile)
    {
        $user_id = DB::select('select id from customer where mobile = ?',[$mobile]);
        $users_order = DB::select('select * from moonfood_order where customer_id = ? order by id DESC LIMIT 4',[$user_id[0]->id]);
        $ordersData = array();
        for($i=0;$i < count($users_order);$i++)
        {
            $menus = DB::select('select * from orderedmenu where order_id = ?',[$users_order[$i]->id]);
            for($j=0;$j<count($menus);$j++)
            {
                if($menus[$j]->menu_id==1)
                {
                    $menus[$j]->name = 'Fried Maggi';
                    $menus[$j]->price = 16;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0.8;
                }
                else if($menus[$j]->menu_id==2)
                {
                    $menus[$j]->name = 'Double Bread Omlette';
                    $menus[$j]->price = 14;
                    $menus[$j]->packaging = 0.9;
                }
                else if($menus[$j]->menu_id==3)
                {
                    $menus[$j]->name = 'Olee Bhel';
                    $menus[$j]->price = 16;
                    $menus[$j]->packaging = 0.6;
                }
                else if($menus[$j]->menu_id==4)
                {
                    $menus[$j]->name = 'Suki Bhel';
                    $menus[$j]->price = 25;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==5)
                {
                    $menus[$j]->name = 'Bread Chilla';
                    $menus[$j]->price = 14;
                    $menus[$j]->packaging = 0.9;
                }
                else if($menus[$j]->menu_id==6)
                {
                    $menus[$j]->name = 'Double Egg Burji';
                    $menus[$j]->price = 30;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 2.9;
                }
                else if($menus[$j]->menu_id==7)
                {
                    $menus[$j]->name = 'Bread';
                    $menus[$j]->price = 2;
                    $menus[$j]->packaging = 0.7;
                }
                else if($menus[$j]->menu_id==8)
                {
                    $menus[$j]->name = 'Ketchup';
                    $menus[$j]->price = 2;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==9)
                {
                    $menus[$j]->name = 'Shev';
                    $menus[$j]->price = 2;
                    $menus[$j]->packaging = 0.25;
                }
                else if($menus[$j]->menu_id==10)
                {
                    $menus[$j]->name = 'Bhel Combo';
                    $menus[$j]->price = 60;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==11)
                {
                    $menus[$j]->name = 'Double Egg Bhurji Combo';
                    $menus[$j]->price = 75;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==12)
                {
                    $menus[$j]->name = 'Fried Maggi Combo';
                    $menus[$j]->price = 70;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==13)
                {
                    $menus[$j]->name = 'Double Bread Omlette Combo';
                    $menus[$j]->price = 55;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==14)
                {
                    $menus[$j]->name = 'Boiled Eggs';
                    $menus[$j]->price = 14;
                    $menus[$j]->packaging = 1.1;
                }
                else if($menus[$j]->menu_id==15)
                {
                    $menus[$j]->name = 'Mix Veg Roll';
                    $menus[$j]->price = 31;
                    $menus[$j]->packaging = 0.7;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                }
                else if($menus[$j]->menu_id==16)
                {
                    $menus[$j]->name = 'Paneer Masala Roll';
                    $menus[$j]->price = 42;
                    $menus[$j]->packaging = 0.7;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                }
                else if($menus[$j]->menu_id==17)
                {
                    $menus[$j]->name = 'Single Omlette Roll';
                    $menus[$j]->price = 29;
                    $menus[$j]->packaging = 0.7;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                }
                else if($menus[$j]->menu_id==18)
                {
                    $menus[$j]->name = 'Double Omlette Roll';
                    $menus[$j]->price = 35;
                    $menus[$j]->packaging = 0.7;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                }
                else if($menus[$j]->menu_id==19)
                {
                    $menus[$j]->name = 'Chicken Masala Roll';
                    $menus[$j]->price = 45;
                    $menus[$j]->packaging = 0.7;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                }
                else if($menus[$j]->menu_id==20)
                {
                    $menus[$j]->name = 'Single Omlette Chicken Masala Roll';
                    $menus[$j]->price = 52;
                    $menus[$j]->packaging = 0.7;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                }
                else if($menus[$j]->menu_id==21)
                {
                    $menus[$j]->name = 'Double Omlette Chicken Masala Roll';
                    $menus[$j]->price = 60;
                    $menus[$j]->packaging = 0.7;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                }
                else if($menus[$j]->menu_id==22)
                {
                    $menus[$j]->name = 'Coca-Cola';
                    $menus[$j]->price = 20;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==23)
                {
                    $menus[$j]->name = 'Thums Up';
                    $menus[$j]->price = 20;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==24)
                {
                    $menus[$j]->name = 'Soupy Maggi';
                    $menus[$j]->price = 13;
                    $menus[$j]->packaging = 1;
                }
                else if($menus[$j]->menu_id==25)
                {
                    $menus[$j]->name = 'Sprite';
                    $menus[$j]->price = 20;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==26)
                {
                    $menus[$j]->name = 'Chicken Masala Roll + Thums Up';
                    $menus[$j]->price = 70;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==27)
                {
                    $menus[$j]->name = 'Chicken Masala Roll + Sprite';
                    $menus[$j]->price = 70;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==28)
                {
                    $menus[$j]->name = 'Paneer Masala Roll + Thums Up';
                    $menus[$j]->price = 65;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==29)
                {
                    $menus[$j]->name = 'Paneer Masala Roll + Sprite';
                    $menus[$j]->price = 65;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==30)
                {
                    $menus[$j]->name = 'Double Egg Bhurji + Thums Up';
                    $menus[$j]->price = 55;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==31)
                {
                    $menus[$j]->name = 'Double Egg Bhurji + Sprite';
                    $menus[$j]->price = 55;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==32)
                {
                    $menus[$j]->name = 'Veg Jumbo Sandwich';
                    $menus[$j]->price = 30;
                    $menus[$j]->packaging = 1.1;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                }
                else if($menus[$j]->menu_id==33)
                {
                    $menus[$j]->name = 'Veg Mini Grilled Sandwich';
                    $menus[$j]->price = 30;
                    $menus[$j]->packaging = 1.1;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                }
                else if($menus[$j]->menu_id==34)
                {
                    $menus[$j]->name = 'French Fries';
                    $menus[$j]->price = 32;
                    $menus[$j]->packaging = 1.7;
                }
                else if($menus[$j]->menu_id==35)
                {
                    $menus[$j]->name = 'Masala French Fries';
                    $menus[$j]->price = 42;
                    $menus[$j]->packaging = 1.7;
                }
                else if($menus[$j]->menu_id==36)
                {
                    $menus[$j]->name = 'Peri Peri French Fries';
                    $menus[$j]->price = 37;
                    $menus[$j]->packaging = 1.7;
                }
                else if($menus[$j]->menu_id==37)
                {
                    $menus[$j]->name = 'Veg Jumbo Sandwich + French Fries';
                    $menus[$j]->price = 60;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==38)
                {
                    $menus[$j]->name = 'Veg Mini Grilled Sandwich + French Fries';
                    $menus[$j]->price = 60;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else
                {

                }
            }
            $tmp_data = array(
                'order_id' => $users_order[$i]->id,
                'address' => $users_order[$i]->address,
                'completed' => $users_order[$i]->completed,
                'rating' => $users_order[$i]->rating,
                'created_at' => $users_order[$i]->created_at,
                'offerApplied' => $users_order[$i]->offerApplied,
                'deliveryCharge' => $users_order[$i]->deliveryCharge,
                'payment_type' => $users_order[$i]->payment_type,
                'carryBag' => $users_order[$i]->carryBag,
                'tissue' => $users_order[$i]->tissue,
                'status' => $users_order[$i]->status,
                'coupon_id' => $users_order[$i]->coupon_id,
                'menus' => $menus 
            );
            array_push($ordersData,$tmp_data);
            unset($tmp_data);
            unset($menus);
        }
        return FS_Response::success('data',$ordersData);
    }

    public function cancelUserOrder(Request $request)
    {
        DB::table('moonfood_order')
            ->where('id',$request->order_id)
            ->update([
                'completed' => 2,
                'completed_at' => Carbon::now()
        ]);
        /*$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=MFORDR&route=4&mobiles=8600198512,7558417359,7767838215&authkey=301978ABd7ytk7T5dbe6f46&country=91&message=Moonfood order number ".$request->order_id." has been Cancelled by the user.",
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

        curl_close($curl);*/
        return FS_Response::success('message','Order Cancelled');
    }

    public function addOrder(Request $request)
    {
        $user_id = DB::select('select * from customer where mobile=?',[$request->contact]);
        $offerApplied = null;
        if($request->offerApplied=='false')
        {
            $offerApplied = null;
        }
        else if($request->offerApplied=='true')
        {
            $offerApplied = 1;
        }
        $deliveryCharge = null;
        if($request->deliveryCharge==1)
        {
            $deliveryCharge = 1;
        }
        $carryBag = null;
        if($request->carryBag=='true')
        {
            $carryBag = 1;
        }
        $tissue = null;
        if($request->tissue=='true')
        {
            $tissue = 1;
        }
        DB::table('moonfood_order')->insert([
            'customer_id' => $user_id[0]->id,
            'contact' => $request->contact,
            'address' => $request->address,
            'area' => $request->area,
            'created_at' => Carbon::now(),
            'offerApplied' => $offerApplied,  
            'deliveryCharge' => $deliveryCharge, 
            'payment_type' => $request->payment_type, 
            'carryBag' => $carryBag,
            'tissue' => $tissue,
            'status' => 1,
            'coupon_id' => $request->coupon_id,
            'completed' => 0
            ]);
        $order_id = DB::select('select * from moonfood_order where customer_id = ? order by id DESC',[$user_id[0]->id]);
        $productData = (array) DB::select('SELECT moonfood_cart.menu_id as menu_id,moonfood_cart.qty as qty,cheese,spoon from moonfood_cart where users_id = ? and moonfood_cart.deleted_at IS NULL',[$user_id[0]->id]);
        if(count($productData) > 0) 
        {
            for ($i = 0; $i < count($productData); $i++) 
            {
                DB::table('orderedmenu')->insert([
                'order_id' => $order_id[0]->id,
                'menu_id' => $productData[$i]->menu_id,
                'qty' => $productData[$i]->qty,
                'cheese' => $productData[$i]->cheese,
                'spoon' => $productData[$i]->spoon,
                'created_at' => Carbon::now()
                ]);
            }
        }
        $discount = null;
        if($request->offerApplied!=null)
        {
            if($user_id[0]->discount>1)
            {
                $discount = $user_id[0]->discount - 1;
            }
            if($user_id[0]->discount==1)
            {
                $discount = null;
            }
        }
        else
        {
            $discount = $user_id[0]->discount;
        }
        DB::table('customer')
            ->where('id',$user_id[0]->id)
            ->update([
                'discount' => $discount
            ]);
            DB::table('coupons')
            ->where('mobile',$request->contact)
            ->where('code',$request->coupon_code)
            ->where('coupon_id',$request->coupon_id)
            ->update([
                'deleted_at' => Carbon::now()
            ]);
        $cartDeletedProduct = DB::table('moonfood_cart')
            ->where('users_id',$user_id[0]->id)
            ->update([
                'deleted_at' => Carbon::now()
            ]);
        $msg = '';    
        $name = null;
        for ($i = 0; $i < count($productData); $i++) 
        {
            if($productData[$i]->menu_id==1)
                {
                    $name = 'Fried Maggi';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==2)
                {
                    $name = 'Double Bread Omlette';
                }
                else if($productData[$i]->menu_id==3)
                {
                    $name = 'Olee Bhel';
                }
                else if($productData[$i]->menu_id==4)
                {
                    $name = 'Suki Bhel';
                }
                else if($productData[$i]->menu_id==5)
                {
                    $name = 'Bread Chilla';
                }
                else if($productData[$i]->menu_id==6)
                {
                    $name = 'Double Egg Burji';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==7)
                {
                    $name = 'Bread';
                }
                else if($productData[$i]->menu_id==8)
                {
                    $name = 'Ketchup';
                }
                else if($productData[$i]->menu_id==9)
                {
                    $name = 'Shev';
                }
                else if($productData[$i]->menu_id==10)
                {
                    $name = 'Bhel Combo';
                }
                else if($productData[$i]->menu_id==11)
                {
                    $name = 'Double Egg Bhurji Combo';
                }
                else if($productData[$i]->menu_id==12)
                {
                    $name = 'Fried Maggi Combo';
                }
                else if($productData[$i]->menu_id==13)
                {
                    $name = 'Double Bread Omlette Combo';
                }
                else if($productData[$i]->menu_id==14)
                {
                    $name = 'Boiled Eggs';
                }
                else if($productData[$i]->menu_id==15)
                {
                    $name = 'Mixed Veg Roll';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==16)
                {
                    $name = 'Paneer Masala Roll';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==17)
                {
                    $name = 'Single Omlette Roll';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==18)
                {
                    $name = 'Double Omlette Roll';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==19)
                {
                    $name = 'Chicken Masala Roll';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==20)
                {
                    $name = 'Single Omlette Chicken Masala Roll';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==21)
                {
                    $name = 'Double Omlette Chicken Masala Roll';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==22)
                {
                    $name = 'Coca-Cola';
                }
                else if($productData[$i]->menu_id==23)
                {
                    $name = 'Thums Up';
                }
                else if($productData[$i]->menu_id==24)
                {
                    $name = 'Soupy Maggi';
                }
                else if($productData[$i]->menu_id==25)
                {
                    $name = 'Sprite';
                }
                else if($productData[$i]->menu_id==26)
                {
                    $name = 'Chicken Masala Roll + Thums Up';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==27)
                {
                    $name = 'Chicken Masala Roll + Sprite';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==28)
                {
                    $name = 'Paneer Masala Roll + Thums Up';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==29)
                {
                    $name = 'Paneer Masala Roll + Sprite';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                } 
                else if($productData[$i]->menu_id==30)
                {
                    $name = 'Double Egg Bhurji + Thums Up';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==31)
                {
                    $name = 'Double Egg Bhurji + Sprite';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==32)
                {
                    $name = 'Veg Jumbo Sandwich';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==33)
                {
                    $name = 'Veg Mini Grilled Sandwich';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==34)
                {
                    $name = 'French Fries';
                }
                else if($productData[$i]->menu_id==35)
                {
                    $name = 'Masala French Fries';
                }
                else if($productData[$i]->menu_id==36)
                {
                    $name = 'Peri Peri French Fries';
                }
                else if($productData[$i]->menu_id==37)
                {
                    $name = 'Veg Jumbo Sandwich + French Fries';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else if($productData[$i]->menu_id==38)
                {
                    $name = 'Veg Mini Grilled Sandwich + French Fries';
                    if($productData[$i]->cheese==1)
                    {
                        $name = $name.'(Cheese)';
                    }
                }
                else
                {

                }
            $qty = $productData[$i]->qty;
            $msg = $msg." ".$name."-".$qty." ";
            $name = null;
        }
        $msg = $msg." Addres-".$request->address." Area-".$order_id[0]->area." Mobile=".$request->contact." Payment=".$request->payment_type;
        /*
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=ORDERS&route=4&mobiles=8600198512,7558417359,7767838215&authkey=301978ABd7ytk7T5dbe6f46&country=91&message=Order No:".$order_id[0]->id." Menu : ".$msg,
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

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=MFORDR&route=4&mobiles=".$request->contact."&authkey=301978ABd7ytk7T5dbe6f46&country=91&message=Your order has been placed successfully. You will get home delivery within 25-30 minutes. %0a-Team MoonFood",
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

        curl_close($curl);*/
        return FS_Response::success('data',$offerApplied);
    }
    /*
     * response : {
     *
     * }
     * */
    public function getNumberOfPromocodeOrder(Request $request,$mobile)
    {
        $user_id = DB::select('select id from customer where mobile=?',[$mobile]);
        $promocode = "SUPER30";
        $count=DB::select('select id from orders where customer_id=? and promocode=?',[$user_id[0]->id,$promocode]);
        return FS_Response::success('data',$count);
    }

    public function saveDiscount(Request $request,$money)
    {
        $id = DB::select('select id from orders order by id DESC LIMIT 1');
        DB::table('orders')
            ->where('id',$id[0]->id)
            ->update([
                'cashback' => $money
            ]);  
        return FS_Response::success('data',$money);
    }

    public function getCashback(Request $request,$id)
    {
        $money = DB::select('select cashback from orders where id=?',[$id]);
      
        return FS_Response::success('data',$money);
        
    }

    public function sendOrderSms(Request $request)
    {	
	//$id = $request->id;
	$shopid = DB::select('select shop_id from product where id=?',[$request->id]);
	$no = DB::select('select contact from shop where id=?',[$shopid[0]->shop_id]);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=ORDERS&route=4&mobiles=8600198512,7558417359,7767838215,".$no[0]->contact."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Please check fashiostreet. You have new order.",
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
	return FS_Response::success('data',$no);

    }

    //Specific Order
    public function specificOrder(Request $request)
    {
        if($request->which=="clothing")
        {
            DB::table('specific_order')->insert([
            'category' => $request->category,
            'price' => $request->price,
            'color' => $request->color,
            'size' => $request->size,
            'description' => $request->description,
            'whatsapp' => $request->mobile
            ]);
            $id = DB::select('SELECT id FROM specific_order ORDER BY id DESC LIMIT 1');
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=7767838215,7558417359,8600198512&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Specific Want Order(Id-".$id[0]->id.")%0aCategory=".$request->category.",%0aPrice=".$request->price.",%0aColor=".$request->color.",%0aSize=".$request->size.",%0aDescription=".$request->description.",%0aCustomer No=".$request->mobile."%0ahttps://wa.me/91".$request->mobile,
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
           /* $number = DB::select('select contact from shop where city_id=2');
            for($i=0;$i<count($number);$i++)
            {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$number[$i]->contact."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Specific Want Order (Id - ".$id[0]->id." )%0aCategory=".$request->category."%0aPrice=".$request->price."%0aColor=".$request->color."%0aSize=".$request->size."%0aDescription=".$request->description."%0aYES : https://api.whatsapp.com/send?phone=918600198512%26text=Yes-Specific_Want_Order(Id-".$id[0]->id.")"."%0aNO : https://api.whatsapp.com/send?phone=918600198512%26text=No-Specific_Want_Order(Id-".$id[0]->id.")",
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
            }
            */
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$request->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Your specific want enquiry has been received successfully.%0a- Team fashiostreet",
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
            return FS_Response::success('data',$request->mobile);
        }
        if($request->which=="footwear")
        {
            DB::table('specific_order')->insert([
            'category' => $request->category,
            'price' => $request->price,
            'color' => $request->color,
            'size' => $request->size,
            'description' => $request->description,
            'whatsapp' => $request->mobile
            ]);
            $id = DB::select('SELECT id FROM specific_order ORDER BY id DESC LIMIT 1');
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=7767838215,7558417359,8600198512&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Specific Want Order(Id-".$id[0]->id.")%0aCategory=".$request->category.",%0aPrice=".$request->price.",%0aColor=".$request->color.",%0aSize=".$request->size.",%0aDescription=".$request->description.",%0aCustomer No=".$request->mobile."%0ahttps://wa.me/91".$request->mobile,
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
           /* $number = DB::select('select contact from shop where city_id=2');
            for($i=0;$i<count($number);$i++)
            {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$number[$i]->contact."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Specific Want Order (Id - ".$id[0]->id." )%0aCategory=".$request->category."%0aPrice=".$request->price."%0aColor=".$request->color."%0aSize=".$request->size."%0aDescription=".$request->description."%0aYES : https://api.whatsapp.com/send?phone=918600198512%26text=Yes-Specific_Want_Order(Id-".$id[0]->id.")"."%0aNO : https://api.whatsapp.com/send?phone=918600198512%26text=No-Specific_Want_Order(Id-".$id[0]->id.")",
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
            }
            */
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$request->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Your specific want enquiry has been received successfully.%0a- Team fashiostreet",
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
            return FS_Response::success('data',$request->mobile);
        }
        else if($request->which=="deodorant")
        {
            DB::table('specific_order')->insert([
            'brand' => $request->brand,
            'size' => $request->size,
            'description' => $request->description,
            'whatsapp' => $request->mobile
            ]);
            $id = DB::select('SELECT id FROM specific_order ORDER BY id DESC LIMIT 1');
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=7767838215,7558417359,8600198512&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Specific Want Order(Id-".$id[0]->id.")%0aBrand=".$request->brand.",%0aVolume=".$request->size.",%0aDescription=".$request->description.",%0aCustomer No=".$request->mobile."%0ahttps://wa.me/91".$request->mobile,
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
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$request->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Your specific want enquiry has been received successfully.%0a- Team fashiostreet",
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
                                return FS_Response::success('data',$request->mobile);
        }
        else if($request->which=="raincoat")
        {
            DB::table('specific_order')->insert([
            'brand' => $request->brand,
            'price' => $request->price,
            'color' => $request->color,
            'description' => $request->description,
            'whatsapp' => $request->mobile
            ]);
            $id = DB::select('SELECT id FROM specific_order ORDER BY id DESC LIMIT 1');
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=7767838215,7558417359,8600198512&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Specific Want Order(Id-".$id[0]->id.")%0aBrand=".$request->brand.",%0aPrice=".$request->price.",%0aColor=".$request->color.",%0aDescription=".$request->description.",%0aCustomer No=".$request->mobile."%0ahttps://wa.me/91".$request->mobile,
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
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$request->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Your specific want enquiry has been received successfully.%0a- Team fashiostreet",
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
                                return FS_Response::success('data',$request->mobile);
        }
        else if($request->which=="phonecover")
        {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$request->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=This category is not available right now.Please Update your App. Sorry for the inconvenience.%0a- Team fashiostreet",
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
                                return FS_Response::success('data',$request->mobile);
        }
        else if($request->which=="electronicaccs")
        {

                     $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$request->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=We have removed Electronic Accessories category.Please update your app.Sorry for the inconvenience.%0a- Team fashiostreet",
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
                                return FS_Response::success('data',$request->mobile);

        }
        else
        {

        }
    }

    public function getOrderHistory(Request $request,$json='view')
    {
        $page = isset($request->page)? (int) $request->page :1;
        $paginate = 15;
        $startFrom = ($page - 1) * $paginate;
        $orderComplete = array();
        $orders = $this->getOrders($this->user_id,$startFrom,$paginate);
        for($i=0;$i < count($orders);$i++)
        {
            $tmp_data = array(
                'order_id' => $orders[$i]->order_id,
                'order_status' => $orders[$i]->status,
                'address' => $orders[$i]->address,
                'contact' => $orders[$i]->contact,
                'cashback' => $orders[$i]->cashback,
                'promocode' => $orders[$i]->promocode,
                'try_buy' => $orders[$i]->try_buy,
                'customer_name' => $orders[$i]->customer_name,
                'completed_at' => $orders[$i]->completed_at,
                'order_date' => $orders[$i]->created_at,
                'products' => $this->getSelectedProduct($orders[$i]->order_id)
            );
            array_push($orderComplete,$tmp_data);
            unset($tmp_data);
        }
        if($json == 'json')
        {
            return FS_Response::success('data',$orderComplete);
        }
        return view('fashiostreet_client::orders_history',['order' => $orderComplete]);
    }
    /*
     * @param
     * order_id
     * */
    public function CancelOrder(Request $request){
        return $this->ChangeOrderStatus($request->order_id,$this->user_id);
    }

    public function changeOrderStatus(Request $request)
    {
        $status = null;
        if($request->status==1)
        {
            $status = 2;
        }
        if($request->status==2)
        {
            $status = 3;
        }
        if($request->status==3)
        {
            $contact = DB::select('select contact from moonfood_order where id = ?',[$request->order_id]);
            DB::table('moonfood_order')
            ->where('id',$request->order_id)
            ->update([
                'completed' => 1,
                'completed_at' => Carbon::now()
            ]);   
                $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=MFORDR&route=4&mobiles=".$contact[0]->contact."&authkey=301978ABd7ytk7T5dbe6f46&country=91&message=Moonfood: Your order has been delivered successfully. Rate Our App - http://bit.ly/moonfood_app",
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
            return FS_Response::success('data',$contact);
        }
        DB::table('moonfood_order')
            ->where('id',$request->order_id)
            ->update([
                'status' => $status
            ]);  
    }

    public function adminOrders(Request $request)
    {
        $users_order = DB::select('select * from moonfood_order order by id DESC LIMIT 7');
        $ordersData = array();
        for($i=0;$i < count($users_order);$i++)
        {
            $menus = DB::select('select * from orderedmenu where order_id = ?',[$users_order[$i]->id]);
            for($j=0;$j<count($menus);$j++)
            {
                if($menus[$j]->menu_id==1)
                {
                    $menus[$j]->name = 'Fried Maggi';
                    $menus[$j]->price = 16;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0.8;
                }
                else if($menus[$j]->menu_id==2)
                {
                    $menus[$j]->name = 'Double Bread Omlette';
                    $menus[$j]->price = 14;
                    $menus[$j]->packaging = 0.9;
                }
                else if($menus[$j]->menu_id==3)
                {
                    $menus[$j]->name = 'Olee Bhel';
                    $menus[$j]->price = 16;
                    $menus[$j]->packaging = 0.6;
                }
                else if($menus[$j]->menu_id==4)
                {
                    $menus[$j]->name = 'Suki Bhel';
                    $menus[$j]->price = 25;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==5)
                {
                    $menus[$j]->name = 'Bread Chilla';
                    $menus[$j]->price = 14;
                    $menus[$j]->packaging = 0.9;
                }
                else if($menus[$j]->menu_id==6)
                {
                    $menus[$j]->name = 'Double Egg Burji';
                    $menus[$j]->price = 30;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 2.9;
                }
                else if($menus[$j]->menu_id==7)
                {
                    $menus[$j]->name = 'Bread';
                    $menus[$j]->price = 2;
                    $menus[$j]->packaging = 0.7;
                }
                else if($menus[$j]->menu_id==8)
                {
                    $menus[$j]->name = 'Ketchup';
                    $menus[$j]->price = 2;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==9)
                {
                    $menus[$j]->name = 'Shev';
                    $menus[$j]->price = 2;
                    $menus[$j]->packaging = 0.25;
                }
                else if($menus[$j]->menu_id==10)
                {
                    $menus[$j]->name = 'Bhel Combo';
                    $menus[$j]->price = 60;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==11)
                {
                    $menus[$j]->name = 'Double Egg Bhurji Combo';
                    $menus[$j]->price = 65;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==12)
                {
                    $menus[$j]->name = 'Fried Maggi Combo';
                    $menus[$j]->price = 60;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==13)
                {
                    $menus[$j]->name = 'Double Bread Omlette Combo';
                    $menus[$j]->price = 55;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==14)
                {
                    $menus[$j]->name = 'Boiled Eggs';
                    $menus[$j]->price = 14;
                    $menus[$j]->packaging = 1.1;
                }
                else if($menus[$j]->menu_id==15)
                {
                    $menus[$j]->name = 'Mix Veg Roll';
                    $menus[$j]->price = 31;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0.7;
                }
                else if($menus[$j]->menu_id==16)
                {
                    $menus[$j]->name = 'Paneer Masala Roll';
                    $menus[$j]->price = 42;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0.7;
                }
                else if($menus[$j]->menu_id==17)
                {
                    $menus[$j]->name = 'Single Omlette Roll';
                    $menus[$j]->price = 29;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0.7;
                }
                else if($menus[$j]->menu_id==18)
                {
                    $menus[$j]->name = 'Double Omlette Roll';
                    $menus[$j]->price = 35;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0.7;
                }
                else if($menus[$j]->menu_id==19)
                {
                    $menus[$j]->name = 'Chicken Masala Roll';
                    $menus[$j]->price = 45;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0.7;
                }
                else if($menus[$j]->menu_id==20)
                {
                    $menus[$j]->name = 'Single Omlette Chicken Masala Roll';
                    $menus[$j]->price = 52;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0.7;
                }
                else if($menus[$j]->menu_id==21)
                {
                    $menus[$j]->name = 'Double Omlette Chicken Masala Roll';
                    $menus[$j]->price = 60;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0.7;
                }
                else if($menus[$j]->menu_id==22)
                {
                    $menus[$j]->name = 'Coca-Cola';
                    $menus[$j]->price = 20;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==23)
                {
                    $menus[$j]->name = 'Thums Up';
                    $menus[$j]->price = 20;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==24)
                {
                    $menus[$j]->name = 'Soupy Maggi';
                    $menus[$j]->price = 13;
                    $menus[$j]->packaging = 1;
                }
                else if($menus[$j]->menu_id==25)
                {
                    $menus[$j]->name = 'Sprite';
                    $menus[$j]->price = 20;
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==26)
                {
                    $menus[$j]->name = 'Chicken Masala Roll + Thums Up';
                    $menus[$j]->price = 70;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==27)
                {
                    $menus[$j]->name = 'Chicken Masala Roll + Sprite';
                    $menus[$j]->price = 70;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==28)
                {
                    $menus[$j]->name = 'Paneer Masala Roll + Thums Up';
                    $menus[$j]->price = 65;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==29)
                {
                    $menus[$j]->name = 'Paneer Masala Roll + Sprite';
                    $menus[$j]->price = 65;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==30)
                {
                    $menus[$j]->name = 'Double Egg Bhurji + Thums Up';
                    $menus[$j]->price = 55;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==31)
                {
                    $menus[$j]->name = 'Double Egg Bhurji + Sprite';
                    $menus[$j]->price = 55;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==32)
                {
                    $menus[$j]->name = 'Veg Jumbo Sandwich';
                    $menus[$j]->price = 30;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 1.1;
                }
                else if($menus[$j]->menu_id==33)
                {
                    $menus[$j]->name = 'Veg Mini Grilled Sandwich';
                    $menus[$j]->price = 30;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 1.1;
                }
                else if($menus[$j]->menu_id==34)
                {
                    $menus[$j]->name = 'French Fries';
                    $menus[$j]->price = 32;
                    $menus[$j]->packaging = 1.7;
                }
                else if($menus[$j]->menu_id==35)
                {
                    $menus[$j]->name = 'Masala French Fries';
                    $menus[$j]->price = 42;
                    $menus[$j]->packaging = 1.7;
                }
                else if($menus[$j]->menu_id==36)
                {
                    $menus[$j]->name = 'Peri Peri French Fries';
                    $menus[$j]->price = 37;
                    $menus[$j]->packaging = 1.7;
                }
                else if($menus[$j]->menu_id==37)
                {
                    $menus[$j]->name = 'Veg Jumbo Sandwich + French Fries';
                    $menus[$j]->price = 60;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else if($menus[$j]->menu_id==38)
                {
                    $menus[$j]->name = 'Veg Mini Grilled Sandwich + French Fries';
                    $menus[$j]->price = 60;
                    if($menus[$j]->cheese==1)
                    {
                        $menus[$j]->price = $menus[$j]->price + 10;
                    }
                    $menus[$j]->packaging = 0;
                }
                else
                {

                }
            }
            $time = null;
            $year = null;
            $month = null;
            $date = null;
            $hours= null;
            $min = null;
            $sec = null;
            $time = strtotime($users_order[$i]->created_at);
            $year = date('Y',$time);
            $month = date('m',$time);
            $date = date('d',$time);
            $hours = date('h',$time);
            $min = date('i',$time);
            $sec = date('s',$time);
            $tmp_data = array(
                'order_id' => $users_order[$i]->id,
                'contact' => $users_order[$i]->contact,
                'address' => $users_order[$i]->address,
                'completed' => $users_order[$i]->completed,
                'year' => $year,
                'month' => $month,
                'date' => $date,
                'hours' => $hours,
                'min' => $min,
                'sec' => $sec,
                'created_at' => $users_order[$i]->created_at,
                'offerApplied' => $users_order[$i]->offerApplied,
                'deliveryCharge' => $users_order[$i]->deliveryCharge,
                'payment_type' => $users_order[$i]->payment_type,
                'carryBag' => $users_order[$i]->carryBag,
                'tissue' => $users_order[$i]->tissue,
                'status' => $users_order[$i]->status,
                'coupon_id' => $users_order[$i]->coupon_id,
                'menus' => $menus 
            );
            array_push($ordersData,$tmp_data);
            unset($tmp_data);
            unset($menus);
        }
        return FS_Response::success('data',$ordersData);
    }

    public function deliveredOrder(Request $request)
    {
        $user_id = DB::select('select contact from moonfood_order where id = ?',[$request->order_id]);
        $contact = $user_id[0]->contact;
        DB::table('moonfood_order')
            ->where('id',$request->order_id)
            ->update([
                'completed' => 1,
                'completed_at' => Carbon::now()
        ]);   
            $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=MFORDR&route=4&mobiles=".$contact."&authkey=301978ABd7ytk7T5dbe6f46&country=91&message=Moonfood: Your order has been delivered successfully. Rate Our App - http://bit.ly/moonfood_app",
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
        return FS_Response::success('data',$contact);    
    }

    public function confirm_delivery(Request $request,$json = 'view')
    {
        $obj = new CartController($request);
        $product = $obj->GetFromCart($request,'normal');
        $obj = new AddressController($request);
        $address = $obj->getAddressById($request);
        if($json == 'json')
        {
            return FS_Response::success('data',array(
                'product' => $product,
                'address' => $address
            ));
        }
        return view('fashiostreet_client::confirm_delivery',['product' => $product,'address' => $address]);
    }
}
