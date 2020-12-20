<?php

namespace fashiostreet\product;

use Carbon\Carbon;
use fashiostreet\product\Auth\User;
use fashiostreet\product\Exceptions\SystemException;
use fashiostreet\product\Exceptions\ErrorException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use FS_Response;

class ProductController extends Controller
{

    const product_filter = [
        'price',
        'discount',
        'color',
        'size'
    ];

    /*
     * product suggestion
     * */
    public function product_search(Request $request)
    {
        $request->shop = strtolower($request->shop);
        if(!isset($request->shop) || !isset($request->city) || !isset($request->q))
        {
            return $this->json_error('Invalid URL found');
        }
        if($request->city == null || trim($request->city) == "" || empty($request->city))
        {
            return $this->json_error('Invalid URL found');
        }

        $city = new city();
        $city_id = $city->getCityId($request->city);
        if($city_id == false)
            return $this->json_error('Invalid Url or City name found');
        unset($city);

        $filter = 'shop.city_id = '.$city_id[0]->id;

        if($request->shop != 'all shop')
        {
            $shop = new shop();
            $shop_id = $shop->getShopId($city_id[0]->id,$request->shop);
            if($shop_id == false)
                return $this->json_error('Invalid Url or Shop name found');
            unset($shop);
            $filter = $filter.' and product.shop_id ='.$shop_id[0]->id;
        }

        try
        {
            $array = explode(" ",$request->q);
            if(count($array) == 0)
            {
                return $this->json_error('Invalid Url or search result found');
            }
            $data = " (keyword like '%".$array[0]."%'";
            for($i=1;$i < count($array);$i++)
            {
                $data = $data." or keyword like '%".$array[$i]."%'";
            }
            $data = $data.')';
            $product = DB::select('select keyword from product left join shop on product.shop_id = shop.id where '.$filter.' and product.deleted_at IS NULL and '.$data.' limit 7');
            if(count($product) > 0)
            {
                return $this->json_success($product);
            }
            return $this->json_success('No Product Found');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            return $this->json_error($e->getMessage());
        }
    }

    /*
     * get product sizes
     * */

    public function getProductSizes(Request $request)
    {
        $product = new product();
        $product = $product->getSizes($request->gender,$request->category,$request->sub_category);
        if($product)
            return FS_Response::success('data',$product);
        return FS_Response::error(500,'no sizes found');
    }

    /*
     * get product list
     * @argu filter : array
     * return product_list : array
     * */
    public function getProduct(Request $request,$city,$sub_category,$noexception = false)
    {
        // add validation  before function start

        $filter = '';
        $data = array('city' => $city,'sub_category' => $sub_category,'shop_name' => $request->shop,'gender' => $request->gender,'category' => $request->category,'url' => url()->full());
        $request->shop = strtolower($request->shop);

        $obj = new city();
        $city_id = $obj->getCityId($city);
        if($city_id == false)
            return 'Invalid Url or City name found';
        unset($city);
        $filter = 'shop.city_id = '.$city_id[0]->id;

        if(!isset($request->q)) {
            $obj = new product();
            $c_s_g_id = $obj->getC_S_G_id($request->gender,$request->category,$sub_category);
            $filter = $filter . ' and product.category_sub_gender_id = ' . $c_s_g_id[0]->id;
            unset($obj);
        }
        $join = ' left join shop on shop.id = product.shop_id';     //join variable check what table need to be join
        if($request->shop != 'all shop')
        {
            $shop = new shop();
            $shop_id = $shop->getShopId($city_id[0]->id,$request->shop);
            if($shop_id == false)
                return $this->json_error('Invalid Url or Shop name found');
            unset($shop);
            $filter = $filter.' and product.shop_id = '.$shop_id[0]->id;
        }
        $filter = $this->checkProductFilter($request,$filter);  //check filter found and add filter to product
        if(gettype($filter) == 'array')
        {
            $filter = array($filter);
            return $this->json_error($filter);
        }

        if(isset($request->size))
        {
            $join = $join.' left join product_size on product.id = product_size.product_id';
        }
        if(isset($request->color))
        {
            $join = $join.' left join product_color on product_color.product_id = product.id';
        }
        $sort = $this->checkProductSort($request);
        if(!isset($request->page))
        {
            $request->page = 1;
        }
        $obj = new User();
        $userID = null;
        if($request->hasHeader('local-id'))
        {
            $userID = $obj->getUserId($request);
        }
        $product = $this->getProduct_list($filter,$join,$sort,16,$request->page,$userID,$noexception);
        if(gettype($product) != 'array')
        {
            return $this->json_error('No Product Found');
        }
        if(count($product) > 0)
        {
            return $product;
        }
        return $this->json_error('No Product Found');

    }
    /*
     * these function check whether qty is 0 or not first
     * */
    public function removeSize_from_product($product_id,$size_id){
        return $this->withError(function () use($product_id,$size_id){
            $updated = DB::table('product_size')
                ->where('product_id',$product_id)
                ->where('size_id',$size_id)
                ->update([
                    'deleted_at' => Carbon::now()
                ]);
            if($updated <= 0 || $updated == null || $updated == false)
            {
                throw new SystemException('failed to update product qty');
            }
            return true;
        });
    }

    public function decreaseProductSizeQty($product_id,$size_id){
        return $this->withError(function () use($product_id,$size_id){
            $size = (array) DB::select('select qty from product_size where product_id = ? and size_id = ? and deleted_at IS NULL limit 1',[$product_id,$size_id]);
            if(count($size) > 0)
            {
                $qty = (int)$size[0]->qty;
                if($qty <= 1)
                {
                    $this->removeSize_from_product($product_id,$size_id);
                }
                else{
                    $qty = $qty - 1;
                    $updated = DB::table('product_size')
                        ->where('product_id',$product_id)
                        ->where('size_id',$size_id)
                        ->update([
                            'qty' => $qty
                        ]);
                    if($updated <= 0 || $updated == null || $updated == false)
                    {
                        throw new SystemException('failed to update product qty');
                    }
                }
                return true;
            }
            throw new SystemException('No sizes found');
        });
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

    /*
     * Add size to product after product list out
     * */
    public function addSize_to_product($shop_product,$img_flag = 0,$userID = null)
    {
        try {
            foreach ($shop_product as $product) {
                if($img_flag != 2)
                {
                    $size = DB::select('SELECT size.name as size from product_size LEFT JOIN size on size.id = product_size.size_id WHERE product_id = ? and product_size.deleted_at IS NULL', [$product->id]);
                    $product->{'size'} = $size;
                }
                if(isset($product->offers))
                {
                    $product->offers = explode(",",$product->offers);
                }
                if($img_flag == 1) {
                    $product->image = explode(',',$product->image);
                    for($i=0;$i < count($product->image) ;$i++)
                    {
                        $product->image[$i] = env('IMAGE_URL','https://seller.fashiostreet.com').'/products/compress420X458/'.$product->image[$i];
                    }
                    $product->image = array_reverse($product->image);
                }
                else if($img_flag == 2)
                {
                    $product->image = explode(',',$product->image);
                    $data = env('IMAGE_URL','https://seller.fashiostreet.com').'/products/compress220X258/'.$product->image[count($product->image) - 1];
                    $product->image = array($data);
                    unset($data);
                }
                else{
                    $product->image = explode(',',$product->image);
                    $product->image = env('IMAGE_URL','https://seller.fashiostreet.com').'/products/compress220X258/'.$product->image[count($product->image) - 1];
                }
                if($userID != null)
                {
                    $product = $this->addWishlistFlag($userID,$product);
                }
                else{
                    $product->wishlistflag = 0;
                }
                unset($size);
            }
            return $shop_product;
        }
        catch (\Illuminate\Database\QueryException $e) {

            throw new SystemException('Server error found,please retry again');
        }
    }

    /*
     * Sort by
     * */
    private function checkProductSort($request)
    {
        $sort = '';
        if(isset($request->sort))
        {
            $request->sort = strtolower($request->sort);
            if($request->sort == 'ltoh')
            {
                $sort = 'ASC';
            }
            else if($request->sort == 'htol')
            {
                $sort = 'DESC';
            }
        }
        return $sort;
    }

    /*
     * Add filter to your product
     * */

    private function checkProductFilter($request,$filter){

        $filter_obj = new FilterController();

        if(isset($request->q)){         //search filter
            $filter = $filter_obj->search($request,$filter);
            if(gettype($filter) == 'array')
            {
                return $this->json_error($filter);
            }
        }


        if(isset($request->color)) {     //color filter
            $filter = $filter_obj->color($request,$filter);
            if(gettype($filter) == 'array')
            {
                return $this->json_error($filter);
            }
        }

        if(isset($request->discount)) {  //discount filter
            $filter = $filter_obj->discount($request,$filter);
            if(gettype($filter) == 'array')
            {
                return $this->json_error($filter);
            }
        }


        if(isset($request->price)) {      //price filter
            $filter = $filter_obj->price($request,$filter);
            if(gettype($filter) == 'array')
            {
                return $this->json_error($filter);
            }
        }

        if(isset($request->size)){      //size filter
            $filter = $filter_obj->size($request,$filter);
            if(gettype($filter) == 'array')
            {
                return $this->json_error($filter);
            }
        }
        return $filter;
    }

    /*
     * Add wishlist flag
     * */
    private function addWishlistFlag($user_id,$product)
    {
        try {
            $wishlist = DB::select('select id from `wishlist` where users_id = ? and product_id = ? and deleted_at IS NULL  limit 1',[$user_id,$product->id]);
            if(count($wishlist) > 0)
                $product->{'wishlistflag'} = 1;
            else
                $product->{'wishlistflag'} = 0;
            return $product;
        }
        catch (\Illuminate\Database\QueryException $e) {
            return false;
        }
    }
    /*
     *  Get Search Product list
     * */
    public function getSearchProduct(Request $request,$city,$q)
    {
        return 'Hello world';
    }



    /*
     * Get product list from query but without size filter
     * */
    private function getProduct_list($filter,$join,$sort,$max = 16,$min = 1,$userID = null,$noexception = false)
    {

        try
        {

            $min = (int)$min;
            $min = (($min - 1)*$max);

            if($sort != '')
            {
                $sort = 'order by product.selling_price '.$sort;
            }
            $product = (array) DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product '.$join.' where '.$filter.' and product.deleted_at IS NULL  '.$sort.' limit ?,?',[$min,$max]);
            for($i=0;$i<count($product);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$product[$i]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($product[$i]->mrp_price - $product[$i]->selling_price)/$product[$i]->mrp_price)*100;
                $offer = DB::select('select offers from shop where id = ?',[$info[0]->shop_id]);
                $product[$i]->offers = $offer[0]->offers;
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
            if(count($product) > 0)
            {
                $product = $this->addSize_to_product($product,2,$userID);
            }
            else
            {
                if($noexception == true) {
                    $product = [];
                }
                else{
                    throw new ErrorException('no product found');
                }
            }

            return $product;
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            throw new SystemException($e->getMessage());
        }
    }


    /*
     * Get Top 15 product
     * */
    public function top15(Request $request)
    {
        $city = $request->city;
        $shop = $request->shop;
        $page = $request->page;

        $obj = new city();
        $city_id = $obj->getCityId($city);
        if($city_id == false)
            return false;
        unset($city);

        $shop_obj = new shop();
        $shop_id = $shop_obj->getShopId($city_id[0]->id,$shop);
        if($shop_id == false)
            return false;
        unset($shop_obj);

        $join = ' left join shop on shop.id = product.shop_id';
        $filter = ' product.shop_id = '.$shop_id[0]->id;

        return $this->getProduct_list($filter,$join,'',5,$page);
    }

    public function getTop15ShopProduct($shop_id){
        $join = ' left join shop on shop.id = product.shop_id';
        $filter = 'product.shop_id = '.$shop_id;
        //return $this->getProduct_list($filter,$join,'',15,1);
        $userID = null;
        $product = (array) DB::select('select product.id as id,product.image,product.name as name,product.mrp_price,product.selling_price,shop.name as shop_name from product left join shop on shop.id = product.shop_id where product.shop_id='.$shop_id.' and product.deleted_at IS NULL order by id DESC limit 0,15');
        if(count($product) > 0)
        {
            $product = $this->addSize_to_product($product,2,$userID);
            for($i=0;$i<count($product);$i++)
            {
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$product[$i]->id]);
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
        }
        return $product;
    }

    /*
     * getProduct_full_data
     * used for to get product details through product_id
     * */

    public function getProduct_full_data(Request $request,$city,$product_name,$product_id,$json = 'view')
    {
        $userID = null;
        if($request->hasHeader('local-id'))
        {
            $obj = new User();
            $userID = $obj->getUserId($request);
        }
        try
        {
            if(!isset($request->shop))
            {
                $request->{'shop'} = 'All Shop';
            }

            $obj = new city();
            $city_id = $obj->getCityId($city);
            if($city_id == false){
                if($json == 'json'){
                    return response()->json('invalid url found',500);
                }
                return view('fashiostreet_client::404');
            }

            $product = (array) DB::select('SELECT product.id as id,product.name as name, product.image, mrp_price, selling_price, description, brand.name as brand,city.name as city, `type`.name as type, shop.offers as offers,shop.contact as contact,shop.name as shop_name,GROUP_CONCAT(color.name separator \',\') as color from product left join brand on brand.id = product.brand_id left join `type` on `type`.id = product.type_id left join product_color ON product_color.product_id = product.id LEFT JOIN color ON color.id = product_color.color_id LEFT JOIN shop ON product.shop_id = shop.id left join city on city.id = shop.city_id where product.id = ? and product.name = ? GROUP BY product.id,product.name, product.image, mrp_price, selling_price, description, brand.name, `type`.name, shop_name,contact,offers,city limit 1',[$product_id,$product_name]);
            if(count($product) > 0)
            {
                $obj = new product();
                $c_s_g =  $obj->getC_S_G_from_p_id($product[0]->id);
                $product[0]->gender = $c_s_g[0]->gender;
                $product[0]->category = $c_s_g[0]->category;
                $product[0]->sub_category = $c_s_g[0]->sub_category;
                $product = $this->addSize_to_product($product,1,$userID);
                $shop_id = DB::select('select shop_id from product where id = ?',[$product[0]->id]);
                $category = DB::select('select * from specialshopdiscount where shop_id = ?',[$shop_id[0]->shop_id]);
                $offer = DB::select('select offerDate,offers from shop where id = ?',[$shop_id[0]->shop_id]);
                $product[0]->offers = $offer[0]->offers;
                $product[0]->offerDate = date("d",strtotime($offer[0]->offerDate));
                $monthNo = date("m",strtotime($offer[0]->offerDate));
                $month =null;
                if($monthNo=='01')
                {
                    $month = 'Jan';
                }
                else if($monthNo=='02')
                {
                    $month = 'Feb';
                }
                else if($monthNo=='03')
                {
                    $month = 'Mar';
                }
                else if($monthNo=='04')
                {
                    $month = 'Apr';
                }
                else if($monthNo=='05')
                {
                    $month = 'May';
                }
                else if($monthNo=='06')
                {
                    $month = 'June';
                }
                else if($monthNo=='07')
                {
                    $month = 'July';
                }
                else if($monthNo=='08')
                {
                    $month = 'Aug';
                }
                else if($monthNo=='09')
                {
                    $month = 'Sept';
                }
                else if($monthNo=='10')
                {
                    $month = 'Oct';
                }
                else if($monthNo=='11')
                {
                    $month = 'Nov';
                }
                else if($monthNo=='12')
                {
                    $month = 'Dec';
                }
                $product[0]->offerMonth = $month;
                for($k=0;$k<count($category);$k++)
                {
                    $id = DB::select('select * from category_sub_gender where id = ?',[$category[$k]->subcategory_id]);
                    $name = DB::select('select name from sub_category where id = ?',[$id[0]->sub_category_id]);
                    $category[$k]->subcategory_name = $name[0]->name;
                }
                $product[0]->categories = $category;
                $info = DB::select('select category_sub_gender_id,shop_id from product where id = ?',[$product[0]->id]);
                $check = DB::select('select * from specialshopdiscount where shop_id = ? and subcategory_id = ?',[$info[0]->shop_id,$info[0]->category_sub_gender_id]);
                $discount = (($product[0]->mrp_price - $product[0]->selling_price)/$product[0]->mrp_price)*100;
                if(count($check)>0 && $discount<=$check[0]->discount)
                {
                    $product[0]->specialDiscount = true;
                    $product[0]->specialDiscountedPrice = $product[0]->mrp_price - (($product[0]->mrp_price*$check[0]->discount)/100);
                    $product[0]->specialDiscountedPercentage = $check[0]->discount;
                }
                else
                {
                    $product[0]->specialDiscount = false;
                }
                if($product)
                {
                    if($json == 'json'){
                        return FS_Response::success('data',$product);
                    }
                    //return dd(['product' => $product,'data' => array('city' => $city,'shop_name' => $request->shop)]);
                    return view('fashiostreet_client::product_details',['product' => $product,'data' => array('city' => $city,'shop_name' => $request->shop)]);
                }
                if($json == 'json'){
                    return FS_Response::error(500,'!Sizes error found');
                }
                return view('fashiostreet_client::error500',['request' => array('error' => '!Sizes error found')]);
            }
            return FS_Response::error(500,'!No data found');
        }
        catch (\Illuminate\Database\QueryException $e) {
            if($json == 'json'){
                throw new SystemException($e->getMessage());
            }
            return view('fashiostreet_client::error500',['request' => array('error' => 'Server Error Found : '.$e->getCode())]);
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
