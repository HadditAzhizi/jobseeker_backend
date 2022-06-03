<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Mproduct extends Model
{
    use HasFactory;

    public function get_data()
	{ 
		$data = DB::select("SELECT product.id,deskripsi,product.nama,harga,product_kateg.nama as Kategori_Product,gambar,stock FROM product inner join product_kateg on product.kateg_id=product_kateg.id inner join product_stock on product.id=product_stock.product_id where product.is_delete=0"); 
		
		return $data;
	}
    public function get_data_product()
	{ 
		$data = DB::select("SELECT * from product"); 
		
		return $data;
	}
}
