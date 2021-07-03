<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'gallery_name','gallery_image','product_id'
    ];
    
    protected $primary = 'gallery_id';
    protected $table = 'tbl_gallery';
}
