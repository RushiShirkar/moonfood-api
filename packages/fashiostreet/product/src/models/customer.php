<?php
namespace fashiostreet\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class customer extends Model
{
    use SoftDeletes;
    protected $table = 'customer';
    protected $dates = ['deleted_at'];
}