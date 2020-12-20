<?php

namespace fashiostreet\product;

use fashiostreet\product\Exceptions\ErrorException;
use fashiostreet\product\Exceptions\SystemException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class product extends Model
{
    use SoftDeletes;

    protected $table = 'product';

    protected $dates = ['deleted_at'];

    public function getC_S_G_id($gender,$category,$sub_category)
    {
        return $this->withError(function () use($gender,$category,$sub_category){
            $c_s_g_id = (array) DB::select('CALL Get_Category_Sub_Gender_id(?,?,?)',[$gender,$category,$sub_category]);
            if(count($c_s_g_id) <= 0)
            {
                throw new ErrorException('Invalid Parameter Value Found');
            }
            return $c_s_g_id;
        });
    }
    public function getC_S_G_from_p_id($p_id)
    {
        return $this->withError(function () use ($p_id){
            $c_s_g = (array) DB::select('select gender.name as gender,category.name as category,sub_category.name as sub_category from category_sub_gender left join gender on gender.id = category_sub_gender.gender_id left join category on category.id = category_sub_gender.category_id left join sub_category on sub_category.id = category_sub_gender.sub_category_id left join product on product.category_sub_gender_id = category_sub_gender.id where product.id = ? limit 1',[$p_id]);
            if(count($c_s_g) <= 0)
            {
                throw new ErrorException('Invalid Product Value Found');
            }
            return $c_s_g;
        });
    }
    public function getSub_CategoryId($sub_category)
    {
        try
        {
            $sub_category = strtolower($sub_category);
            $sub_category_id = DB::select('select id from sub_category where name = ? limit 1',[$sub_category]);
            if(count($sub_category_id) > 0)
                return $sub_category_id;
            return false;
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return false;
        }
    }

    public function getGenderId($gender)
    {
        try
        {
            $gender_id = DB::select('select id from gender where name = ? limit 1',[$gender]);
            if(count($gender_id) > 0)
                return $gender_id;
            return false;
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return false;
        }
    }

    public function getCategoryId($category)
    {
        try
        {
            $category_id = DB::select('select id from category where name = ? limit 1',[$category]);
            if(count($category_id) > 0)
                return $category_id;
            return false;
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return false;
        }
    }

    public function getColorId($color)
    {
        try
        {
            $color_id = DB::select('select id from color where name IN('.$color.')');
            if(count($color_id) > 0)
                return $color_id;
            return false;
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return false;
        }
    }

    public function getSizeId($size)
    {
        try
        {
            $size_id = DB::select('select id from size where name IN('.$size.')');
            if(count($size_id) > 0)
                return $size_id;
            return false;
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return false;
        }

    }

    public function getSizeId2($size)
    {
        try
        {
            $size_id = DB::select('select id from size where name = ? limit 1',[$size]);
            if(count($size_id) > 0)
                return $size_id;
            return false;
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return false;
        }

    }

    public function getSizes($gender,$catgory,$sub_category)
    {
        $g_c_s_id = $this->getC_S_G_id($gender,$catgory,$sub_category);
        try
        {
        $sizes = DB::select('select size.name from `sub_category_size` left join `size` on sub_category_size.size_id = size.id where sub_category_size.category_sub_gender_id = ?',[$g_c_s_id[0]->id]);
            return $sizes;
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            throw new SystemException('Server error found,please try again');
        }

    }

    protected function withError($callback)
    {
        try
        {
            return $callback();
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            throw new SystemException('Tabs,server error please try again or contact or customer service');
        }
    }
}
