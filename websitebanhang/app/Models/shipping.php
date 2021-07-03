<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'shipping_name','shipping_size','shipping_color','shipping_email','shipping_phone','shipping_address','shipping_note'
    ];
    protected $primarykey ='shipping_id';
    protected $table = 'tbl_shipping'; 
}
