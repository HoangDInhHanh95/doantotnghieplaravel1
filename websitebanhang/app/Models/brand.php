<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'brand_name','brand_desc','brand_status'
    ];
    
    protected $primary = 'id';
    protected $table = 'tbl_brand_product';
}
