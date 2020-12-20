<?php
namespace fashiostreet\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class address extends Model
{
    use SoftDeletes;
    protected $table = 'address';
    protected $dates = ['deleted_at'];
}