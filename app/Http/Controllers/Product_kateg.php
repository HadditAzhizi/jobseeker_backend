<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use App\Models\Mproduct_kateg;

class Product_kateg extends Controller
{ 
	public function index()
	{
  		$data['dt_kateg'] = Mproduct_kateg::get_data();
		return view('dashboard/product_kateg', $data);
	}
 
	public function tambah(Request $request)
	{ 
		DB::table('product_kateg')->insert([
			'nama' => $request->nama
		]);

		return True;

	} 
	public function edit(Request $request)
	{ 
		$update = DB::table('product_kateg') ->where('id', $request->id)->update([
			'nama' => $request->nama
		]); 
		return True;
	}
	public function get_select(Request $request)
	{
		$data = DB::table('product_kateg')->where('id', $request->id)->get();
		return $data[0];
	}
	public function hapus(Request $request)
	{
		DB::table('product_kateg')->where('id', $request->id)->delete();
		return True;
	} 
}
