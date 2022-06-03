<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Mproduct_kateg extends Model
{
    use HasFactory;

    public function get_data()
	{ 
		$data = DB::select("SELECT * FROM product_kateg"); 
		
		return $data;
	}
}
