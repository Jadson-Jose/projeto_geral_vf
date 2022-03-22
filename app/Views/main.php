<?php

$this->extend('layouts/layout_main');

?>


<?php $this->section('content'); ?>

<a href="<?php echo site_url('users') ?>" class="btn btn-primary btn-200 my-5">Users</a>

<?php $this->endSection(); ?>