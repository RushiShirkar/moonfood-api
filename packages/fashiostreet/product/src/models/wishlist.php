<?php

namespace fashiostreet\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class wishlist extends Model
{
    use SoftDeletes;
    protected $table = 'wishlist';
    protected $dates = ['deleted_at'];
}
