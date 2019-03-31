<?php

namespace app\models\common;

use yii\base\Model;

class Res extends Model {

	public static function success($data,$msg="请求成功"){
		$arr = [];
		$arr["code"] = 200;
		$arr["data"]  = $data;
		$arr["msg"] = $msg;
		$arr["time"] = date('y-m-d H:i:s',time());
		return $arr;
	}

	// public static function success($data,$res){
	// 	$arr = [];
	// 	$arr["code"] = 200;
	// 	$arr["data"]  = $data;
	// 	$arr["msg"] = "请求成功";
	// 	$arr["time"] = date('y-m-d H:i:s',time());
	// 	return $arr;
	// }

	public static function fail($msg="请求异常",$code=300,$data=[]){
		$arr["code"] = $code;
		$arr["data"]  = $data;
		$arr["msg"] = $msg;
		$arr["time"] = date('y-m-d H:i:s',time());
		return $arr;
	}

} 