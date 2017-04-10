<?php
/**
 * Created by autumn.
 * Date: 2017-4-1
 * Time: 3:13
 */

namespace app\commands;


use yii\console\Controller;

class GameController extends Controller
{
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }


    public function actionStart()
    {

    }
}