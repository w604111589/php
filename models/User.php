<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Query;
use app\models\common\Common;

class User extends Model{


     public static function selectUser(int $id,string $login_name = ""){

          $params = Common::getParams();
          //去掉参数中的oper
          if(isset($params['oper'])) unset($params['oper']);
          $pre_params = ["id"=>$id,"login_name"=> $login_name];
          
          $query = new Query();
          $res = $query->from('wt_user')
                       ->filterWhere($pre_params)
                       ->all();

          return $res;
     }

     public static function selectUserByName(string $login_name){
          $params = Common::getParams();
          $command = yii::$app->db->createCommand("select * from wt_user where login_name = :login_name");
          $res = $command->bindValue(':login_name',$login_name)->queryOne(); 
          return $res;
     }

     public static function updateUserOne(){

          $params = Common::getParams();
          //去掉参数中的oper
          if(isset($params['oper'])) unset($params['oper']);
          $params['update_time'] = time();
          $command = yii::$app->db->createCommand();
          $res = $command->update('wt_user',$params,'id ='.$params['id'] )->execute();
          return $res;

     }

     public static function CreateUserOne(){

          $params = Common::getParams();
          //去掉参数中的oper
          if(isset($params['oper'])) unset($params['oper']);
          $params['create_time'] = $params['update_time'] = time();
          $command = yii::$app->db->createCommand();
          $res = $command->insert('wt_user',$params )->execute();
          return $res;

     }


     public static function deleteUserOne(){

          $params = Common::getParams();
          //去掉参数中的oper
          if(isset($params['oper'])) unset($params['oper']);

          $command = yii::$app->db->createCommand();
          $res = $command->delete('wt_user', "id=".$params['id'] )->execute();
          return $res;

     }

     public static function generateToken(){
          $controller = Yii::$app->controller->id;
          $action = Yii::$app->controller->action->id; 

          $client_secret="wangtao";
          $api_token_server = md5( $controller . $action .  date('Y-m-d', time()) .  $client_secret);
          // var_dump($api_token_server );die;
          return $api_token_server;
     }


     public static function checkToken(){
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