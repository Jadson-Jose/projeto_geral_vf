<?php

$session = session();

?>


<div class="text-end">

    <?php if ($session->has('id_user')) : ?>

        <div>

            <em class="fa fa-user me-2"></em>
            <strong class="me-3"><?php echo $session->name ?></strong>
            <a href="<?php echo site_url('users/logout') ?>"><em class="fa fa-sign-out"></em></a>

        </div>

    <?php else : ?>

        <span class="text-muted">Nenhum user logado.</span>

    <?php endif; ?>


</div>