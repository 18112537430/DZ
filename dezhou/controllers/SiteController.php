<?php

namespace app\controllers;

use app\models\Games;
use app\services\ArithmeticService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    public $enableCsrfValidation = false;


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
        return $this->render('index');
    }

    public function actionTest()
    {
       $obj = new ArithmeticService(10);
       $obj->setType(ArithmeticService::HP);
        $obj->setThroughIncrease(1);
        $obj->setTimeYl(10);
        $obj->calculateData();
        foreach($obj->getData() as $item){
            echo "{$item[0]} \t\t {$item[1]}\t\t {$item[2]}\t\t {$item[3]}\t\t<br/>";
        }

    }





}
