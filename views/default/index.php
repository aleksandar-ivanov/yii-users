<div class="users-default-index">
    <?php
        if ($errors = Yii::$app->session->getFlash('errors', '', true)) {
            echo "<div class='alert alert-danger'>$errors</div>";
        }

    if ($success = Yii::$app->session->getFlash('success', '', true)) {
        echo "<div class='alert alert-success'>$success</div>";
    }
    ?>
    <form action="/users/default/save" method="POST">
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />

        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="password">Type password</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role">
                <?php
                    foreach ($roles as $role) {
                        echo
                        "<option value='{$role->name}'>
                            {$role->name}
                        </option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Save">
        </div>
    </form>

</div>
