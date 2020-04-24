<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = "Category";
    protected $primaryKey = "cate_id";
     
    public $timestamps =  false;
     // 黑名单 所有都允许添加
    protected $guarded = [];
    
}
