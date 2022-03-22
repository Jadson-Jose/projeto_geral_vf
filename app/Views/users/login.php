<?php $this->extend('layouts/layout_users'); ?>

<?php $this->section('content'); ?>


<?php echo view('users/userbar') ?>



<div class="row my-5">

    <div class="col-4 offset-4 card bg-light p-2">


        <form action="<?php echo site_url('users/login') ?>" method="POST">

            <div class="form-group">

                <input type="text" name="text_username" class="form-control my-3" placeholder="Username" value="<?= old('text_username') ?>">

                <input type="password" name="text_password" class="form-control my-2" placeholder="Password" value="<?= old('text_password') ?>">

            </div>

            <div class="row">

                <div class="form-group col-6 my-2">
                    <small> <a href="<?php echo site_url('users/recover') ?>">Recuperar Senha.</a></small>
                </div>

                <div class="form-group col-6 text-end">
                    <input type="submit" value="Logar" class="btn btn-primary mb-3">

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


<?php $this->endSection(); ?>