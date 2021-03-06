<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\Pictures;
use app\models\Fonts;
use yii\helpers\Url;

class UploadController extends Controller
{
    public function init(){
        $this->enableCsrfValidation = false;
    }

	// public function actionUpload()
	// {  
	// 	$model = new UploadForm();
	// 	$pic = new Pictures();

 //        if (Yii::$app->request->isPost) {
 //            //$model->file = UploadedFile::getInstance($model, 'file');

 //            echo $_FILES;

 //            if ($model->validate()) {                
 //                $model->file->saveAs('./pictures/' . $model->file->baseName . '.' . $model->file->extension);
 //            	$pic->url = 'pictures/'.$model->file->baseName.'.'.$model->file->extension;
 //                $pic->name = $model->file->baseName;
 //            	$pic->save();
 //            }
 //        }
 //            echo "1";
	// }

    // public function actionShow()
    // {
    //     $request = YII::$app->request;
    //     $name = $request->get('name');
    //     $sql = 'select * from pictures where name=:name';
    //     $results = Pictures::findBySql($sql, array(':name'=>$name))->asArray()->one();
    //     return $results['url'];
    // }

    public function actionShow()
    {
        $request = YII::$app->request;
        $type = $request->get('type');
        $sql = 'select * from pictures where type=:type';
        $results = Pictures::findBySql($sql, array(':type'=>$type))->all();
        // $sql = 'select * from pictures where type=0';
        // $results = Pictures::findBySql($sql)->all();
        return $results[0]['url'];
        // print_R($results);
    }

    public function actionDelete()
    {
        $request = YII::$app->request->post();
        $name = $request['name'];
        $sql = 'select * from pictures where name=:name';
        $pic = Pictures::findBySql($sql, array(':name'=>$name))->asArray()->one();
        //删除pictures目录下的图片
        $path = 'http://www.ontee.cn/'.$pic['url'];
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

        echo "0";
        
    }

    public function actionUploadfont(){
        $model =  new UploadForm();
        $font = new Fonts();
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->validate()) { 
               if($model->file->saveAs('../../Ontee/web/css/fonts/' .$model->file->baseName. '.' . $model->file->extension)){
                
                    $font->ttfurl = 'css/fonts/'.$model->file->baseName.'.'.$model->file->extension;
                    $font->name = $model->file->baseName;
                    $font->save();
                    return $this->redirect(Url::to(['site/fonts']));
               }            
            }
        }
    }
}