<?php

namespace fashiostreet\product;
use App\Http\Controllers\Controller;
use FS_Response;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function allCustomersMsg(Request $request)
    {
        $mobile = DB::select('select mobile from customer');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?sender=ORDERS&route=4&mobiles=7767838215&authkey=185904AYp2weF2DuY5a1db5f5&country=91&message=".$request->message."%0a- Team Fashiostreet",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return FS_Response::success('message','Sent successfully');
    }
}