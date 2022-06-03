<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use App\Models\Mpenjualan;
use App\Models\Mproduct; 
use App\Models\Muser;

class Dashboard extends Controller
{ 
	public function index()
	{
		$data["dt_terlaris"] = Mpenjualan::penjualan_terlaris(); 
  		$data['dt_product'] = count(Mproduct::get_data()); 
  		$data['dt_user'] = count(Muser::get_data());
		return view('dashboard/index',$data);
	}
}
