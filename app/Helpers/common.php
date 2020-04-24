<?php

    // /** 无限极分类*/
    function careteTree($data,$parent_id=0,$level = 1){
        if(!$data){
            return;
        }
        static $newarray = [];
        foreach($data as $v){
            if($v->parent_id==$parent_id){
                $v->level = $level;
                $newarray[] = $v;
                
                careteTree($data,$v->cate_id,$level + 1);
            }
        }
        return  $newarray;

    }

     /**多文件上传 */
    function MoreUpload($filename){
        $file = request()->$filename;
        if(!is_array($file)){
            return;
        }
        foreach ($file as $k=>$v){
            // 实现上传
            $path[$k] = $v->store('uploads');
        }
        return $path;
        exit("多文件上传出错");
    }


      /**文件上传 */
    function upload($filename){

        if (request()->file($filename)->isValid()){
            // 接收文件
            $file = request()->$filename;
            // 实现上传
            $path = $file->store('uploads');
            return $path;
        }
        exit("上传文件出错！");
    }

    function ShowMsg($code,$msg){
        $data = [
            'code'=>$code,
            'msg'=>$msg
        ];
        echo json_encode($data);die;
    }



?>