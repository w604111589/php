<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\common\Common;
use app\models\common\Res;

class BaseController extends Controller
{
    public $oper;

    public $verification = ["login","register","user"];

    public $token = '';
    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age:3600');
        // header("Access-Control-Allow-Headers: Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With,If-Modified-Since,token");
        header("Access-Control-Allow-Headers: Authorization,Content-Type,token");

        if (parent::beforeAction($action)) {

            Yii::info("记录每次的请求:",'user');
            $controller = Yii::$app->controller->id;
            // print_r(Yii::$app->request->headers);die;
            if(!in_array($controller,$this->verification )){

                // $params = Common::getParams();
                // $status = Common::checkToken($params);
                // if($status == 1 ){
                //     $this->asJson(Res::fail("token不存在",302));
                //     return false;
                // }else if($status == 2){
                //     $this->asJson(Res::fail("请先登陆",301));
                //     return false;
                // }
                
                if(!isset($http_response_header['token']) || $http_response_header['token']){
                    
                    $this->asJson(Res::fail("请先登陆",301));
                    return false;   
                }
                $this->token = $http_response_header['token'];
            }
            
            return  true;
        }

        return false;
    }


    public function afterAction($action, $result)
    {
        // var_dump(111);die;
        $this->asJson($result);
    }

}
