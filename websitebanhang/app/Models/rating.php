<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'rating_id','product_id','rating'
    ];
    
    protected $primary = 'rating_id';
    protected $table = 'tbl_rating';
}
