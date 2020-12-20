<?php

namespace fashiostreet\product;
use Carbon\Carbon;
use fashiostreet\product\Exceptions\ErrorException;
use fashiostreet\product\Exceptions\SystemException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use fashiostreet\product\city;
use fashiostreet\product\Auth\User;
use fashiostreet\product\shop;
use Illuminate\Support\Facades\Redirect;
use FS_Response;

class ShopController extends Controller
{
    public function getCategory(Request $request,$shop_name)
    {
        $id = (int)DB::table('shop')->select(['id'])->where('name',$shop_name)->get();
        $category = DB::select('select DISTINCT * from sub_category left join category_sub_gender ON
                    category_sub_gender.sub_category_id=sub_category.id left join product ON 
                    product.category_sub_gender_id=category_sub_gender.id where product.shop_id=?',$id);
        return FS_Response::success('category',$category);
    }
    public function getName(Request $request,$shop_id) 
    {
	$name = DB::select('select name from shop where id=?',[$shop_id]);
	return FS_Response::success('data',$name);
    }

    public function getShopContact(Request $request,$shop_name)
    {
        $contact = DB::select('select contact from shop where name = ?',[$shop_name]);
        return FS_Response::success('data',$contact[0]->contact);
    }

    public function offers_shop(Request $request,$shop_name,$category,$discount,$page)
    {
        $offers = '';
        if(!isset($page))
        {
            $page = 1;
        }
        $min = (int)$page;  //page validate
        $max = 16;
        $min = (($min - 1)*$max);
        $shop_id = DB::select('select id from shop where name = ?',[$shop_name]);
            if($shop_name === 'lifestyle')
            {
                $offers = DB::select('SELECT * FROM product WHERE shop_id=19 and discount>600 ORDER BY discount DESC');
            }
            if($shop_name === 'Lavanya NX')
            {
                $offers = DB::select('SELECT * FROM product WHERE shop_id=6 and discount>600 ORDER BY discount DESC');
            }
            if($shop_name === 'Dress code')
            {
                $offers = DB::select('SELECT * FROM product WHERE shop_id=1 and discount>600 ORDER BY discount DESC');
            }
            if($shop_name === 'Silverleaf Islampur')
            {
                $offers = DB::select('SELECT * FROM product WHERE shop_id=14 and discount>100 ORDER BY discount DESC');
            }
            if($shop_name == 'Parth Collection')
            {
                $offers = DB::select('select * from product where id IN (2342,3036,3037,3038,3039) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2342,3036,3037,3038,3039)');
                //DB::select('SELECT * FROM product WHERE shop_id=78 and category_sub_gender_id=23 limit ?,?',[$min,$max]);
            }
            if($shop_name == 'Texas Style House')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=? and shop_id=? and deleted_at IS NULL ORDER BY id DESC limit ?,?',[$category,$shop_id[0]->id,$min,$max]);
            }
            if($shop_name == 'Fashion style for mens')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=? and shop_id=? and deleted_at IS NULL ORDER BY id DESC limit ?,?',[$category,$shop_id[0]->id,$min,$max]);
            }
            if($shop_name == 'Super star mens kids')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=? and shop_id=? and deleted_at IS NULL ORDER BY id DESC limit ?,?',[$category,$shop_id[0]->id,$min,$max]);
            }
            if($shop_name == 'Style hub wear')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=1 and shop_id>33 and shop_id!=63 and selling_price<300 and shop_id>33 ORDER BY id DESC limit ?,?',[$min,$max]);
            }
            if($shop_name == 'MJ Collection')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=3 and shop_id>33 and shop_id!=63 and selling_price<550 and shop_id>33 ORDER BY id DESC limit ?,?',[$min,$max]);
            }
            if($shop_name == 'Kingz')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=14 and selling_price<350  ORDER BY id DESC limit ?,?',[$min,$max]);
            }
            if($shop_name == 'Shoe Park')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=156 and selling_price<210  ORDER BY id DESC limit ?,?',[$min,$max]);
            }
            //$offers[$i]->image = array('https://seller.fashiostreet.com/products/compress220X258/'.$image[0]);
            for($i=0;$i < count($offers);$i++)
            {
                $image = explode(',',$offers[$i]->image);
                $image = array_reverse($image);
                $offers[$i]->image = array('http://seller.fashiostreet.com/products/compress220X258/'.$image[0]);
            }
            for($i=0;$i<count($offers);$i++)
            {
                $shop = DB::select('select name from shop where id = ?',[$offers[$i]->shop_id]);
                $offers[$i]->shop_name = $shop[0]->name;
            }
            $obj = new User();
            $userID = null;
            if($request->hasHeader('local-id'))
            {
                $userID = $obj->getUserId($request);
            }
            if($request->hasHeader('local-id'))
            {
                for($i=0;$i<count($offers);$i++)
                {
                    $wishlist = DB::select('select id from `wishlist` where users_id = ? and product_id = ? and deleted_at IS NULL  limit 1',[$userID,$offers[$i]->id]);
                    if(count($wishlist) > 0)
                        $offers[$i]->{'wishlistflag'} = 1;
                    else
                        $offers[$i]->{'wishlistflag'} = 0;
                }
            }
            for($i=0;$i<count($offers);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$offers[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($offers[$i]->mrp_price - $offers[$i]->selling_price)/$offers[$i]->mrp_price)*100;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $offers[$i]->specialDiscount = true;
                    $offers[$i]->specialDiscountedPrice = $offers[$i]->mrp_price - (($offers[$i]->mrp_price*$check[0]->discount)/100);
                    $offers[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $offers[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
            }
            return FS_Response::success('data',$offers);
    }

    public function shopOfferBanners(Request $request,$city)
    {
        if($city=='islampur')
        {
            
                $images = array(
                    array(
                        'shop' => 'lifestyle',
                        'banner' => asset('/assets/img/banner1.png'),
                        'name' => 'a'
                    ),
                    array(
                        'shop' => 'lifestyle',
                        'banner' => asset('/assets/img/banner2.png'),
                        'name' => '500 cashback on purchase of 2000'
                    ),
                    array(
                        'shop' => 'Lavanya NX',
                        'banner' => asset('/assets/img/banner3.png'),
                        'name' => '35% Off'
                    ),
                    array(
                        'shop' => 'Dress code',
                        'banner' => asset('/assets/img/banner4.png'),
                        'name' => '60% Off'
                    ),
                    array(
                        'shop' => 'Silverleaf Islampur',
                        'banner' => asset('/assets/img/banner5.png'),
                        'name' => 'Buy 2 Get 3 beyond Rs.595'
                    )
                );
                return FS_Response::success('data', $images);
        }
        if($city=='kolhapur')
        {
                $shop_name1 = 'Texas Style House';
                $shop_name2 = 'Fashion style for mens';
                $shop_name3 = 'Super star mens kids';
                $shop_name4 = 'Parth Collection';
                $name1 = DB::select('select offers from shop where name = ?',[$shop_name1]);
                $name2 = DB::select('select offers from shop where name = ?',[$shop_name2]);
                $name3 = DB::select('select offers from shop where name = ?',[$shop_name3]);
                $name4 = DB::select('select offers from shop where name = ?',[$shop_name4]);
                $images = array(
                    array(
                        'shop' => 'Texas Style House',
                        'banner' => asset('/assets/img/shopbanner1.webp'),
                        'name' => $name1[0]->offers
                    ),
                    array(
                        'shop' => 'Fashion style for mens',
                        'banner' => asset('/assets/img/shopbanner2.webp'),
                        'name' => $name2[0]->offers
                    ),
                    array(
                        'shop' => 'Super star mens kids',
                        'banner' => asset('/assets/img/shopbanner3.webp'),
                        'name' => $name3[0]->offers
                    ),
                    array(
                        'shop' => 'Parth Collection',
                        'banner' => asset('/assets/img/shopbanner4.webp'),
                        'name' => 'kolhapur Clothing'
                    )
                );
                return FS_Response::success('data',$images);
        }
    }

    public function getCategories(Request $request,$shop_name)
    {
        $shop_id = DB::select('select id from shop where name = ?',[$shop_name]);
        $categories = DB::select('select * from specialshopdiscount where shop_id = ?',[$shop_id[0]->id]);
        for($i=0;$i<count($categories);$i++)
        {
            $id = DB::select('select * from category_sub_gender where id = ?',[$categories[$i]->subcategory_id]);
            $name = DB::select('select name from sub_category where id = ?',[$id[0]->sub_category_id]);
            $categories[$i]->subcategory_name = $name[0]->name;
        }
        return FS_Response::success('data',$categories);
    }

    public function getTrendingShops(Request $request,$city)
    {
        if($city=='islampur')
            {
                $shops = DB::select('select id,name,image from shop where shop.id IN (85,78,64,46,69) ORDER BY FIELD(shop.id,85,78,64,46,69)');
            }
            if($city=='kolhapur')
            {
                $shops = DB::select('select id,name,image from shop where shop.id IN (46,41,81,34,88,35,85,78,64) ORDER BY FIELD(shop.id,46,41,81,34,88,35,85,78,64)');            
            }
            foreach ($shops as $shop) 
            {
                $shop->image = env('IMAGE_URL','https://seller.fashiostreet.com').'/shops/compress/'.$shop->image;
            }
            return FS_Response::success('data',$shops);
    }

    public function checkShop(Request $request,$shop_name)
    {
        $count = DB::select('select id from shop where name=?',[$shop_name]);
        if(count($count)==1)
        {
            return FS_Response::success('message',"successs");
        }
    }

    public function getShopMoney(Request $request,$shop_name)
    {
        $id = DB::select('select id from shop where name=?',[$shop_name]);
        $money = DB::select('select money_paying,money_receiving from shop_wallet where shop_id=?',[$id[0]->id]);
        return FS_Response::success('data',$money);
    }

    public function getShopWalletMoney(Request $request,$product_id)
    {
        $id = DB::select('select shop_id from product where id=?',[$product_id]);
        $money = DB::select('select money_paying,money_receiving from shop_wallet where shop_id=?',[$id[0]->shop_id]);
        return FS_Response::success('data',$money);
    }

    public function updateShopWalletMoney(Request $request)
    {
        $id = DB::select('select shop_id from product where id=?',[$request->product_id]);   
                    
        DB::table('shop_wallet')
            ->where('shop_id',$id[0]->shop_id)
            ->update([
                'money_paying' => $request->money_paying,
                'money_receiving' => $request->money_receiving
            ]);   
        return FS_Response::success('message',"success");
    }

    public function updateMoney(Request $request)
    {
        $id = DB::select('select id from shop where name=?',[$request->shop_name]);
        $check = DB::select('select id from shop_wallet where shop_id=?',[$id[0]->id]);
        //return FS_Response::success('data',$check);
        
        if(count($check)==1)
        {
            DB::table('shop_wallet')
            ->where('shop_id',$id[0]->id)
            ->update([
                'money_paying' => $request->money_paying,
                'money_receiving' => $request->money_receiving
            ]);   
            return FS_Response::success('message',"update");   
        }
        else
        {
            DB::table('shop_wallet')->insert([
                'shop_id' => $id[0]->id,
                'money_paying' => $request->money_paying,
                'money_receiving' => $request->money_receiving
            ]);
            return FS_Response::success('message',"add");
        }  
    }

    public function chat(Request $request)
    {
        $id = DB::select('select id,chat,contact from shop where name=?',[$request->shop_name]);
        $value = 0;
        if($id[0]->chat==null)
        {
            $value = 1;
        }
        else
        {
            $value = $id[0]->chat + 1;
        }
        DB::table('shop')
            ->where('name',$request->shop_name)
            ->update(['chat' => $value]);
        DB::table('user_actions')->insert([
            'mobile' => $request->mobile,
            'chat' => 1,
            'shop_id' => $id[0]->id,
            'created_at' => Carbon::now()
        ]);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$id[0]->contact."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=One customer want to you text message.  -Team Fashiostreet",
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
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=8600198512,7558417359,7767838215&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=One customer having mobile=".$request->mobile." want to chat with ".$request->shop_name."  -Team Fashiostreet",
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

    public function call(Request $request)
    {
        $id = DB::select('select id,phone,contact from shop where name=?',[$request->shop_name]);
        $value = 0;
        if($id[0]->phone==null)
        {
            $value = 1;
        }
        else
        {
            $value = $id[0]->phone + 1;
        }
        DB::table('shop')
            ->where('name',$request->shop_name)
            ->update(['phone' => $value]);
        DB::table('user_actions')->insert([
            'mobile' => $request->mobile,
            'phone' => 1,
            'shop_id' => $id[0]->id,
            'created_at' => Carbon::now()
        ]);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$id[0]->contact."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=One customer want to call you.  -Team Fashiostreet",
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
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=8600198512,7558417359,7767838215&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Customer having mobile no-".$request->mobile." want to call ".$request->shop_name."  -Team Fashiostreet",
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
        return FS_Response::success('data',$id);   
    }

    public function whatsapp(Request $request)
    {
        $id = DB::select('select id,whatsapp,contact from shop where name=?',[$request->shop_name]);
        $value = 0;
        if($id[0]->whatsapp==null)
        {
            $value = 1;
        }
        else
        {
            $value = $id[0]->whatsapp + 1;
        }
        DB::table('shop')
            ->where('name',$request->shop_name)
            ->update(['whatsapp' => $value]);
        DB::table('user_actions')->insert([
            'mobile' => $request->mobile,
            'whatsapp' => 1,
            'shop_id' => $id[0]->id,
            'created_at' => Carbon::now()
        ]);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$id[0]->contact."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=One customer want to whatsapp you.  -Team Fashiostreet",
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
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=8600198512,7558417359,7767838215&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Customer having mobile no-".$request->mobile." want to whatsapp ".$request->shop_name."  -Team Fashiostreet",
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
        return FS_Response::success('data',$id);  
    }

    public function visit(Request $request)
    {
        $id = DB::select('select id,contact from shop where name=?',[$request->shop_name]);
         if($request->visitDay == null)
        {
            DB::table('visit_shop')->insert([
                'number' => $request->mobile,
                'shop_id' => $id[0]->id,
                'created_at' => Carbon::now()
            ]);
        }
        else
        {
            DB::table('visit_shop')->insert([
                'number' => $request->mobile,
                'shop_id' => $id[0]->id,
                'visitDay' => $request->visitDay,
                'created_at' => Carbon::now()
            ]);   
        }
        /*$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$id[0]->contact."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Customer with mobile number=".$request->mobile." want to visit your shop.%0aCHAT WITH CUSTOMER: https://api.whatsapp.com/send?phone=91".$request->mobile."%0a- Team Fashiostreet",
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
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=".$request->mobile."&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Hurray !! Your Extra 5% FS discount has been activated.%0aTell your same whatsapp number to ".$request->shop_name." shop to get the offer.%0a- Team Fashiostreet",
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
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=FSENQY&route=4&mobiles=8600198512,7558417359,7767838215&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=Customer having mobile no-".$request->mobile." want to visit shop ".$request->shop_name." with Product id =".$request->product_id."     -Team Fashiostreet",
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
        return FS_Response::success('message','success');
    }

    public function getGenders(Request $request,$id)
    {

        $genders = DB::select('select DISTINCT name from gender inner join category_sub_gender on gender.id=category_sub_gender.gender_id
                    where category_sub_gender.id in(select category_sub_gender_id from product where shop_id=?)',[$id]);
        return FS_Response::success('data',$genders);
    }

    public function getList(Request $request,$city)
    {
        $id = '';
        $id = DB::table('city')->select(['id'])->where('name',$city)->get();
        $list = DB::select('select id from shop where city_id=?',[$id[0]->id]);
        return FS_Response::success('data',$list);
    }

    public function getShops(Request $request,$city_name)
    {
        $id = DB::table('city')->select(['id'])->where('name',$city_name)->get();
        $result = DB::select('select name,offers from shop where visible = 1 and city_id = ?',[$id[0]->id]);
        return FS_Response::success('message',$result);
    }

    public function shop_search(Request $request)
    {
        if(!isset($request->shop) || !isset($request->city))
        {
            return $this->json_error('Invalid URL found');
        }
        if($request->city == null || trim($request->city) == "" || empty($request->city))
        {
            return $this->json_error('Invalid URL found');
        }
        if($request->shop == null || trim($request->shop) == "" || empty($request->shop))
        {
            return $this->json_success('');
        }

        $city = new city();
        $cityId = $city->getCityId($request->city);
        if($cityId == false){
            return $this->json_error('Invalid city name found');
        }

        try {
            $result = DB::table('shop')->select(['name'])->where('city_id',$cityId[0]->id)->where('name', 'like', $request->shop . '%')->take(5)->get();
            if (count($result) > 0) {
                return $this->json_success($result);
            }
            else {
                $request->shop = substr($request->shop, 0, 3);
                $result = DB::table('shop')->select(['name'])->where('city_id',$cityId[0]->id)->where('name', 'like', $request->shop . '%')->take(5)->get();
                if (count($result) > 0) {
                    return $this->json_success($result);
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->json_error($e->getMessage());
        }
        return $this->json_success('No Shop Found');
    }

    /*
     * Get Shop name list
     * */
    public function shop_name_list(Request $request){
        $shop = DB::select('select shop.name from shop left join city on shop.city_id = city.id where city.name = ? and visible = 1',[$request->city]);
        /*$shop = null;
        if($request->gender == 'Men')
        {
            $shop = array(
                array(
                    'name'=>"Super star mens kids",
                ),
                array(
                    'name'=>"My Choice Men's Studio",
                ),
                array(
                    'name' => "AADIS FASHION'S"
                ),
                array(
                    'name' => "Sample"
                ),
                array(
                    'name' => "MJ Collection"
                ),
                array(
                    'name' => "Status a fastion destinestion"
                ),
                array(
                    'name' => "Spice men's studio"
                ),
                array(
                    'name' => "PARTH collection"
                ),
                array(
                    'name' => "ICONIC FASHION"
                ),
                array(
                    'name' => "Style_hub_wear"
                ),
                array(
                    'name' => "Fashion style for mens"
                ),
                array(
                    'name' => "Texas Style House"
                ),
                array(
                    'name' => "Youth icon"
                ),
                array(
                    'name' => "Urban life"
                )
            );
        }
        if($request->gender == 'Footwear')
        {
            $shop = array(
                array(
                    'name'=>'Kingz'
                ),
                array(
                    'name'=>'Jaky Footwear'
                ),
                array(
                    'name' => 'Vinayak shoe'
                )
            );
    
        }
        if($request->gender == 'Deodorant')
        {
            $shop = array(
                array(
                    'name'=>'Bahirshet'
                )
            );
        }*/
        //$shop1 = (array)DB::select('select * from shop');
        return FS_Response::success('data',$shop);
    }

    public function shop_name_list1(Request $request){
        $shop = null;
        if($request->gender == 'Men')
        {
            $shop = array(
                array(
                    'name'=>"Super star mens kids",
                ),
                array(
                    'name'=>"My Choice Men's Studio",
                ),
                array(
                    'name' => "AADIS FASHION'S"
                ),
                array(
                    'name' => "Sample"
                ),
                array(
                    'name' => "MJ Collection"
                ),
                array(
                    'name' => "Status a fastion destinestion"
                ),
                array(
                    'name' => "Spice men's studio"
                ),
                array(
                    'name' => "PARTH collection"
                ),
                array(
                    'name' => "ICONIC FASHION"
                ),
                array(
                    'name' => "Style_hub_wear"
                ),
                array(
                    'name' => "Fashion style for mens"
                ),
                array(
                    'name' => "Texas Style House"
                ),
                array(
                    'name' => "Youth icon"
                ),
                array(
                    'name' => "Urban life"
                )
            );
        }
        if($request->gender == 'Footwear')
        {
            $shop = array(
                array(
                    'name'=>'Kingz'
                ),
                array(
                    'name'=>'Jaky Footwear'
                ),
                array(
                    'name' => 'Vinayak shoe'
                )
            );
    
        }
        if($request->gender == 'Deodorant')
        {
            $shop = array(
                array(
                    'name'=>'Bahirshet'
                )
            );
        }
        return FS_Response::success('data',$shop);
    }


    public function shop_list(Request $request,$city,$json = 'view')
    {
        try
        {
            if(strtolower($request->shop) != 'all shop')
            {
                return Redirect::to('/shop/'.$city.'/available-category?shop='.$request->shop);
            }
            if(!isset($request->page))
            {
                $request->page = 1;
            }
            $min = (int)$request->page;  //page validate
            $max = 15;
            $min = (($min - 1)*$max);

            $obj = new city();
            $city_id = $obj->getCityId($city);
            if($city_id == false) {
                if($json == 'json')
                {
                    return FS_Response::error(500,'sorry we are not connected with your city right now');
                }
                return view('fashiostreet_client::404'); //convert json error to page
            }
            $data = array('city' => $city,'shop_name' => $request->shop);
            unset($city);
            $result = (array) DB::select('select id,name,image,offers,contact,alternate_contact,address,opening_time,closing_time from shop where visible=1 and city_id = ? limit ?,?',[$city_id[0]->id,$min,$max]);
            $result = $this->ChangeShopImgUrl($result);
            if(!$result)
            {
                if($json == 'json'){
                    return FS_Response::error(500,'No Shop found');  //result empty array
                }
                return view('fashiostreet_client::shop_list',['data' => $data,'shops' => []]);
            }
            if(count($result) > 0)
            {
                if($json == 'json'){
                    return $result;
                }
                else if($json == 'view')
                {
                    return view('fashiostreet_client::shop_list',['data' => $data,'shops' => $result]);
                }
                else{
                    return view('fashiostreet_client::404');
                }

            }
            if($json == 'json'){
                return [];  //result empty array
            }
            return view('fashiostreet_client::shop_list',['data' => $data,'shops' => []]);

        }
        catch (\Illuminate\Database\QueryException $e)
        {
            return $e->getMessage();
            $request = array('error' => 'Server Error found '.$e->getCode());
            if($json == 0)
                return view('fashiostreet_client::error500',['request' => $request]);
            return 'Server Error Found : '.$e->getCode();
        }
    }

    /*
     * Change Shop Image path
     * */

    public function ChangeShopImgUrl($shops,$multi = null)
    {
        foreach ($shops as $shop) {
            if(isset($shop->offers) && $shop->offers != null)
            {
                $shop->offers = explode(',',$shop->offers);
            }
            if($multi != null)
            {
                $shop->image = explode(',',$shop->image);
            }
            else{
                $shop->image = env('IMAGE_URL','https://seller.fashiostreet.com').'/shops/compress/'.$shop->image;
            }
        }
        return $shops;
    }

    /*
     * Add gender
     * */
    /*
     * Add size to product after product list out
     * */
    public function addGender_to_shop($shops)
    {
        try {
            foreach ($shops as $shop) {
                $gender = DB::select('select DISTINCT gender.name as gender,gender.id as id from gender left join tabs ON tabs.gender_id = gender.id where tabs.shop_id = ? ORDER by gender.id ASC ',[$shop->id]);
                $shop->{'gender'} = $gender;
                unset($gender);
            }
            return $shops;
        }
        catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }

    /*
     * Get list of sub-category through gender
     * */
    public function shop_sub_category(Request $request)
    {
        $city = $request->city;
        $shop = $request->shop;

        $obj = new city();
        $city_id = $obj->getCityId($city);
        if($city_id == false) {
            $error = array('code' => '500', 'msg' => 'Invalid Url or City name found');
            return $this->json_error('$error'); //convert json error to page
        }
        unset($city);

        $shop_obj = new shop();
        $shop_id = $shop_obj->getShopId($city_id[0]->id,$shop);
        if($shop_id == false)
            return $this->json_error('Invalid URl or Shop name found');
        unset($shop_obj);


        try
        {
            $data = array(array(),array(),array(),array());
            $result = DB::select('select  tabs.gender_id as gender_id,sub_category.name as sub_category,category.name as category from tabs left join sub_category ON  tabs.sub_category_id = sub_category.id left join category ON  tabs.category_id = category.id where shop_id = ?',[$shop_id[0]->id]);
            for($i=0;$i < count($result);$i++)
            {
                if($result[$i]->gender_id == 1)
                {
                    array_push($data[0],array('sub_category' => $result[$i]->sub_category,'category' => $result[$i]->category));
                }
                else if($result[$i]->gender_id == 2)
                {
                    array_push($data[1],array('sub_category' => $result[$i]->sub_category,'category' => $result[$i]->category));
                }
                else if($result[$i]->gender_id == 3)
                {
                    array_push($data[2],array('sub_category' => $result[$i]->sub_category,'category' => $result[$i]->category));
                }
                else if($result[$i]->gender_id == 4)
                {
                    array_push($data[3],array('sub_category' => $result[$i]->sub_category,'category' => $result[$i]->category));
                }
            }
            return $data;

        }
        catch (\Illuminate\Database\QueryException $e)
        {
            $error = array('code' => 500,'msg' => 'Server Error Found');
            return $error;
        }

    }

    public function shop_details(Request $request)
    {
        $city = $request->city;
        $shop = $request->shop;

        $obj = new city();
        $city_id = $obj->getCityId($city);
        if($city_id == false) {
            throw new ErrorException('invalid city name found');
        }
        unset($city);

        $shop_obj = new shop();
        $shop_id = $shop_obj->getShopId($city_id[0]->id,$shop);
        if($shop_id == false)
            return $this->json_error('Invalid URl or Shop name found');
        unset($shop_obj);

        try
        {
            $shop = shop::select(['id','name','image','offers','contact','alternate_contact','address','closed_day','opening_time','closing_time'])->findOrFail($shop_id[0]->id);
            return $shop;
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $error = array('code' => 500,'msg' => 'No Shop Found');
            return $error;
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            throw new SystemException($e->getMessage());
        }

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

}
