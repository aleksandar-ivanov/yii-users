<?php

use yii\db\Migration;

/**
 * Class m180420_132440_create_roles_permissions
 */
class m180420_132440_create_roles_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $superAdmin = $auth->createRole('superAdmin');
        $auth->add($superAdmin);

        $usersPermissions = [
            'manageUser' => 'Manage users',
            'createUser' => 'Create a User',
            'editUser' => 'Edit a User',
            'deleteUser' => 'Delete a User'
        ];

        $postsPermissions = [
            'managePost' => 'Manage posts',
            'createPost' => 'Create a post',
            'editPost' => 'Edit a post',
            'deletePost' => 'Delete a post'
        ];

        $userManager = $auth->createRole('userManager');
        $auth->add($userManager);
        $auth->addChild($superAdmin, $userManager);

        foreach ($usersPermissions as $name => $usersPermission) {
            $permission = $auth->createPermission($name);
            $permission->description = $usersPermission;
            $auth->add($permission);

            $auth->addChild($userManager, $permission);
        }

        $postsManager = $auth->createRole('postsManager');
        $auth->add($postsManager);
        $auth->addChild($superAdmin, $postsManager);

        foreach ($postsPermissions as $name => $postsPermission) {
            $permission = $auth->createPermission($name);
            $permission->description = $postsPermission;
            $auth->add($permission);

            $auth->addChild($postsManager, $permission);
        }

        $now = (new \DateTime())->format('Y-m-d H:i:s');
        $superAdminModel = new \app\modules\users\models\User();
        $superAdminModel->email = 'aivanov93@abv.bg';
        $superAdminModel->first_name = 'Alex';
        $superAdminModel->last_name = 'Ivanov';
        $superAdminModel->password = password_hash('secret', PASSWORD_DEFAULT);
        $superAdminModel->created_at = $now;
        $superAdminModel->updated_at = $now;
        $superAdminModel->save();

        $auth->assign($superAdmin, $superAdminModel->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180420_132440_create_roles_permissions cannot be reverted.\n";

        return false;
    }
    */
}
