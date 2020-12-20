<?php

namespace fashiostreet\api_auth\Controllers;
use fashiostreet\api_auth\Activation\ActivationController;
use fashiostreet\api_auth\Layers\LayersChecker;
use fashiostreet\api_auth\Exceptions\ErrorException;
use fashiostreet\api_auth\Controllers\UserModel as UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use FS_Response;
use Illuminate\Support\Facades\DB;
use fashiostreet\api_auth\ResetPassword\ResetPasswordController;
use Validate;
use fashiostreet\api_auth\Controllers\SendSMS as SendSMS;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $request;
    protected $layerChecker;

    function __construct(Request $request)
    {
        $request = (object)$request->only(['mobile','password']);
        $this->request = $request;
        $this->layerChecker = new LayersChecker();
        $this->resetpassword = new ResetPasswordController();
        $this->activation = new ActivationController();
    }
    public function hash1()
    {
        return Hash::make($this->request->password);
    }

    public function loginview(){
        return view('api_auth::login');
    }

    protected function CredentialsValidate()
    {
        if(!Validate::numericOnly($this->request->mobile,true,0,10)) {
            throw new ErrorException('Invalid mobile number found');
        }
    }
    protected function CreateToken($user)
    {
        return encrypt($user);
    }

    public function getToken(Request $request,$mobile)
    {
        $id = DB::select('select id from customer where mobile = ?',[$mobile]);
        return FS_Response::success('data',encrypt($id[0]->id));
    }

    public function hashPassword()
    {
        return Hash::make($this->request->password);
    }

    protected function createUser1()
    {
        try{
            $user = new UserModel();
            $user->mobile = $this->request->mobile;
            $user->password = '123456';
            $user->save();
            return $user;
        }
        catch (QueryException $e)
        {
            throw new SystemException('failed to create user try again or contact to our customer service');
        }
    }

    public function sendOtp(Request $request)
    {
        $id = DB::select('select id,mobile,password from customer where mobile = ?',[$request->mobile]);
        $userStatus = null;
        if(count($id) > 0)
        {
            $customer_id = $id[0]->id;
            $userStatus = 'old';
        }
        else
        {
            $user = new UserModel();
            $user->mobile = $request->mobile;
            $user->password = '123456';
            $user->save();
            $id1 = DB::select('select id,mobile,password from customer where mobile = ?',[$request->mobile]);
            $customer_id = $id1[0]->id;
            $userStatus = 'new';
        }
        $otp = mt_rand(1000, 9999);
        DB::table('activations')->insert([
            'users_id' => $customer_id,
            'code' => $otp,
            'completed' => 0,
            'created_at' => Carbon::now()
        ]);
        $msg = new SendSMS();
        $msg->send($request->mobile,$otp);
        return FS_Response::success('data',$userStatus);
    }

    public function checkOtp(Request $request)
    {
        $user_id = DB::select('select id from customer where mobile = ?',[$request->mobile]);
        $code = DB::select('select code from activations where users_id = ? and completed = 0 order by id desc',[$user_id[0]->id]);
        if($request->code == $code[0]->code)
        {
            DB::table('activations')
                ->where('users_id',$user_id[0]->id)
                ->where('code',$request->code)
                ->update([
                    'completed' => 1,
                    'completed_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            $id = DB::select('select id from customer where mobile = ?',[$request->mobile]);
            return FS_Response::success('data',encrypt($id[0]->id));
        }
        else
        {
            return FS_Response::error('message','Invalid OTP found');
        }
    }

    public function login()
    {
      //$this->CredentialsValidate();
        $user = $this->findBycredentials();
        $this->layerChecker->Logincheck($user);
        $token = $this->CreateToken($user->id);
        $local_id = $this->CreateToken($user->id);
        $check = DB::select('select id from customer_wallet where customer_id=?',[$user->id]);
        if(count($check)==1)
        {

        }
        else
        {
            DB::table('customer_wallet')->insert([
                'customer_id' => $user->id,
                'money' => 0
            ]);
        }
        return FS_Response::success('data',array(
            'token' => $token,
            'local_id' => $local_id,
            'check' => $check
        ));
    }

    public function login1()
    {
      //$this->CredentialsValidate();
        $user = $this->findBycredentials1();
        $this->layerChecker->Logincheck($user);
        $token = $this->CreateToken($user->id);
        $local_id = $this->CreateToken($user->id);
        $check = DB::select('select id from customer_wallet where customer_id=?',[$user->id]);
        if(count($check)==1)
        {

        }
        else
        {
            DB::table('customer_wallet')->insert([
                'customer_id' => $user->id,
                'money' => 0
            ]);
        }
        return FS_Response::success('data',array(
            'token' => $token,
            'local_id' => $local_id,
            'check' => $check
        ));
    }

    protected function findBycredentials()
    {
        $user = DB::select('select customer.id as id,customer.password as password from customer where mobile = ? limit 1',[$this->request->mobile]);
        if(count($user) <= 0)
        {
            throw new ErrorException('Invalid user found');
        }
        if(Hash::check($this->request->password,$user[0]->password) == 1)
        {
            return $user[0];
        }
        throw new ErrorException('Invalid mobile or password found');
    }

    protected function findBycredentials1()
    {
        $user = DB::select('select customer.id as id,customer.password as password from customer where mobile = ? limit 1',[$this->request->mobile]);
        if(count($user) <= 0)
        {
            throw new ErrorException('Invalid user found');
        }
        if($this->request->password==$user[0]->password)
        {
            return $user[0];
        }
        throw new ErrorException('Invalid mobile or password found');
    }
}
