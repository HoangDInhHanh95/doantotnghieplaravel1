<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoryproduct extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'category_name','category_desc','category_status'
    ];
    
    protected $primary = 'id';
    protected $table = 'tbl_category_product';
}
