<?php


namespace common\components;


class Helper {
    //提取数组某一个键返回一维数组
    public function arrayGivenField($data,$field){
        $arr=[];
        if(!empty($data)){
            foreach ($data as $k=>$v){
                $arr[]=$v[$field];
            }
        }
        return $arr;
    }
    //数组去重 默认key
    public function arrayUniqueDefaultKey($data){
        $arr=[];
        if(!empty($data)){
            foreach (array_unique($data) as $k=>$v){
                $arr[]=$v;
            }
        }
        return $arr;
    }


}