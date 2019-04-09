<?php
namespace app\controllers;

use Yii;
use app\models\common\Upload;
use yii\web\UploadedFile;
use app\models\common\Common;
use app\models\common\Res;
use app\controllers\BaseController;

class UploadController extends BaseController{

	public $rootPath = "uploads/";

	public $type = ['image/jpeg','image/gif','image/png','image/jpg'];

	public $maxPicMount = 4;

	public $maxSize = 1024*1024*5;

	public $maxSizeM = '5M';

	public function init(){
		$this->enableCsrfValidation = false;
		
	}
	/* 
	* 图片上传
	*/
	public function actionSingle(){
		if(!isset($_FILES['imageFile'])){
			return Res::fail('上传的图片不能为空');	
		}
		if($_FILES['imageFile']['error']>0){
			return Res::fail($_FILES['file']['error']);
		}

		if(!in_array($_FILES['imageFile']['type'],$this->type) ){
			return Res::fail('只支持jpeg、gig、png、jpg文件格式上传');
		}

		$res = (new Upload())->singleUpload();

		if($res){ 
			return Res::success('','文件上传成功');
		}
		
	}

	/* 
	* 多文件上传
	*/
	public function actionMultiple(){
		if(!isset($_FILES['imageFiles'])){
			return Res::fail('上传的图片不能为空');	
		}

		$len = count($_FILES['imageFiles']['name']);
		if($len > $this->maxPicMount){
			return Res::fail('上传的图片不能超过'.$this->maxPicMount);	
		}
		for($i =0; $i<$len; $i++){
			$size = $_FILES["imageFiles"]["size"][$i];
			if($size >$this->maxSize){
				return Res::fail('上传的图片的尺寸不能超过'.$this->maxSizeM());	
			}
		}

		$res = (new Upload())->multipleUpload();

		if($res){ 
			return Res::success('','文件上传成功');
		}
		
	}


	// public function actionIndex(){
	// 	$model = new Upload();
	// 	$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
	// 	print_r($model);die;
	// 	if($model->singleUpload()){
	// 		//文件上传成功
	// 		return Res::success('','文件上传成功');
	// 	}
	// 	return Res::fail('文件上传失败');
	// }

}