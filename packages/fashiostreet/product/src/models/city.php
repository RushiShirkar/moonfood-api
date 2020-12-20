<?php

namespace fashiostreet\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class city extends Model
{
    protected $table = 'city';


    /*
     * Get cityId from city name
     * @ cityname(string)
     * */
    public function getCityId($city_name){
        try
        {
            $city = DB::select('select id from city where name = ? limit 1',[$city_name]);
            if(count($city) > 0)
                return $city;
            return false;
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return false;
        }
    }
}
