<?php
/**
 * Created by PhpStorm.
 * User: lizhicheng
 * Date: 2017/1/6
 * Time: 11:46
 */

function buildResponse($ret=0,$msg='',$status=200,$data=[]){
    $info = array(
        'ret' => $ret,
        'msg' => $msg
    );
    if($data){
        $info['data'] = $data;
    }
    return response(json_encode($info),$status)->header('Content-Type','application/json');
}

function returnData($data= []){
    return buildResponse(0,'',200,$data);
}

function returnMsg($msg=''){
    return buildResponse(-1,$msg,200);
}

function returnError($msg=''){
    return buildResponse(-5,$msg,500);
}