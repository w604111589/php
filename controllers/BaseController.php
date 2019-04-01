<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\common\Common;
use app\models\common\Res;

class BaseController extends Controller
{
    public $oper;

    public $verification = ["login","register"];

    
    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        
        if (parent::beforeAction($action)) {
            Yii::info("记录每次的请求:",'user');
            $controller = Yii::$app->controller->id;
            if(!in_array($controller,$this->verification )){

                $params = Common::getParams();
                $status = Common::checkToken($params);
                if($status == 1 ){
                    $this->asJson(Res::fail("token不存在",302));
                    return false;
                }else if($status == 2){
                    $this->asJson(Res::fail("请先登陆",301));
                    return false;
                }
                
            }
            
            return true;
        }

        return false;
    }


    public function afterAction($action, $result)
    {
        // var_dump(111);die;
        $this->asJson($result);
    }

}
