<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public $oper;

    
    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            Yii::info("记录每次的请求:",'user');
            return true;
        }

        return false;
    }


    public function afterAction($action, $result)
    {
        $this->asJson($result);
    }

}
