<?php

$this->extend('layouts/layout_users');
$session = session();

?>


<?php $this->section('content'); ?>


<?php echo view('users/userbar') ?>

<div> Ola, <?php echo $session->name . ' . '  ?> </div>

<div>O meu perfil e de: <?php echo $session->profile ?> </div>


<div class="row mt-4">

    <div class="col-4 text-center"><a href="<?php echo site_url('users/op1') ?>" class="btn btn-outline-primary">op1</a></div>
    <div class="col-4 text-center"><a href="<?php echo site_url('users/op2') ?>" class="btn btn-outline-primary">op2</a></div>

    <?php if (isset($admin)) : ?>
        <div class="col-4 text-center"><a href="<?php echo site_url('users/admin_users') ?>" class="btn btn-outline-primary">Gestão de Utilizadores</a></div>
    <?php endif; ?>

</div>











<a href="<?php echo site_url('users/logout') ?>">Logout</a>


<?php $this->endSection(); ?>