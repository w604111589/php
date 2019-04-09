<?php

namespace app\models\common;

use yii;
use yii\base\Model;
use yii\web\UploadedFile;

class Upload extends Model
{
    /**
     * @var UploadedFile
     */
	public $rootPath = "uploads/";

	public $maxPic = 4;

	public $maxSize = 1024*1024*5;

    public function singleUpload()
    {
		$dataDir = Yii::$app->basePath.'/'.$this->rootPath.date('Y-m-d').'/';

		if(!is_dir($dataDir)){
			mkdir($dataDir);
		}

		$fullPath = $dataDir.time().rand(0,999).'_'.$_FILES["imageFile"]["name"];
		if (!file_exists($fullPath)){
			move_uploaded_file($_FILES["imageFile"]["tmp_name"],$fullPath);
			return true;
		}
		return false;

	}

	public function multipleUpload()
    {
		$dataDir = Yii::$app->basePath.'/'.$this->rootPath.date('Y-m-d').'/';

		if(!is_dir($dataDir)){
			mkdir($dataDir);
		}

		
		$len = count($_FILES['imageFiles']['name']);
		// print_r($_FILES['imageFiles']);die;
		for($i =0; $i<$len; $i++){
			$fullPath = $dataDir.time().rand(0,999).'_'.$_FILES["imageFiles"]["name"][$i];
			if (!file_exists($fullPath) && !$_FILES["imageFiles"]["error"][$i]){
				move_uploaded_file($_FILES["imageFiles"]["tmp_name"][$i],$fullPath);
			}
		}

		return true;

	}
	

}