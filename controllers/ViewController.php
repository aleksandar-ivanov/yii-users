<?php


namespace app\modules\users\controllers;


use app\modules\users\models\User;
use yii\web\Controller;

class ViewController extends Controller
{
    public function actionIndex($id)
    {
        $user = User::findOne(['id' => $id]);

        var_dump($user);
    }
}