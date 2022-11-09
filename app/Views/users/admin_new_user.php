<?php

$this->extend('layouts/layout_users');
$session = session();

?>

<?php $this->section('content') ?>



<!-- New user form -->

<div class="row my-5">

    <legend class="text-center">Adicionar novo Usuário</legend>

    <div class="col-4 offset-4 card bg-light p-2">


        <form action="<?php echo site_url('users/admin_new_user') ?>" method="POST">

            <div class="form-group">



                <input type="text" name="text_username" class="form-control my-3" placeholder="Usuario" required>

                <input type= "text" name="text_password" class="form-control my-2" placeholder="Senha" value="<?= old('text_password') ?>" required>

                <input type="text" name="text_repeat_password" class="form-control my-2" placeholder="Repetir senha" required>


                <div>

                    <button type="button" class="btn btn-outline-primary btn-sm" id="btn-password">Gerar senha</button>


                    <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-limpar">Limpar senha</button>

                </div>



                <input type="text" name="text_name" class="form-control my-2" placeholder="Nome" required>

                <input type="email" name="text_email" class="form-control my-2" placeholder="Email" required>



                <!-- Profile -->

                <fieldset>

                    <legend class="mt-2">Perfil</legend>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="check_admin">
                        <label class="form-check-label">Administrador</label>
                    </div>


                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="check_moderator">
                        <label class="form-check-label">Moderador</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="check_user" checked>
                        <label class="form-check-label">Usuario</label>
                    </div>

                </fieldset>

            </div>

            <div class="row mt-3">

                <div class="form-group col-6 text-center">
                    <small> <a href="<?php echo site_url('users/admin_users') ?>" class="btn btn-outline-secondary mb-3">Cancelar</a></small>


                </div>

                <div class="form-group col-6 text-center">

                    <button class="btn btn-outline-primary">Adicionar</button>

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