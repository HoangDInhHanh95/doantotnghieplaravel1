<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'product_id','customer_id'
    ];
    
    protected $primary = 'wishlist_id';
    protected $table = 'tbl_wishlist';
}
