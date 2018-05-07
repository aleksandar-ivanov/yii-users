<?php

namespace app\modules\users\controllers;

use app\modules\users\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Default controller for the `users` module
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['manageUser'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['save'],
                        'roles' => ['createUser'],
                    ],
                ],
            ]
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $roles = array_filter(\Yii::$app->authManager->getRoles(), function ($role) {
            return $role->name !== 'superAdmin';
        });

        return $this->render('index', ['roles' => $roles]);
    }

    public function actionSave()
    {
        $request = \Yii::$app->request;
        $firstName = $request->post('firstName');
        $lastName = $request->post('lastName');
        $email = $request->post('email');
        $password = $request->post('password');
        $role = $request->post('role');

        $now = (new \DateTime())->format('Y-m-d H:i:s');

        $newUser = new User();
        $newUser->first_name = $firstName;
        $newUser->last_name = $lastName;
        $newUser->email = $email;
        $newUser->password = password_hash($password, PASSWORD_DEFAULT);
        $newUser->created_at = $now;
        $newUser->updated_at = $now;
        $newUser->save();

        $chosenRole = \Yii::$app->authManager->getRole($role);
        \Yii::$app->authManager->assign($chosenRole, $newUser->getId());

        \Yii::$app->session->setFlash('success', 'User added', true);
        return $this->redirect('/users');
    }
}
