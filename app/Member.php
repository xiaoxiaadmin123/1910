<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
   protected $table = "member";
   protected $primaryKey = "member_id";
    
   public $timestamps =  false;
    // 黑名单 所有都允许添加
   protected $guarded = [];
}
?>