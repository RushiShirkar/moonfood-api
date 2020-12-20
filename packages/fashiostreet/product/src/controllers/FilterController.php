<?php

namespace fashiostreet\product;

use fashiostreet\product\Exceptions\SystemException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    /*
     * Color filter
     * @request (array) , $filter (string)
     * return : array(error) or string(success);
     * */
    public function color(Request $request,$filter)
    {
        if(stripos($request->color,'and') != false)
        {
            //multiple colors found
            $color_array = explode(' and ',$request->color);
            if(count($color_array) > 5)
            {
                $error = array('code' => '500','msg' => 'Only 5 Color Filters Allow');
                return $error;
            }
            $request->color = "'".$color_array[0]."'";
            for($i=1;$i < count($color_array);$i++)
            {
                $request->color = $request->color.",'".$color_array[$i]."'";
            }
            unset($color_array);
        }
        else
        {
            $request->color = "'".$request->color."'";
        }
        $product = new product();
        $color_id = $product->getColorId($request->color);
        if($color_id == false) {
            throw new SystemException('invalid color value found');
        }
        $color = "'".$color_id[0]->id."'";
        for($i=1;$i < count($color_id);$i++)
        {
            $color = $color.",'".$color_id[$i]->id."'";
        }
        unset($product);
        $filter = $filter." and product_color.color_id  IN(".$color.")"; //set filter
        unset($color);
        unset($color_id);
        return $filter;
    }

    /*
     * discount filter
     * @request (array) , $filter (string)
     * return : array(error) or string(success);
     * */
    public function discount($request,$filter)
    {
        $discount_filter = '(';
        if (stripos($request->discount, 'and') != false) {
            $discount_array = explode(' and ', $request->discount);
            if(count($discount_array) > 5)
            {
                $error = array('code' => '500','msg' => 'Only 5 Discount Filters Allow');
                return $error;
            }

            for ($i = 0; $i < count($discount_array); $i++) {
                $discount = explode('-', $discount_array[$i]);
                if (count($discount) > 2) {
                    $error = array('code' => '500','msg' => 'Invalid Url or Discount Found');
                    return $error;
                }
                $discount[0] = (int)$discount[0];
                $discount[1] = (int)$discount[1];
                if ($discount[0] < 0 || $discount[0] >= 100 || $discount[1] < 0 || $discount[1] > 100 || $discount[0] > $discount[1]) {
                    $error = array('code' => '500','msg' => 'Invalid Url or Discount Found');
                    return $error;
                }
                if ($i == 0) {
                    $discount_filter = $discount_filter . 'discount between ' . $discount[0] . ' and ' . $discount[1];   //filter set
                } else {
                    $discount_filter = $discount_filter . ' or discount between ' . $discount[0] . ' and ' . $discount[1];   //filter set
                }

            }
            unset($discount);
            unset($discount_array);
        } else {
            $discount = explode('-', $request->discount);
            if (count($discount) > 2) {
                $error = array('code' => '500','msg' => 'Invalid Url or Discount Found');
                return $error;
            }
            $discount[0] = (int)$discount[0];
            $discount[1] = (int)$discount[1];
            if ($discount[0] < 0 || $discount[0] >= 100 || $discount[1] < 0 || $discount[1] > 100 || $discount[0] > $discount[1]) {
                $error = array('code' => '500','msg' => 'Invalid Url or Discount Found');
                return $error;
            }
            $discount_filter = $discount_filter . ' discount between ' . $discount[0] . ' and ' . $discount[1];   //filter set
            unset($discount);
        }
        $discount_filter = $discount_filter.')';
        $filter = $filter.' and '.$discount_filter;
        unset($discount_filter);
        return $filter;
    }

    /*
     * price filter
     * @request (array) , $filter (string)
     * return : array(error) or string(success);
     * */

    public function price($request,$filter)
    {
        $price_filter = '(';
        if (stripos($request->price, 'and') != false) {
            $price_array = explode(' and ', $request->price);

            if(count($price_array) > 5)
            {
                $error = array('code' => '500','msg' => 'Only 5 Price Filters Allow');
                return $error;
            }

            for ($i = 0; $i < count($price_array); $i++) {
                $price = explode('-', $price_array[$i]);
                if (count($price) > 2) {
                    $error = array('code' => '500','msg' => 'Invalid Url or Price Found 1');
                    return $error;
                }
                $price[0] = (int)$price[0];
                $price[1] = (int)$price[1];
                if ($price[0] < 0 || $price[1] < 0 || $price[0] > $price[1]) {
                    $error = array('code' => '500','msg' => 'Invalid Url or Price Found 2');
                    return $error;
                }
                if ($i == 0) {
                    $price_filter = $price_filter . 'selling_price between ' . $price[0] . ' and ' . $price[1];   //filter set
                } else {
                    $price_filter = $price_filter . ' or selling_price between ' . $price[0] . ' and ' . $price[1];   //filter set
                }

            }
            unset($price);
            unset($price_array);
        } else {
            $price = explode('-', $request->price);
            if (count($price) > 2) {
                $error = array('code' => '500','msg' => 'Invalid Url or Price Found 3');
                return $error;
            }
            $price[0] = (int)$price[0];
            $price[1] = (int)$price[1];
            if ($price[0] < 0 || $price[1] < 0 || $price[0] > $price[1]) {
                $error = array('code' => '500','msg' => 'Invalid Url or Price Found 4');
                return $error;
            }
            $price_filter = $price_filter . ' selling_price between ' . $price[0] . ' and ' . $price[1];   //filter set
            unset($price);
        }
        $price_filter = $price_filter.')';
        $filter = $filter.' and '.$price_filter;
        unset($price_filter);
        return $filter;
    }

    /*
     * size filter
     * @request (array) , $filter (string)
     * return : array(error) or string(success);
     * */

    public function size($request,$filter)
    {
        if(stripos($request->size,'and') != false)
        {
            //multiple colors found
            $size_array = explode(' and ',$request->size);
            if(count($size_array) > 5)
            {
                $error = array('code' => '500','msg' => 'Only 3 Size Filters Allow');
                return $error;
            }
            $request->size = "'".$size_array[0]."'";
            for($i=1;$i < count($size_array);$i++)
            {
                $request->size = $request->size.",'".$size_array[$i]."'";
            }
            unset($size_array);
        }
        else
        {
            $request->size = "'".$request->size."'";
        }
        $product = new product();
        $size_id = $product->getSizeId($request->size);
        if($size_id == false) {
            throw new SystemException('invalid size value found');
        }
        $size = "'".$size_id[0]->id."'";
        for($i=1;$i < count($size_id);$i++)
        {
            $size = $size.",'".$size_id[$i]->id."'";
        }
        unset($product);
        $filter = $filter." and product_size.size_id  IN(".$size.")"; //set filter
        unset($size);
        unset($size_id);
        return $filter;
    }

    /*
     * Search Product Filter
     * */
    public function search($request,$filter)
    {

            $array = explode(" ",$request->q);
            if(count($array) == 0)
            {
                $error = array('code' => '500','msg' => 'Invalid Url or Search Found');
                return $error;
            }
            $data = " (keyword like '%".$array[0]."%'";
            for($i=1;$i < count($array);$i++)
            {
                if(trim($array[$i]," ") != ''){
                    $data = $data." or keyword like '%".$array[$i]."%'";
                }
            }
            $data = $data.')';
            return $filter .' and '. $data;
    }

}