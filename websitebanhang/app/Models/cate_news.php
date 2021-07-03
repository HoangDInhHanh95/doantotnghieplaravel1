<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cate_news extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'cate_news_name','cate_news_status'
    ];
    
    protected $primary = 'cate_news_id';
    protected $table = 'tbl_cate_news';

}
