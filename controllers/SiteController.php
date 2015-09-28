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

                        'actions' => [ 'index','logout','upload','order'],
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
        $type = $request->get('type');
        $sql = 'select * from pictures where type=:type';
        $pictures = Pictures::findBySql($sql, array(':type'=>$type))->all();

        return $this->render('index',[
            'pictures' => $pictures,
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


        // if (Yii::$app->request->isPost) {
        //     $model->file = UploadedFile::getInstance($model, 'file');
        //     $name = time();

        //     //$url = Yii::$app->basePath."/web".'/';


            if ($model->validate()) {                
                $model->file->saveAs('../../Ontee/web/pictures/' . $name. '.' . $model->file->extension);
                $pic->url = 'pictures/'.$name.'.'.$model->file->extension;
                $pic->name = $model->file->baseName;

                $pic->type = $request->get('type');
                $pic->save()
                return $this->redirect(Url::to(['site/index','type'=>$pic->type]));
            }

    }


    public function actionOrder() {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $sql = 'select * from `order` where id=:id';
        $order = Order::findBySql($sql, array(':id'=>$id))->asArray()->one();
        return $order['frontpic'];
    }
}
