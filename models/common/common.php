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

	public static function generateToken(){
          $controller = Yii::$app->controller->id;
          $action = Yii::$app->controller->action->id; 

          $client_secret="wangtao";
          $api_token_server = md5( $controller . $action .  date('Y-m-d', time()) .  $client_secret);
          // var_dump($api_token_server );die;
          return $api_token_server;
     }


     public static function checkToken($params){
          $params = Common::getParams();
          if(isset($params['token'])){
              if($params['token']){
                  if(!isset($_SESSION[$params['token']])){
                      return 1;
                  }
              }else{
                  return 2;
              }
          }else{
              return 2;
          }
          return 0;
     }


}