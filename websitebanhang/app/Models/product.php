<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'category_id','brand_id','product_name','product_desc','product_price','product_size','product_content','product_image','product_color','product_status'
    ];
    
    protected $primary = 'product_id';
    protected $table = 'tbl_product';
}
