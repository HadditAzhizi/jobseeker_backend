<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Mpenjualan extends Model
{
    use HasFactory;

    public function get_data()
	{ 
		$data = DB::select("SELECT * FROM transaksi_jual "); 
		
		return $data;
	}
	public function laporan_penjualan_detail()
	{ 
		$data = DB::select("SELECT product.nama as product, transaksi_jual_detail.harga, transaksi_jual_detail.qty, transaksi_jual.no_penjualan, transaksi_jual.tgl_jual from transaksi_jual_detail inner join transaksi_jual on transaksi_jual_detail.id_penjualan=transaksi_jual.id inner join product on product.id=transaksi_jual_detail.product_id"); 
		
		return $data;
	}
	public function penjualan_terlaris()
	{ 
		$data = DB::select("SELECT product.gambar as gambar,product.nama as product, transaksi_jual_detail.harga, transaksi_jual_detail.qty, transaksi_jual.no_penjualan, transaksi_jual.tgl_jual,sum(qty) as qty_jual from transaksi_jual_detail inner join transaksi_jual on transaksi_jual_detail.id_penjualan=transaksi_jual.id inner join product on product.id=transaksi_jual_detail.product_id group by product.id order by qty_jual desc limit 10"); 
		
		return $data;
	}
}
