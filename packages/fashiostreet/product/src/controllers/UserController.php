<?php

namespace fashiostreet\product;

use Carbon\Carbon;
use fashiostreet\product\Auth\User;
use fashiostreet\product\Exceptions\ErrorException;
use FS_Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    const user_field = [
        ''
    ];
    protected $user;
    protected $startFrom;
    protected $paginate = 15;
    function __construct(Request $request)
    {
        $this->user = new User();
        $page = isset($request->page) ? (int)$request->page : 1;
        $this->StartFrom = (((int)$page - 1) * $this->paginate);
        unset($page);   //deallocate page variable;

    }

    public function coupons(Request $request)
    {
        $coupons = DB::select('select * from coupons');
        return FS_Response::success('data',$coupons);
    }

    public function saveCoupon(Request $request)
    {
        $user_id = DB::select('select * from customer where mobile=?',[$request->mobile]);
        DB::table('coupons')->insert([
            'mobile' => $request->mobile,
            'user_id' => $user_id[0]->id,
            'code' => $request->code,
            'coupon_id' => $request->id
        ]);
        return FS_Response::success('message','success');
    }

    public function checkCoupon(Request $request,$mobile,$code)
    {
        $coupon = DB::select('select * from coupons where mobile = ? and code = ? and deleted_at IS NULL',[$mobile,$code]);
        if(count($coupon)>0)
        {
            return FS_Response::success('data',$coupon[0]->coupon_id);
        }
        else
        {
            return FS_Response::error(500,'Enter valid Referal code');
        }
    }

    public function saveOrder(Request $request)
    {
        $d = '2019-'.$request->month.'-'.$request->date.' 04:00:00';
        $user_id = DB::select('select * from customer where mobile=?',[$request->mobile]);
        if(count($user_id)>0)
        {

        }
        else{
            DB::table('customer')->insert([
            'mobile' => $request->mobile,
            'password' => '123456',
            'created_at' => $d
            ]);
            $user_id = DB::select('select * from customer where mobile=?',[$request->mobile]);
        }
        $offerApplied = null;
        $deliveryCharge = null;
        DB::table('moonfood_order')->insert([
            'customer_id' => $user_id[0]->id,
            'contact' => $request->mobile,
            'address' => $request->address,
            'created_at' => $d,
            'offerApplied' => $offerApplied,  
            'deliveryCharge' => $deliveryCharge, 
            'payment_type' => "Cash on Delivery", 
            'completed' => 1,
            'completed_at' => $d
            ]);
        $order_id = DB::select('select * from moonfood_order where customer_id = ? order by id DESC',[$user_id[0]->id]);
        $c = 0;
            for ($i = 0; $i < count($request->menu_id); $i++) 
            {
                DB::table('orderedmenu')->insert([
                'order_id' => $order_id[0]->id,
                'menu_id' => $request->menu_id[$i],
                'qty' => $request->qty[$i],
                'created_at' => $d
                ]);
                $c = $c + 1;
            }
        return FS_Response::success('data',$d);
    }

    public function getDiscountNo(Request $request,$mobile)
    {
        $data = DB::select('select discount from customer where mobile = ?',[$mobile]);
        return FS_Response::success('data',$data);
    }

    public function getUserOfferNumber(Request $request,$mobile)
    {
        $user_id = DB::select('select id from customer where mobile = ?',[$mobile]);
        $today = (int)date("d");
        $orderNo = DB::select('select * from moonfood_order where customer_id = ? and offerApplied=1 and (completed=1 or completed=0)',[$user_id[0]->id]);
        for($j=0;$j<count($orderNo);$j++)
        {
            $d = strtotime($orderNo[$j]->created_at);
            $e = (int)date("d",$d);
            if($today==$e)
            {
                $orderNo[$j]->created_at = 1;
            }   
        }

        return FS_Response::success('data',$orderNo);
    }

    public function getUserDiscount(Request $request,$mobile)
    {
        $no = DB::select('select discount from customer where mobile = ?',[$mobile]);
        return FS_Response::success('data',$no[0]->discount);
    }

    public function frameView()
    {
        return view('fashiostreet_client::layout.user');
    }

    public function sendReferal(Request $request)
    {
        $d1 = null;
        $d2 = null;
        $checkReferal = DB::select('select * from customer where mobile = ?',[$request->referal]);
        if(count($checkReferal) > 0)
        {
            $data = DB::select('select * from customer where mobile = ?',[$request->mobile]);
            if($checkReferal[0]->discount==null)
            {
                $d1 = 1;
            }
            else
            {
                $d1 = $checkReferal[0]->discount + 1;
            }
            if($data[0]->discount==null)
            {
                $d2 = 1;
            }
            else
            {
                $d2 = $data[0]->discount + 1;
            }
            DB::table('customer')
            ->where('mobile',$request->referal)
            ->update([
                'discount' => $d1
            ]);
            DB::table('customer')
            ->where('mobile',$request->mobile)
            ->update([
                'discount' => $d2
            ]);
            
        return FS_Response::success('message',"Success");
        } 
        else
        {
            return FS_Response::error(500,'Enter valid Referal code');
        }
    }

    public function sendReferMessage(Request $request)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=MFREFR&route=4&mobiles=".$request->referal."&authkey=301978ABd7ytk7T5dbe6f46&country=91&message=Refer Code:".$request->mobile."%0aDownload Moonfood app and enjoy free home of your favourite snacks.%0aGet 20% Off by using above refer code at time of login.%0aAlso,share your referal code from app to get 20% Off at each referal.%0aApp Download Link:https://play.google.com/store/apps/details?id=in.moonfood.android",
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
        return FS_Response::success('data',$request->referal);
    }

    public function addUpcomingFeature(Request $request)
    {
        DB::table('upcoming_feature')->insert([
            'name' => $request->feature
        ]);
        return FS_Response::success('message',"Success");
    }

    public function saveFeedback(Request $request)
    {
        DB::table('moonfood_order')
            ->where('id',$request->order_id)
            ->update([
                'rating' => $request->rating,
                'feedback' => $request->feedback
            ]);
        return FS_Response::success('message',"Success");
    }

    public function addUserWallet(Request $request,$mobile)
    {
        $id = DB::select('select id from customer where mobile=?',[$mobile]);
        DB::table('customer_wallet')->insert([
            'customer_id' => $id[0]->id,
            'money' => 0
        ]);
        return FS_Response::success('message',"Success");
    }

    public function updateMoney(Request $request)
    {
        $id = DB::select('select id from customer where mobile=?',[$request->mobile]);
        DB::table('customer_wallet')
            ->where('customer_id',$id[0]->id)
            ->update([
                'money' => $request->money
            ]);
        return FS_Response::success('data',$request->money);
    }

    public function getWalletMoney(Request $request,$mobile)
    {   
        $id = DB::select('select id from customer where mobile=?',[$mobile]);
        $money = DB::select('select money from customer_wallet where customer_id=?',[$id[0]->id]);
        return FS_Response::success('data',$money);
    }

    public function add($user_id,$request){
        try
        {
            if(!$this->checkProductInWishlist($user_id,$request->product_id,'json')) {
                $wishlist = new wishlist();
                $wishlist->users_id = $user_id;
                $wishlist->product_id = $request->product_id;
                $wishlist->save();
                return 'Successfully Added To Wishlist';
            }
            return false;
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            throw new ErrorException('System error found,wishlist');
        }
    }

    public function add_wishlist(Request $request,$json = 'view')
    {
        $user_id = $this->user->getUserId($request);    //set through sentinel
        $status = $this->add($user_id,$request);
        if($status)
        {
            return FS_Response::success('message',$status);
        }
        return FS_Response::error(500,'product already in wishlist');
    }

    protected function checkProductInWishlist($user_id,$product_id,$json = 'view'){
        try
        {
            $product = (array) DB::select('select id from `wishlist` where users_id = ? and product_id = ? and deleted_at IS NULL limit 1',[$user_id,$product_id]);
            if(count($product) <= 0)
            {
                return false;
            }
            return true;
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            if($json == 'json')
            {
                throw new ErrorException('wishlist,server error found please try agian or contact our customer service');
            }
            $error = array('error' => 'Server error found please,Try again');
            return view('fashiostreet_client::error500',['request' => $error]);
        }
    }


    public function delete_wishlist(Request $request,$json = 'view')
    {
        $user_id = $this->user->getUserId($request);

            try
            {
                if($this->checkProductInWishlist($user_id,$request->product_id,$json)) {
                        DB::table('wishlist')
                        ->where('users_id', $user_id)
                        ->where('product_id', $request->product_id)
                        ->update([
                            'deleted_at' => Carbon::now()
                        ]);
                    if($json == 'json')
                    {
                        return FS_Response::success('message', 'product sucessfully remove from wishlist');
                    }
                    //return view here
                }
                if($json == 'json')
                {
                    return FS_Response::error('message','no product found at wishlist');
                }
                //return error view here;
            }
            catch (\Illuminate\Database\QueryException $e)
            {
                if($json == 'json')
                {
                    throw new ErrorException('wishlist,server error found please try agian or contact our customer service');
                }
                $error = array('error' => 'Server error found please,Try again');
                return view('fashiostreet_client::error500',['request' => $error]);
            }
    }

    protected function withImagePath($wishlist)
    {
        for($i=0;$i < count($wishlist);$i++)
        {
            $wishlist[$i]->image = 'https://seller.fashiostreet.com/products/compress/'.$wishlist[$i]->image;
        }
        return $wishlist;
    }

    public function view_wishlist(Request $request,$json = 'view')
    {
        $user_id = $this->user->getUserId($request);   //set through sentinel;
        try
        {
            $wishlist = DB::select('select product.id as id,shop.name as shop_name,product.image,product.name,product.mrp_price,product.selling_price from `wishlist` left join product ON product.id = wishlist.product_id left join shop on product.shop_id = shop.id where wishlist.users_id = ? and wishlist.deleted_at IS NULL limit ?,?',[$user_id,$this->startFrom,$this->paginate]);
            for($i=0;$i < count($wishlist);$i++)
            {
                $image = explode(',',$wishlist[$i]->image);
                $image = array_reverse($image);
                $wishlist[$i]->image = array('https://seller.fashiostreet.com/products/compress220X258/'.$image[0]);
                $size = DB::select('SELECT size.name as size from product_size LEFT JOIN size on size.id = product_size.size_id WHERE product_id = ? and product_size.deleted_at IS NULL', [$wishlist[$i]->id]);
                $wishlist[$i]->size = $size;
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$wishlist[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($wishlist[$i]->mrp_price - $wishlist[$i]->selling_price)/$wishlist[$i]->mrp_price)*100;
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $wishlist[$i]->offers = $offer[0]->offers;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $wishlist[$i]->specialDiscount = true;
                    $wishlist[$i]->specialDiscountedPrice = $wishlist[$i]->mrp_price - (($wishlist[$i]->mrp_price*$check[0]->discount)/100);
                    $wishlist[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $wishlist[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
            }
            if($json == 'json')
            {
                return FS_Response::success('message',$wishlist);
            }
            return view('fashiostreet_client::wishlist',['products' => $wishlist]);
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            if($json == 'json')
            {
                throw new ErrorException('wishlist,server error found please try agian or contact our customer service');
            }
            $error = array('error' => 'Server error found please,Try again');
            return view('fashiostreet_client::error500',['request' => $error]);
        }
    }

    public function add_history(Request $request)
    {
        $user_id = 1;    //set through sentinel
        try
        {
            $userhistory = new userhistory();
            $userhistory->users_id = $user_id;
            $userhistory->product_id = $request->product_id;
            $userhistory->save();
            return $this->json_success('Successfully Added To Wishlist');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            return $this->json_error('Server Not Found');
        }
    }

    public function view_userhistory(Request $request)
    {
        $user_id = 1;   //set through sentinel;
        try
        {
            $userhistory = DB::select('select product.id as id,product.image,product.name,product.mrp_price,product.selling_price,shop.name from `userhistory` left join product ON product.id = userhistory.product_id left JOIN shop ON shop.id = product.shop_id where userhistory.users_id = ? limit ?,?',[$user_id,$min,$max]);
            if(count($userhistory) > 0)
            {
                return $userhistory;
            }
            return $this->json_success([]);
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            return $this->json_error('Server Not Found');
        }
    }

    protected function getUserById($id,$json)
    {
        try {
            $user = (array)DB::select('select id,name,gender,mobile from customer where id = ? limit 1', [$id]);
            if (count($user) <= 0) {
                throw new ErrorException('No user found');
            }
            return $user;
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            if($json == 'json')
            {
                throw new ErrorException('user,server error found please try agian or contact our customer service');
            }
            $error = array('error' => 'Server error found please,Try again');
            return view('fashiostreet_client::error500',['request' => $error]);
        }

    }
    /*
     * Get user profile
     * */
    public function getUser(Request $request,$json='view')
    {
        try
        {
            $user_id = $this->user->getUserId($request);
            $user = $this->getUserById($user_id,$json);
            if($json == 'json')
            {
                return FS_Response::success('data',$user);
            }
            return view('fashiostreet_client::profile',['user' => $user]);
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            if($json == 'json')
            {
                throw new ErrorException('wishlist,server error found please try agian or contact our customer service');
            }
            $error = array('error' => 'Server error found please,Try again');
            return view('fashiostreet_client::error500',['request' => $error]);
        }
    }

    /*
     * Update user profile
     * */
    public function update_user(Request $request)
    {
        try
        {
            $user_id = $this->user->getUserId($request);
            $user = DB::table('customer')
                        ->where('id',$user_id)
                        ->update([
                            'name' => $request->name,
                            'gender' => $request->gender,
                        ]);
            if($user <= 0 || $user == false || $user == null)
            {
                return FS_Response::error(500,'no update found');
            }
            return FS_Response::success('message','user successfully updated');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            throw new ErrorException('wishlist,server error found please try agian or contact our customer service');
        }
    }
    //User Name
    public function user_name(Request $request)
    {
        try
        {
            $user_id = $this->user->getUserId($request);
            $user = DB::table('customer')->where('id',$user_id);
            if($user <= 0 || $user == false || $user == null)
            {
                return FS_Response::error(500,'no user found');
            }
            return FS_Response::success('message',$user);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            throw new ErrorException('server error found please try agian or contact our customer service');
        }
    }

    /*
     * error json private function
     * */
    private function json_error($error)
    {
        return response()->json($error,500);
    }

    private function error($error)
    {
        return view('fashiostreet_client::error500?error='.$error);
    }

    /*
     * success json private function
     * */

    private function json_success($message)
    {
        return response()->json($message,200);
    }
}
