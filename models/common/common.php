<?php

namespace  app\models\common;

use yii;
use yii\base\Model;

class Common extends Model{

	public static function getParams(){
		$params = [];
		if( yii::$app -> request -> isGet){
			$info = yii::$app -> request ->get();
		}else if( yii::$app -> request -> isPost ){
			$info = yii::$app -> request ->post();
		}else{
			$info_get = yii::$app -> request ->get();
			$info_post = yii::$app -> request ->post();
			$info = array_merge($info_get,$info_post);
		}
		return $info;
	}


}