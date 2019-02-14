<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\common\Common;
use app\models\common\Res;

class TestController extends Controller{
	public function actionHello(){

		var_dump(yii::$app->request->get());
		var_dump(Common::getParams());

		var_dump(json_encode(Res::success("666")));
		$arr = ["name"=>"wangtao"];
		$this->asJson($arr);
	}
}