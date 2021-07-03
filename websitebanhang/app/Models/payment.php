<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    public $timestamps =true;
    protected $fillable = [
        'payment_method','payment_status'
    ];
    protected $primarykey ='payment_id';
    protected $table = 'tbl_payment'; 
}
