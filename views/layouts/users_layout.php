<?php $this->beginContent('@app/views/layouts/main.php');
    \app\modules\users\assets\UsersAssetsBundle::register($this);
?>

    <?= $content; ?>
<?php $this->endContent(); ?>