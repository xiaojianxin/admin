<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\Pictures;

class UploadController extends Controller
{
    public function init(){
        $this->enableCsrfValidation = false;
    }

	public function actionUpload()
	{  
		$model = new UploadForm();
		$pic = new Pictures();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->validate()) {                
                $model->file->saveAs('../pictures/' . $model->file->baseName . '.' . $model->file->extension);
            	$pic->url = 'pictures/'.$model->file->baseName.'.'.$model->file->extension;
            	$pic->save();
            }
        }
            echo "1";
	}
}