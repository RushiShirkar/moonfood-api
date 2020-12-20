<?php
namespace fashiostreet\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductOrdered extends Model
{
    use SoftDeletes;
    protected $table = 'productordered';
    protected $dates = ['deleted_at'];
}