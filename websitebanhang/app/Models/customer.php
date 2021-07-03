<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'customer_name','customer_email','customer_password','customer_address','customer_phone'
    ];
    
    protected $primary = 'customer_id';
    protected $table = 'tbl_customer';
}
