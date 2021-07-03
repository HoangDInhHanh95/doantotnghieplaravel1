<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'contact_id','contact_name','contact_email','contact_phone','contact_title','contact_desc'
    ];
    
    protected $primary = 'contact_id';
    protected $table = 'tbl_contact';
}
