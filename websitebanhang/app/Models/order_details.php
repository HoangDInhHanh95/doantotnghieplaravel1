<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'order_id','shipping_id','customer_id','product_id','payment_id','product_name','product_price','product_sales_quantity'
    ];
    
    protected $primary = 'order_details_id';
    protected $table = 'tbl_order_details';
}
