<?php

namespace fashiostreet\api_auth\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use fashiostreet\api_auth\Activation\ActivationController;
use FS_Response;

class AuthController extends Controller
{

    public function getuser(Request $request)
    {
        $user = auth()->user();
        $shop_id = DB::select('select shop.id from shop where shop.users_id = ? limit 1',[$user->id]);
        if(count($shop_id) <= 0)
        {
            throw new \fashiostreet\api_auth\Exceptions\Api_authException('No Shop found');
        }
        $user->{'shop_id'} = $shop_id[0]->id;
        return $user;
    }



    public function register(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $obj = new ActivationController();
        return $obj->CreateActivation($user);
        return response()->json(['status' => 200]);
    }

    public function login(Request $request)
    {
        $data = [
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => '0h0PSPwRax1ILQc1EAcYffCdaVQ8JKBSwXkIkiiT',
            'username' => $request->username,
            'password' => $request->password
        ];

        $request = Request::create('/oauth/token', 'POST', $data);
        return app()->handle($request);
    }

    public function logout()
    {
        $accessToken = auth()->user()->token();
        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        return response()->json(['status' => 200]);
    }
}
