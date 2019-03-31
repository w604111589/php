<?php

namespace app\controllers;

use yii;
// use yii\web\Controller;
use yii\web\Response;
use app\models\common\Common;
use app\models\common\Res;
use app\controllers\BaseController;

class TestController extends BaseController{
	public function actionHello(){
		$command = yii::$app->db->createCommand("select * from pp_api_detail");
		$res = $command->queryOne();
		return Res::success($res);
	}
}