<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadForm;
use app\models\Order;
use app\models\Operator;
use app\models\Fonts;
use yii\web\UploadedFile;
use app\models\Pictures;
use yii\helpers\Url;


class SiteController extends Controller
{

    public function init(){
        $this->enableCsrfValidation = false;
    }
    public function behaviors()
    {
        return [
           'access' => [
                'class' => AccessControl::className(),
                'except' =>['login','signup',],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [

                        'actions' => [ 'index','logout','upload','order','user','gii','fonts'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'upload' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        // $pictures = Pictures::find()->all();

        $request = YII::$app->request;
        $type = $request->get('type',0);
        $sql = 'select * from pictures where type=:type';
        $pictures = Pictures::findBySql($sql, array(':type'=>$type))->all();

        return $this->render('index',[
            'pictures' => $pictures,
            ]);
    }

    public function actionUser(){

//        $sql = "SELECT * FROM `order`  inner join user on order.userid=user.userid";

        $user = Operator::find()->all();

         return $this->render('user',[
             'users'=> $user,
             ]);
    }


    public function actionLogin()
    {
        $this->layout = "login.php";
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
             $this->layout = "main.php";
             return $this->runAction('index');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionUpload()
    {  
        $model = new UploadForm();
        $pic = new Pictures();
        $request = YII::$app->request;


         if (Yii::$app->request->isPost) {
             $model->file = UploadedFile::getInstance($model, 'file');
             $name = time();

        //     //$url = Yii::$app->basePath."/web".'/';


            if ($model->validate()) {                
                $model->file->saveAs('../../Ontee/web/pictures/' . $name. '.' . $model->file->extension);
                $pic->url = 'pictures/'.$name.'.'.$model->file->extension;
                $pic->name = $model->file->baseName;

                $pic->type = $request->get('type');
                $pic->save();
                return $this->redirect(Url::to(['site/index','type'=>$pic->type]));
            }
         }

    }


    public function actionOrder() {
        

        $request = Yii::$app->request;
        $id = $request->get('id');
        if(empty($id)){
            $orders = Order::find()->with('address')->all();
            return $this->render('order',[
                'orders' => $orders,
            ]);
        }else{
            $orders = Order::find()->Where(['userid' => $id])->with('address')->all();
            return $this->render('order',[
                'orders' => $orders,
            ]);
        }
        
    }


    public function actionFonts(){

        $fonts = Fonts::find()->all();
        return $this->render('font',[
            'fonts' => $fonts]);
    }
}
