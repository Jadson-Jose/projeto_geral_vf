<?php

$this->extend('layouts/layout_users');
$session = session();

// Profile
$profile = explode(',', $user['profile']);
$check_admin = '';
$check_moderator = '';
$check_user = '';

if (in_array('admin', $profile)) {
    $check_admin = 'checked';
}

if (in_array('moderator', $profile)) {
    $check_moderator = 'checked';
}

if (in_array('user', $profile)) {
    $check_user = 'checked';
}


?>

<?php $this->section('content') ?>



<!-- New edit user form -->

<div class="row my-5">

    <h2 class="text-center">Editar Usuário</h2>

    <div class="col-4 offset-4 card bg-light p-2">


        <form action="<?php site_url('users/admin_edit_user') ?>" method="POST">


            <div class="form-group">


                <fieldset>

                    <legend class="mt-2">Nome do usuário: <strong><?php echo $user['username'] ?></strong></legend>

                    <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">

                    <input type="text" name="text_name" class="form-control my-3" placeholder="Usuario" value="<?php echo $user['name'] ?>" required>

                    <input type="text" name="text_email" class="form-control my-2" placeholder="Nome" value="<?php echo $user['email'] ?>" required>

                </fieldset>

                <!-- Profile -->

                <fieldset>

                    <legend class="mt-2">Perfil</legend>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="check_admin" <?php echo $check_admin ?>>
                        <label class="form-check-label">Administrador</label>
                    </div>


                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="check_moderator" <?php echo $check_moderator ?>>
                        <label class="form-check-label">Moderador</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="check_user" <?php echo $check_user ?>>
                        <label class="form-check-label">Usuario</label>
                    </div>

                </fieldset>

            </div>

            <div class="row my-3">

                <div class="form-group col-6 text-center">
                    <small> <a href="<?php echo site_url('users/admin_users') ?>" class="btn btn-outline-secondary mb-3">Cancelar</a></small>


                </div>

                <div class="form-group col-6 text-center">

                    <button class="btn btn-outline-primary">Atualizar</button>

                </div>

            </div>

        </form>

        <?php if (isset($error)) : ?>
            <div class="alert alert-dismissible alert-danger text-center mt-3" id="error-message">
                <?php echo $error ?>
            </div>
        <?php endif; ?>

    </div>

</div>



<?php $this->endSection() ?>