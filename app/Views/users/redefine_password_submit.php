<?php $this->extend('layouts/layout_users') ?>

<?php $this->section('content') ?>


<?php echo view('users/userbar') ?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3 mt-5">

            <form action="<?php echo site_url('users/redefine_password_submit') ?>" method="POST">

                <input type="hidden" name="text_id_user" value="<?php echo $user['id_user'] ?>">

                <fieldset>

                    <legend>Alterar Senha</legend>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label mt-4">Nova Senha</label>
                        <input type="password" name="text_new_password" class="form-control" aria-describedby="emailHelp" placeholder="Nova Senha" required>
                        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1" class="form-label mt-3 ">Repetir Senha</label>
                        <input type="password" name="text_repeat_password" class="form-control" placeholder="Repetir Senha" required>
                    </div>

                    <div class="form-group">
                        <a href="<?php echo site_url('users') ?>" class="btn btn-outline-secondary text-end mt-4">Cancelar</a>
                        <input type="submit" value="Alterar" class="btn btn-outline-primary mt-4">
                    </div>



                </fieldset>

            </form>

            <?php if (isset($error)) : ?>
                <div class="alert alert-dismissible alert-danger text-center mt-3" id="fade">
                    <?php echo $error ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>





<?php $this->endSection() ?>