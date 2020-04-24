<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    protected $primaryKey = "cart_id";
     
    public $timestamps =  false;
     // 黑名单 所有都允许添加
    protected $guarded = [];
}
