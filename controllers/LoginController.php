<?php
namespace app\controllers;

use Yii;
use app\models\User;
use app\models\common\Common;
use app\models\common\Res;
use app\controllers\BaseController;

class LoginController extends BaseController{

     public function actionLoginin(){
          $params = Common::getParams();
          if(!isset($params['login_name'])) return Res::fail("用户名不能为空");
          if(!isset($params['password'])) return Res::fail("密码不能为空");
          $userInfo = User::selectUserByName($params['login_name']);
          if(!$userInfo) return Res::fail("该用户不存在！");
          if(!$userInfo['status']) return Res::fail("该用户已冻结！");
          if($userInfo['password'] !== $params['password']){
               return Res::fail("密码错误");
          }
          $token = User::generateToken();
          $_SESSION[$token] = $userInfo;
          return Res::success($token,"登陆成功");
     }

     public function actionLoginout(){
          $params = Common::getParams();
          if(!isset($params['token'])){
               return Res::fail("token不能为空");
          }
          $token = $params['token'];
          if(isset($_SESSION[$token])){
           unset($_SESSION[$token]);
          }
          
          return Res::success("退出成功");
     }

}