<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotlink extends Model
{
    protected $table = "hotlink";
    protected $primaryKey = "link_id";
     
    public $timestamps =  false;
     // 黑名单 所有都允许添加
    protected $guarded = [];
    
}
