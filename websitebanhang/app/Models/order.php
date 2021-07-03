<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'customer_id','shipping_id','payment_id','order_total','order_status'
    ];
    protected $primarykey ='order_id';
    protected $table = 'tbl_order'; 
}
