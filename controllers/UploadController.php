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
            //$model->file = UploadedFile::getInstance($model, 'file');

            echo $_FILES;

            if ($model->validate()) {                
                $model->file->saveAs('./pictures/' . $model->file->baseName . '.' . $model->file->extension);
            	$pic->url = 'pictures/'.$model->file->baseName.'.'.$model->file->extension;
                $pic->name = $model->file->baseName;
            	$pic->save();
            }
        }
            echo "1";
	}

    public function actionShow()
    {
        $request = YII::$app->request;
        $name = $request->get('name');
        $sql = 'select * from pictures where name=:name';
        $results = Pictures::findBySql($sql, array(':name'=>$name))->asArray()->one();
        return $results['url'];
    }

    public function actionDelete()
    {
        $request = YII::$app->request;
        $name = $request->get('name');
        $sql = 'select * from pictures where name=:name';
        $pic = Pictures::findBySql($sql, array(':name'=>$name))->asArray()->one();
        //删除pictures目录下的图片
        $path = $pic['url'];
        if(is_readable($path))
            unlink($path);

        //删除数据库的记录
        $connection=YII::$app->db; 
        $model = $connection->createCommand('delete from pictures where name=:name');
        $model->bindParam(':name', $name);
        if($pic)
            $model->execute();
        else
            echo "Not Exists";
        echo 'hehe';
    }
}