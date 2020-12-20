<?php
namespace fashiostreet\api_auth\Controllers;
use Illuminate\Database\Eloquent\Model;
class UserModel extends Model
{
    protected $table = 'customer';
    protected $hidden = [
        'password','deleted_at'
    ];
}
