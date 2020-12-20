<?php

namespace fashiostreet\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class shop extends Model
{
    protected $table = 'shop';


    /*
     * Get cityId from city name
     * @ cityname(string)
     * */
    public function getShopId($city_id,$shop_name){
        try
        {
            $shop = DB::select('select id from shop where city_id =? and name = ? limit 1',[$city_id,$shop_name]);
            if(count($shop) > 0)
                return $shop;
            return false;
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return false;
        }
    }
}
