<?php

namespace app\modules\users;

/**
 * users module definition class
 */
class UsersManagement extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\users\controllers';

    public $layout = 'users_layout';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setAliases([
            '@USER-assets' => __DIR__ . '/assets'
        ]);
    }

    public function getIcon()
    {
        return 'users';
    }
}
