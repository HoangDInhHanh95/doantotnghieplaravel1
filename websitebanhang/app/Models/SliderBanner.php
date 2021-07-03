<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderBanner extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'slider_title','slider_image','slider_desc','slider_status'
    ];
    protected $primarykey ='slider_id';
    protected $table = 'tbl_sliderbanner'; 
}
