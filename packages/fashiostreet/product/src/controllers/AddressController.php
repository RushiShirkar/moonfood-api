<?php
namespace fashiostreet\product;
use App\Http\Controllers\Controller;
use fashiostreet\product\address;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use fashiostreet\product\Auth\User;
use fashiostreet\product\Exceptions\ErrorException;
use Illuminate\Http\Request;
use FS_Response;

class AddressController extends Controller{
    protected $user_id;

    function __construct(Request $request)
    {
        $obj = new User();
        $this->user_id = $obj->getUserId($request);
    }

    public function getAddressById(Request $request)
    {
        $address = address::select(['id','address','first_name','last_name','area','mobile'])
            ->where('users_id',$this->user_id)
            ->where('id',$request->a_id)
            ->get();
        return $address;
    }

    public function getAddress(Request $request,$json = 'view',$mobile)
    {
            //$address = address::select(['id','address','first_name','last_name','area','mobile'])
                //->where('users_id',$this->user_id)
                //->get();
            $user_id = DB::select('select id from customer where mobile = ?',[$mobile]);
            $address = DB::select('select * from address where users_id = ? and deleted_at IS NULL',[$user_id[0]->id,$mobile]);
            if($json == 'json'){
                return FS_Response::success('data',$address);
            }
            else if($json == 'normal')
            {
                return $address;
            }
            if(\Request::route()->getName() == 'selectName')
            {
                return View('fashiostreet_client::orderAddress',['address' => $address]);
            }
            return View('fashiostreet_client::address',['address' => $address]);

    }
    public function addAddress(Request $request)
    {
        $user_id = DB::select('select id from customer where mobile = ?',[$request->mobile]);
        try{
            $address = new address();
            $address->address = $request->address;
            $address->first_name = $request->first_name;
            $address->last_name = $request->last_name;
            $address->area = $request->area;
            $address->mobile = $request->mobile;
            $address->users_id = $user_id[0]->id;
            $address->save();
            return FS_Response::success('data',$user_id);
        }catch (\Illuminate\Database\QueryException $e)
        {
            throw new ErrorException('address,server error');
        }
    }
    public function editAddress(Request $request)
    {
        $user_id = DB::select('select id from customer where mobile = ?',[$request->mobile]);
        $i = 1;
            $address = address::where('id', $request->address_id)
                ->where('users_id', $user_id[0]->id)
                ->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'area' => $request->area,
                    'address' => $request->address,
                    'mobile' => $request->mobile
                ]);
            /*if ($address <= 0 || $address == null || $address == false) {
                return FS_Response::error(500,'failed to update address');
            }*/
            return FS_Response::success('data',$user_id);
    }
    public function deleteAddress(Request $request)
    {
        try{
            DB::table('address')
            ->where('id',$request->address_id)
            ->update([
                'deleted_at' => Carbon::now()
            ]);
            return FS_Response::success('message','successfully address deleted');
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            throw new ErrorException('address,server error');
        }
    }
    protected function withError($callback)
    {
        try
        {
            $callback();
        }
        catch (\Illuminate\Database\QueryException $e)
        {
            return response()->json('Server error found '.$e->getCode(),500);
        }
    }
}