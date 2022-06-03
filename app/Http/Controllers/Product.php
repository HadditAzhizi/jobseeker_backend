<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;
use App\Models\Mproduct;
use App\Models\Mproduct_kateg;
use DataTables;

class Product extends Controller
{ 
	public function index()
	{
		return view('dashboard/product');
	}
	public function product_all(Request $request)
    {
        if ($request->ajax()) {
            $data = Mproduct::get_data();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actions = 
                    '<a href="/product_edit/'.$row->id.'" class="btn btn-sm btn-primary">Edit</a>
                    <a onclick="hapus_data('.$row->id.')" class="btn btn-sm btn-danger">Delete</a>';
                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // return Datatables::of(Mproduct::get_data())->make(true);

    }
	public function product_tambah()
	{
  		$data['dt_kateg'] = Mproduct_kateg::get_data();
		return view('dashboard/product_form',$data);
	}
	public function product_edit(Request $request)
	{
  		$data['dt_kateg'] = Mproduct_kateg::get_data();
  		$data['product'] = DB::select("SELECT *,product.id as id_product from product inner join product_stock on product.id=product_stock.product_id where product.id='$request->id'");
		return view('dashboard/product_edit',$data);
	}
 
	public function tambah(Request $request)
	{ 
	   $messages = [
		    'file.required' => 'File Wajib Diisi!!!',
		    'nama.required' => 'Nama Wajib Diisi!!!',
		    'deskripsi.required' => 'Deskripsi Wajib Diisi!!!',
		    'harga.required' => 'Harga Wajib Diisi!!!',
		    'prod_kateg.required' => 'Kategori Product Wajib Diisi!!!'
		];

		$this->validate($request,[
			'file' =>'required',
		    'nama' => 'required|unique:product',
		    'deskripsi' => 'required',
		    'harga' => 'required',
		    'prod_kateg' => 'required'
		],$messages);

	   $name = time().'.'.request()->file->getClientOriginalExtension();
  
       $request->file->move(public_path('uploads'), $name);
  
		DB::table('product')->insert([
			'nama' => $request->nama,
			'gambar' => $name,
			'deskripsi' => $request->deskripsi,
			'harga' => $request->harga,
			'kateg_id' => $request->prod_kateg
		]);
  		$id_prod =  DB::getPdo()->lastInsertId();

		DB::table('product_stock')->insert([
			'product_id' => $id_prod,
			'stock' => 0
		]);
        return json_encode($request);

	} 
	public function edit(Request $request)
	{ 
	   $messages = [
		    'nama.required' => 'Nama Wajib Diisi!!!',
		    'deskripsi.required' => 'Deskripsi Wajib Diisi!!!',
		    'harga.required' => 'Harga Wajib Diisi!!!',
		    'prod_kateg.required' => 'Kategori Product Wajib Diisi!!!'
		];

		$this->validate($request,[
		    'nama' => 'required',
		    'deskripsi' => 'required',
		    'harga' => 'required',
		    'prod_kateg' => 'required'
		],$messages);

  		
  		if($request->file!='')
  		{
	   		$name = time().'.'.request()->file->getClientOriginalExtension();
       		$request->file->move(public_path('uploads'), $name);
  		}
  		else
  		{
  			$name = $request->img_lama;
  		}
  		
  		$update = DB::table('product') ->where('id', $request->id)->update([
			'nama' => $request->nama,
			'gambar' => $name,
			'deskripsi' => $request->deskripsi,
			'harga' => $request->harga,
			'kateg_id' => $request->prod_kateg
		]); 

 		$update = DB::table('product_stock') ->where('product_id', $request->id)->update([
			'stock' => $request->stock
		]); 

        return json_encode($request);

	}
	public function hapus(Request $request)
	{
		$update = DB::table('product') ->where('id', $request->id)->update([
			'is_delete' => 1
		]); 
		return True;
	} 
}
