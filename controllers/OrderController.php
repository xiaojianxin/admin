<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Order;
use yii\helpers\Url;


class OrderController extends Controller
{

    public function init(){
        $this->enableCsrfValidation = false;
    }

    public function actionSendorder(){

        $post =  Yii::$app->request->post();
        $id = $post['id'];
        $order = Order::find()->where(['id'=>$id])->one();
        //var_dump($order);
        $order->status = 2;
        if($order->save()){
            echo "0";

        }else{
            echo "-1";
        }
    }



}
