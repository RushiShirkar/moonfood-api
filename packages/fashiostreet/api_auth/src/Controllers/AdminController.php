<?php

namespace fashiostreet\Admin;
use App\Http\Controllers\Controller;
use FS_Response;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function allCustomersMsg(Request $request)
	{
		return FS_Response::success('message','Sent Successfully');
	}
}