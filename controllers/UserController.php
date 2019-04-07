<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\common\Common;
use app\models\common\Res;
use app\controllers\BaseController;

class UserController extends BaseController{
     //不去验证csrf
     public $enableCsrfValidation = false;

     public function actionSelect(int $id,string $user_name = ""){
          $params = Common::getParams();
          $res = User::selectUser($id,$user_name);
		return Res::success($res);
     }

     public function actionIndex(){
          $params = Common::getParams();
          // var_dump($this->token);die;
          $res = User::selectUser(10003);
		return Res::success($res);
     }

     public function actionSelectall(){
          $params = Common::getParams();
          // var_dump($this->token);die;
          $res = User::selectUserAll();
		return Res::success($res);
     }

     public function actionSelectid(){
          $params = Common::getParams();
          if(!isset($params['id']) ) return Res::fail("ID参数错误");
          $res = User::selectUserOne();

		return Res::success($res);
     }

     public function actionCreate(){
          $params = Common::getParams();
          if(!isset($params['user_name']) ) return Res::fail("登陆名不能为空");
          if(!isset($params['password']) ) return Res::fail("登陆密码不能为空");
          if(!isset($params['phone']) ) return Res::fail("手机号不能为空");
          //检验下用户是否存在
          $userInfo = User::selectUserByName($params['user_name']);
          if($userInfo){
               return Res::fail("该用户名已经存在");
          }
          $res = User::CreateUserOne();
		return Res::success($res);
     }

     public function actionUpdate(){
          $params = Common::getParams();
          $userInfo = User::selectUserByName($params['user_name']);
          if($userInfo){
               return Res::fail("该用户名已经存在");
          }
          $res = User::updateUserOne();

		return Res::success($res);
     }


     public function actionDelete(){
          $res = User::updateUser();
		return Res::success($res,"更改成功");
     }

     public function actionLogin(){
          $params = Common::getParams();
          if(!isset($params['user_name'])) return Res::fail("用户名不能为空");
          if(!isset($params['password'])) return Res::fail("密码不能为空");
          $userInfo = User::selectUserByName($params['user_name']);
          if(!$userInfo) return Res::fail("该用户不存在！");
          if(!$userInfo['status']) return Res::fail("该用户已冻结！");
          if($userInfo['password'] !== $params['password']){
               return Res::fail("密码错误");
          }
          $token = User::generateToken();
          $_SESSION[$token] = $userInfo;
          return Res::success($token,"登陆成功");
     }


}