<?php $this->extend('layouts/layout_users') ?>

<?php $this->section('content') ?>

<?php echo view('users/userbar') ?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3 mt-5">

            <form action="<?php echo site_url('users/reset_password') ?>" method="POST">

                <fieldset>

                    <legend>Recuperar senha</legend>

                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label mt-4">Email</label>
                        <input type="email" name="text_email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" required>

                        <div class="form-group">
                            <label for="exampleInputPassword1" class="form-label mt-3 ">Senha</label>
                            <input type="password" name="text_password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <a href="<?php echo site_url('users') ?>" class="btn btn-outline-secondary text-end mt-4">Cancelar</a>
                            <input type="submit" value="Resetar" class="btn btn-outline-primary mt-4">
                        </div>



                </fieldset>

            </form>
        </div>
    </div>
</div>





<?php $this->endSection() ?>