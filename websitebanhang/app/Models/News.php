<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'cate_new_id','news_title','news_desc','news_content','news_meta_desc','news_meta_keyword','news_image','news_status'
    ];
    
    protected $primary = 'news_id';
    protected $table = 'tbl_news';
}
