<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
   protected $table = "brand";
   protected $primaryKey = "brand_id";
    
   public $timestamps =  false;
    // 黑名单 所有都允许添加
   protected $guarded = [];
}
