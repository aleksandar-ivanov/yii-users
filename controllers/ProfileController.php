<?php
/**
 * Created by PhpStorm.
 * User: aleksandar-ivanov-PC
 * Date: 07/05/2018
 * Time: 13:55
 */

namespace app\modules\users\controllers;


use yii\web\Controller;

class ProfileController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}