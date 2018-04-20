<?php

namespace app\modules\users\controllers;

use yii\web\Controller;

/**
 * Default controller for the `users` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //test change
        $a = 5;
        return $this->render('index');
    }
}
