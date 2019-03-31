<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\common\Common;
use app\models\common\Res;
use app\controllers\BaseController;

class UserController extends BaseController{

     public function actionSelect(int $id,string $login_name = ""){
          $params = Common::getParams();
          
          $res = User::selectUser($id,$login_name);

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
          if(!isset($params['login_name']) ) return Res::fail("登陆名不能为空");
          if(!isset($params['password']) ) return Res::fail("登陆密码不能为空");
          if(!isset($params['phone']) ) return Res::fail("手机号不能为空");
          //检验下用户是否存在
          $userInfo = User::selectUserByName($params['login_name']);
          if($userInfo){
               return Res::fail("该用户名已经存在");
          }
          $res = User::CreateUserOne();
		return Res::success($res);
     }

     public function actionUpdate(){
          $params = Common::getParams();
          $userInfo = User::selectUserByName($params['login_name']);
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


}