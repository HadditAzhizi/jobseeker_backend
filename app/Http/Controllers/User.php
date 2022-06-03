<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use App\Models\Muser;

class User extends Controller
{ 
	public function index()
	{
  		$data['dt_admin'] = Muser::get_data();
		return view('dashboard/user', $data);
	}
	public function login(Request $request)
	{
		$username = $request->username;
		$pass = md5($request->pass);
		$cek = DB::select("SELECT * FROM dt_admin where username='$username' AND password='$pass'");

		if(count($cek)>0)
		{
			Session::put('username',$cek[0]->username);
            Session::put('login',TRUE);
		}
		
		return count($cek);

	}
	public function logut(Request $request)
	{ 
		$request->session()->forget('login');
		return redirect('/');
	}
 
	public function tambah(Request $request)
	{ 
		DB::table('dt_admin')->insert([
			'username' => $request->username,
			'password' => md5($request->pass)
		]);

		return True;

	} 
	public function edit(Request $request)
	{ 
		$update = DB::table('dt_admin') ->where('id', $request->id)->update([
			'username' => $request->username
		]); 
		return True;
	}
	public function edit_pass(Request $request)
	{ 
		$update = DB::table('dt_admin') ->where('id', $request->id)->update([
			'password' => md5($request->pass)
		]); 
		return True;
	}
	public function ganti_pass(Request $request)
	{ 
		$update = DB::table('dt_admin') ->where('id', $request->id)->update([
			'password' => md5($request->pass)
		]); 
		return True;
	}
	public function get_select(Request $request)
	{
		$data = DB::table('dt_admin')->where('id', $request->id)->get();
		return $data[0];
	}
	public function hapus(Request $request)
	{
		DB::table('dt_admin')->where('id', $request->id)->delete();
		return True;
	} 
}
