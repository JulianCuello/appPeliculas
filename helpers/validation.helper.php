<?php

class ValidationHelper{
    
    //verifica parametros de formularios
    public static function verifyForm($params){
        foreach($params as $param=>$paramValue){
            if(!isset($paramValue)|| empty($paramValue)){
                return false;
            }
        }return true;
    }
    //verifica id que se pase por parametro en router
    public static function verifyIdRouter($id){
        if($id!=null&&!empty($id)&&is_numeric($id)){
            return true;
        }else{
            return false;
        }
    }
}