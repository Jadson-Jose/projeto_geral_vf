<?php

use CodeIgniter\Throttle\ThrottlerInterface;

$this->extend('layouts/layout_users');


?>

<?php $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3 mt-5 card p-3">

            <legend>Deseja eliminar o utilizador ? <strong><?php echo $user['name'] ?></strong></legend>

            <div class="form-group">

                <a href="<?php echo site_url('users/admin_users') ?>" class="btn btn-outline-secondary text-end mt-4">Não</a>


                <a href="<?php echo site_url('users/admin_delete_user/' . $user['id_user'] . '/yes') ?>" class="btn btn-outline-primary mt-4">Sim</a>

            </div>

        </div>

        <?php $this->endSection() ?>