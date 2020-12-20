<?php

namespace fashiostreet\product;
use \DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use fashiostreet\product\Auth\User;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use FS_Response;

class ViewController extends Controller
{
    public function error(Request $request){
        return view('fashiostreet_client::error500',['request' => $request]);
    }

    public function getOfferBanners(Request $request)
    {
        $images = array(
                    array(
                        'menu' => 'Olee Bhel',
                        'banner' => asset('/assets/img/1.png'),
                        'price' => 55
                    ),
                    array(
                        'menu' => 'Double Egg Bhurji',
                        'banner' => asset('/assets/img/2.png'),
                        'price' => 65
                    ),
                    array(
                        'menu' => 'Fried Maggi',
                        'banner' => asset('/assets/img/3.png'),
                        'price' => 60
                    ),
                    array(
                        'menu' => 'Double Bread Omlette',
                        'banner' => asset('/assets/img/4.png'),
                        'price' => 55
                    )
                );
                return FS_Response::success('data', $images);
    }

    public function getAppVersion(Request $request)
    {
        $s = null;
        $o = null;
        date_default_timezone_set('Asia/Kolkata');
        $h = date("h:i a");
        $o1 = "7:30 am";
        $c1 = "12:30 pm";
        $o2 = "3:30 pm";
        $c2 = "7:00 pm";
        $o3 = "12:30 pm";
        $c3 = "3:30 pm";
        $date1 = DateTime::createFromFormat('H:i a', $h);
        $date2 = DateTime::createFromFormat('H:i a', $o1);
        $date3 = DateTime::createFromFormat('H:i a', $c1);
        $date4 = DateTime::createFromFormat('H:i a', $o2);
        $date5 = DateTime::createFromFormat('H:i a', $c2);
        $date6 = DateTime::createFromFormat('H:i a', $o3);
        $date7 = DateTime::createFromFormat('H:i a', $c3);
        if ($date1 > $date2 && $date1 < $date3)
        {
            $s = 'Open Now';
            $o = 'Closes @ 12:30 pm';
        }
        else if($date1>$date4 && $date1<$date5)
        {
            $s = 'Open Now';
            $o = 'Closes @ 7 pm';
        }
        else if($date1>$date6 && $date1<$date7)
        {
            $s = 'Closed Now';
            $o = 'Opens @ 3:30 pm';
        }
        else
        {
            $s = 'Closed Now';
            $o = 'Opens @ 7:30 am';
        }
        $data = array(
            'version' => '1.0.16',
            'link' => 'https://play.google.com/store/apps/details?id=in.moonfood.android',
            'date' => 0,
            'statusText' => 'Open Now',
            'openingText' => '',
            'd' => ''
        );
        return FS_Response::success('data',$data);
    }

    // offers function for viewing all offers - Godwin
    public function wish(Request $request,$id)
    {
        $wishlist = '';
        //$id = (int)$id;
        try {
            $wishlist = DB::select('SELECT product_id FROM wishlist WHERE users_id=?',$id);
            return FS_Response::success('data',$wishlist);
        }
        catch (\Illuminate\Database\QueryException $e) {
                            return FS_Response::error(500,'Server error found');
            return view('fashiostreet_client::error500',['request' => array('error' => 'Something Goes Wrong (server error), Please try again' )]);
        }
    }
    public function offers_shop(Request $request,$shop_name,$page)
    {
        $offers = '';
        if(!isset($page))
        {
            $page = 1;
        }
        $min = (int)$page;  //page validate
        $max = 16;
        $min = (($min - 1)*$max);
        try
        {
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
            if($shop_name == 'Powar Garments')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=3 and shop_id>33 and shop_id!=63 and discount>200 and shop_id>33 and selling_price<550 ORDER BY id DESC limit ?,?',[$min,$max]);
            }
            if($shop_name == 'RATNAMANI FASHIONS')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=1 and shop_id>33 and  selling_price<350 and shop_id>33 ORDER BY id DESC limit ?,?',[$min,$max]);
            }
            if($shop_name == 'MJ Collection')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=3 and shop_id>33 and shop_id!=63 and selling_price<550 and shop_id>33 ORDER BY id DESC limit ?,?',[$min,$max]);
            }
            if($shop_name == 'Style hub wear')
            {
                $offers = DB::select('SELECT * FROM product WHERE category_sub_gender_id=1 and shop_id>33 and shop_id!=63 and selling_price<300 and shop_id>33 ORDER BY id DESC limit ?,?',[$min,$max]);
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
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $offers[$i]->offers = $offer[0]->offers;
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
                $offer = null;
            }
            return FS_Response::success('data',$offers);
        }
        catch(\Illuminate\Database\QueryException $e)
        {

                return FS_Response::error(500,'Server error found');
            return view('fashiostreet_client::error500',['request' => array('error' => 'Something Goes Wrong (server error), Please try again' )]);
        }
    }
    public function main_page(Request $request)
    {
        $data = 0;
        if($user = Sentinel::getUser())
        {
            $data = 1;
        }
        return view('fashiostreet_client::home',['login_flag' => $data]);
    }

    public function getLeftJoin()
    {
        $data = array('category' =>array(
            array(
                'category' => 'MEN CLOTHING',
                'wear' => array(
                    array(
                        'wear' => "TOP WEAR",
                        "type" => array("Polo & T-Shirts","Casual Shirts","Sweatshirts")
                    ),
                    array(
                        'wear' => "BOTTOM WEAR",
                        "type" => array("Jeans","Cargos","Shorts and 3/4ths")
                    ),
                    array(
                        'wear' => "SPORTS WEAR",
                        "type" => array("Sports T-Shirts","Track pants","Track suits","Shorts")
                    ),
                    array(
                        'wear' => "INNERWEAR AND SLEEPWEAR",
                        "type" => array("Briefs and trunks","Vests","Boxers","Thermals")
                    ),
                    array(
                        'wear' => "FABRICS",
                        'type' => array("Shirt Fabrics","Multi-purpose Fabrics","Kurta Fabrics","Trouser Fabrics","Suit Fabrics","Safari Fabrics")
                    ),
                    array(
                        'wear' => 'OTHERS',
                        'type' => array("Raincoats","Wind cheaters")
                    ),
                    array(
                        'wear' => 'ACCESSORIES',
                        'type' => array("Socks","Ties","Cufflinks","Mufflers","Scarfs","Shirt Studs","Cravats","Bandanas","Arm warmers","Pocket squares","Handkerchiefs","Suspenders","Gloves","Turbans","Towels")
                    )

                )
            ),
            array(
                'category' => 'WOMEN CLOTHING',
                'wear' => array(
                    array(
                        'wear' => "WESTERN WEAR",
                        "type" => array("Shirts","Tops","Tunics","Kaftans","BodySuits","Polos and T-Shirts","Dresses","Jeans","Trousers","Capris","Cargos","Dungarees","Shorts and Skirts","Fashion Jackets")
                    ),
                    array(
                        'wear' => "ETHNIC WEAR",
                        "type" => array("Sarees","Kurtas","Dress Material","Lehenga Choli","Blouse","Harem Pants","Patialas","Leggings","Anarkali","Salwars","Blouse Fabrics","Chudidars")
                    ),
                    array(
                        'wear' => "WINTER AND SEASONAL",
                        "type" => array("Sweaters","Pullovers","SweatShirts","Jackets","Raincoats","Windcheaters","cardigans","coats","Ponchos","Thermals","Winter Jackets","Shawls","Mufflers","Gloves","Socks")
                    ),
                    array(
                        'wear' => "SPORTS AND GYM WEAR",
                        "type" => array("Track Pants","Track Suits","Track Tops","T-Shirts","Socks and Stockings","Tights","Caps","Sports Bras","Shorts","Sports Jackets","Sarongs")
                    ),
                    array(
                        'wear' => "LINGERIE AND SLEEP WEAR",
                        'type' => array("Bras","Panties","Night Dresses and Suits","Swim and BeachWears","Gowns")
                    )
                )
            ),
            array(
                'category' => 'BABY AND KIDS',
                'wear' => array(
                    array(
                        'wear' => "BOY'S CLOTHING",
                        "type" => array("T-Shirts","Kurtas","Raincoats","Jackets","Sweatshirts","Sweaters","Pullovers")
                    ),
                    array(
                        'wear' => "BABY BOY",
                        "type" => array("Sleep Suits","Body Suits","T-Shirts")
                    ),
                    array(
                        'wear' => "BABY GIRL",
                        "type" => array("Sleep Suits","Body Suits","Baby Girl Dresses")
                    ),
                    array(
                        'wear' => "GIRL'S CLOTHING",
                        "type" => array("Dresses","Skirts","Salwar Kurtas","Kurtas","Lehenga Choli","Ethnic Sets","Sarees","Mufflers","Thermals","Sweaters","Sweatshirts","Raincoats","Jackets")
                    )
                )
            ),
        ));
        return $this->json_success($data);
    }

    public function category_shop(Request $request,$city,$json = 'view')
    {
        if(strtolower($request->shop) == 'all shop')
        {
            return Redirect::to('/shop/'.$city.'?shop=All Shop');
        }
        $request->{'city'} = $city;
        $shop = new ShopController();
        $category = $shop->shop_sub_category($request);
        if($category == false)
        {
            if($json == 'json'){
                return response()->json('Sorry,No Category Found',500);
            }
            return view('fashiostreet_client::error500',['request' => array('error' => 'Sorry,No Category Found')]);
        }
        $shop_details = $shop->shop_details($request);
        $shop_details = $shop->ChangeShopImgUrl(array($shop_details),true);
        if($shop_details == false)
        {
            if($json == 'json'){
                return response()->json('Sorry,No Shop Details Found',500);
            }
            return view('fashiostreet_client::error500',['request' => array('error' => 'Sorry,No Shop Details Found')]);
        } 
        $product = new ProductController();
        $product = $product->getTop15ShopProduct($shop_details[0]->id);
        $category = DB::select('select * from specialshopdiscount where shop_id = ?',[$shop_details[0]->id]);
        for($k=0;$k<count($category);$k++)
        {
            $id = DB::select('select * from category_sub_gender where id = ?',[$category[$k]->subcategory_id]);
            $name = DB::select('select name from sub_category where id = ?',[$id[0]->sub_category_id]);
            $category[$k]->subcategory_name = $name[0]->name;
        }
        $data = array('city' => $city,'shop_name' => $request->shop);
        $data = array(
            'data' => $data,
            'category' => $category,
            'shop' => $shop_details,
            'products' => $product,
            'categories' => $category
        );
        if($json == 'json'){
            return response()->json($data,200);
        }
        return view('fashiostreet_client::shop_category',$data);
    }

    public function city_offer2(Request $request,$city)
    {
        return $this->city_offer($request,$city,'json');
    }

    public function getTrendingInnerwear(Request $request,$city)
    {
        if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2780,2825,2911,2930,2720,2929,1499,1967) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2780,2825,2911,2930,2720,2929)');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (1339,3792,1509,1513,1958,3781,1388,1967,2917) and product.deleted_at IS NULL ORDER BY FIELD(product.id,1339,3792,1509,1513,1958,3781,1388,1967,2917)');            
            }
            for($i=0;$i<count($products);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$products[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($products[$i]->mrp_price - $products[$i]->selling_price)/$products[$i]->mrp_price)*100;
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $products[$i]->offers = $offer[0]->offers;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $products[$i]->specialDiscount = true;
                    $products[$i]->specialDiscountedPrice = $products[$i]->mrp_price - (($products[$i]->mrp_price*$check[0]->discount)/100);
                    $products[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $products[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
                $offer = null;
            }
                        $obj = new ProductController();
            $obj->addSize_to_product($products,2);
        return FS_Response::success('data',$products);
    }

    public function getTrendingTShirts(Request $request,$city)
    {
        if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2263,2013,2341,2353,2457,2806,2340) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2263,2013,2341,2353,2457,2806,2340)');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2356,2446,3361,3386,3389,3471,3484) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2356,2446,3361,3386,3389,3471,3484)');
            }
            for($i=0;$i<count($products);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$products[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($products[$i]->mrp_price - $products[$i]->selling_price)/$products[$i]->mrp_price)*100;
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $products[$i]->offers = $offer[0]->offers;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $products[$i]->specialDiscount = true;
                    $products[$i]->specialDiscountedPrice = $products[$i]->mrp_price - (($products[$i]->mrp_price*$check[0]->discount)/100);
                    $products[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $products[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
                $offer = null;
            }
                        $obj = new ProductController();
            $obj->addSize_to_product($products,2);
        return FS_Response::success('data',$products);
    }

    public function getTrendingShirts(Request $request,$city)
    {
        if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2025,2161,2371,2377,2528,2547,2562,2813,2823,2933,2935) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2025,2161,2371,2377,2528,2547,2562,2813,2823,2933,2935)');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2530,2529,2532,2556,2566,2813,3446,3455,3458) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2530,2529,2532,2556,2566,2813,3446,3455,3458)');
            }
            for($i=0;$i<count($products);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$products[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($products[$i]->mrp_price - $products[$i]->selling_price)/$products[$i]->mrp_price)*100;
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $products[$i]->offers = $offer[0]->offers;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $products[$i]->specialDiscount = true;
                    $products[$i]->specialDiscountedPrice = $products[$i]->mrp_price - (($products[$i]->mrp_price*$check[0]->discount)/100);
                    $products[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $products[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
                $offer = null;
            }
                        $obj = new ProductController();
            $obj->addSize_to_product($products,2);
        return FS_Response::success('data',$products);
    }

    public function getTrendingJeans(Request $request,$city)
    {
        if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2070,2178,2277,2280,2298,2478,2513,2514) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2070,2178,2277,2280,2298,2478,2513,2514)');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2902,2284,2514,3480,3481,3331,3309,2065) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2902,2284,2514,3480,3481,3331,3309,2065)');
            }
            for($i=0;$i<count($products);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$products[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($products[$i]->mrp_price - $products[$i]->selling_price)/$products[$i]->mrp_price)*100;
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $products[$i]->offers = $offer[0]->offers;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $products[$i]->specialDiscount = true;
                    $products[$i]->specialDiscountedPrice = $products[$i]->mrp_price - (($products[$i]->mrp_price*$check[0]->discount)/100);
                    $products[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $products[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
                $offer = null;
            }
                        $obj = new ProductController();
            $obj->addSize_to_product($products,2);
        return FS_Response::success('data',$products);
    }

    public function getMenSuperDiscountedProducts(Request $request,$city)
    {
        if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2070,2178,2277,2280,2298,2478,2513,2514) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2070,2178,2277,2280,2298,2478,2513,2514)');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2902,2349,2385,2546,2175,2354,3342,2334,2063) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2902,2349,2385,2546,2175,2354,3342,2334,2063)');
            }
            for($i=0;$i<count($products);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$products[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($products[$i]->mrp_price - $products[$i]->selling_price)/$products[$i]->mrp_price)*100;
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $products[$i]->offers = $offer[0]->offers;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $products[$i]->specialDiscount = true;
                    $products[$i]->specialDiscountedPrice = $products[$i]->mrp_price - (($products[$i]->mrp_price*$check[0]->discount)/100);
                    $products[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $products[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
                $offer = null;
            }
                        $obj = new ProductController();
            $obj->addSize_to_product($products,2);
        return FS_Response::success('data',$products);
    }

    public function getFootwearSuperDiscountedProducts(Request $request,$city)
    {
        if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2070,2178,2277,2280,2298,2478,2513,2514) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2070,2178,2277,2280,2298,2478,2513,2514)');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2070,2178,2277,2280,2298,2478,2513,2514) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2070,2178,2277,2280,2298,2478,2513,2514)');
            }

                        $obj = new ProductController();
            $obj->addSize_to_product($products,2);
        return FS_Response::success('data',$products);
    }

    public function getTrendingKurtis(Request $request,$city)
    {
        if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2780,2825,2911,2930,2720,2929,1499,1967) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2780,2825,2911,2930,2720,2929)');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2118,2127,1525,2131,2408,2409) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2118,2127,1525,2131,2408,2409)');            
            }
                        $obj = new ProductController();
            $obj->addSize_to_product($products,2);
        return FS_Response::success('data',$products);
    }

    public function getTrendingCasualShoes(Request $request,$city)
    {
        if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2780,2825,2911,2930,2720,2929,1499,1967) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2780,2825,2911,2930,2720,2929)');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2902,3214,3005,2937,3207,2943,2936,3237) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2902,3214,3005,2937,3207,2943,2936,3237)');     
            }
            for($i=0;$i<count($products);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$products[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($products[$i]->mrp_price - $products[$i]->selling_price)/$products[$i]->mrp_price)*100;
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $products[$i]->offers = $offer[0]->offers;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $products[$i]->specialDiscount = true;
                    $products[$i]->specialDiscountedPrice = $products[$i]->mrp_price - (($products[$i]->mrp_price*$check[0]->discount)/100);
                    $products[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $products[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
                $offer = null;
            }
            $obj = new ProductController();
            $obj->addSize_to_product($products,2);
        return FS_Response::success('data',$products);
    }

    public function getTrendingChappals(Request $request,$city)
    {
        if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2962,2963,2969,2967,3012,3165,3174,3177,3178,3187) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2962,2963,2969,2967,3012,3165,3174,3177,3178,3187)');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2902,3187,2962,2963,3165,2967,3012,3174,3177,3178,2969) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2902,3187,2962,2963,3165,2967,3012,3174,3177,3178,2969)');            
            }
            for($i=0;$i<count($products);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$products[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($products[$i]->mrp_price - $products[$i]->selling_price)/$products[$i]->mrp_price)*100;
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $products[$i]->offers = $offer[0]->offers;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $products[$i]->specialDiscount = true;
                    $products[$i]->specialDiscountedPrice = $products[$i]->mrp_price - (($products[$i]->mrp_price*$check[0]->discount)/100);
                    $products[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $products[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
                $offer = null;
            }
            $obj = new ProductController();
            $obj->addSize_to_product($products,2);
        return FS_Response::success('data',$products);
    }

    public function getTrendingSandals(Request $request,$city)
    {
        if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2946,2954,2959,2960,3160,3166,3028,3033,3034) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2946,2954,2959,2960,3160,3166,3028,3033,3034)');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2902,3166,3028,3033,3034,2946,2954,2959,2960,3160) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2902,3166,3028,3033,3034,2946,2954,2959,2960,3160)');            
            }
            for($i=0;$i<count($products);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$products[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($products[$i]->mrp_price - $products[$i]->selling_price)/$products[$i]->mrp_price)*100;
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $products[$i]->offers = $offer[0]->offers;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $products[$i]->specialDiscount = true;
                    $products[$i]->specialDiscountedPrice = $products[$i]->mrp_price - (($products[$i]->mrp_price*$check[0]->discount)/100);
                    $products[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $products[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
                $offer = null;
            }
            $obj = new ProductController();
            $obj->addSize_to_product($products,2);
        return FS_Response::success('data',$products);
    }

    public function city_offer(Request $request,$city,$json = 'view')
    {
        try
        {
            $products = '';
            if($city=='islampur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (214,179,59,260,528,275,417,298,45,219,180,414,274,27,674,296,19) and product.deleted_at IS NULL');
            }
            if($city=='kolhapur')
            {
                $products = DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product LEFT JOIN shop ON shop.id = product.shop_id where product.id IN (2342,1904,3426,3437,3038,2824,3298,3300,1838,1399,3402,2902) and product.deleted_at IS NULL ORDER BY FIELD(product.id,2342,1904,3426,3437,3038,2824,3298,3300,1838,1399,3402,2902)');            
            }
            for($i=0;$i<count($products);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$products[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($products[$i]->mrp_price - $products[$i]->selling_price)/$products[$i]->mrp_price)*100;
                $offer = DB::select('select * from shop where id = ?',[$info[0]->shop_id]);
                $products[$i]->offers = $offer[0]->offers;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $products[$i]->specialDiscount = true;
                    $products[$i]->specialDiscountedPrice = $products[$i]->mrp_price - (($products[$i]->mrp_price*$check[0]->discount)/100);
                    $products[$i]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $products[$i]->specialDiscount = false;
                }
                $info = null;
                $check = null;
                $offer = null;
            }
            $obj = new ProductController();
            if(gettype($products = $obj->addSize_to_product($products,2)) == "array") {
                $shops = DB::select('select id,name,image,address from shop limit 15');
                $obj = new ShopController();
                if ((($shops = $obj->ChangeShopImgUrl($shops)) != false)) {
                    if($city=='islampur'){
                        if($json == 'json')
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
                            return FS_Response::success('data',['products' => $products,'shops' => $shops,'images' => $images]);
                        }
                    }
                    if($city=='kolhapur')
                    {
                        if($json == 'json')
                        {
                            $images = array(
                     
                                array(
                                    'shop' => 'Mrn',
                                    'banner' => asset('/assets/img/banner6.png'),
                                    'name' => '500 cashback on purchase of 2000'
                                ),
                                array(
                                    'shop' => 'Parth Collection',
                                    'banner' => asset('/assets/img/banner7.png'),
                                    'name' => 'Kolhapur Clothing'
                                ),
                                array(
                                    'shop' => 'Powar Garments',
                                    'banner' => asset('/assets/img/banner8.png'),
                                    'name' => 'Shirts Around ₹550'
                                ),
                                
                                array(
                                    'shop' => 'RATNAMANI FASHIONS',
                                    'banner' => asset('/assets/img/banner9.png'),
                                    'name' => 'T-Shirts Around ₹299'
                                )
                            );
                            return FS_Response::success('data',['products' => $products,'shops' => $shops,'images' => $images]);
                        }
                    }
                    return view('fashiostreet_client::city_offer', ['data' => array('city' => $city, 'shop_name' => $request->shop), 'products' => $products, 'shops' => $shops]);
                }
            }
            if($json == 'json')
            {
                return FS_Response::error(500,'Failed to load size to product');
            }
            return view('fashiostreet_client::error500',['request' => array('error' => 'Something Goes Wrong, Please try again')]);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            if($json == 'json')
            {
                return FS_Response::error(500,'Server error found');
            }
            return view('fashiostreet_client::error500',['request' => array('error' => 'Something Goes Wrong (server error), Please try again' )]);
        }
    }


    public function product_list(Request $request,$city,$sub_category,$json = 'view')
    {
        $data = array('city' => $city,'shop_name' => $request->shop,'page' => $request->page,'sub_category' => $sub_category);
        if(isset($request->q))
        {
            $data['q'] = $request->q;
        }
        $product = new ProductController();
        $product = $product->getProduct($request,$city,$sub_category,true);
        if($json == 'json')
        {
            return FS_Response::success('data',$product);
        }
        $request->{'error'} = 'Sorry!,No Product Found';
        if(gettype($product) != 'array')
        {
            if(strcasecmp($product,"Invalid Url or City name found") == 0)
            {
                $data['flag'] = 0;
            }
            $product = [];
        }
        return view('fashiostreet_client::product_list',['data' => $data,'products' => $product,'request' => $request]);
    }
    public function product_list1(Request $request,$city,$sub_category,$json = 'view')
    {
        $data = array('city' => $city,'shop_name' => $request->shop,'page' => $request->page,'sub_category' => $sub_category);
        if(isset($request->q))
        {
            $data['q'] = $request->q;
        }
        $product = new ProductController();
        $product = $product->getProduct($request,$city,$sub_category,true);
        if($json == 'json')
        {
            return FS_Response::success('data',$product);
        }
        $request->{'error'} = 'Sorry!,No Product Found';
        if(gettype($product) != 'array')
        {
            if(strcasecmp($product,"Invalid Url or City name found") == 0)
            {
                $data['flag'] = 0;
            }
            $product = [];
        }
        return view('fashiostreet_client::productList',['data' => $data,'products' => $product,'request' => $request]);
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
