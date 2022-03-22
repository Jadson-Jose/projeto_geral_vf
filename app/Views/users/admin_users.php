<?php

$this->extend('layouts/layout_users');
$session = session();

?>


<?php $this->section('content'); ?>

<div class="row">

    <div class="col-12">

        <div class="mt-2 mb-2">

            <a href="<?php echo site_url('users/admin_new_user') ?>" class="btn btn-outline-primary btn-sm">Novo utilizador...</a>

            <a href="<?php echo site_url('users') ?>" class=" btn btn-outline-danger btn-sm text-end align-self-center">Voltar</a>

        </div>




    </div>

</div>


<div>

    <table class="table table-hover">

        <thead class="table-active">

            <th></th>
            <th class="text-center">Usuário</th>
            <th class="text-center">Nome</th>
            <th class="text-center">Email</th>
            <th class="text-center">Último login</th>
            <th class="text-center">Perfil</th>
            <th class="text-center">Ativo</th>
            <th class="text-center">Deletado</th>
            <th></th>
            <th></th>

        </thead>

        <tbody>

            <?php foreach ($users as $user) : ?>

                <tr class="table-acive">

                    <!-- Edit | deleted -->
                    <?php if ($session->id_user == $user['id_user']) : ?>

                        <td>

                            <span class="btn btn-outline-secondary btn-sm"><em class="fa fa-pencil"></em></span>
                            <span class="btn btn-outline-secondary btn-sm"> <em class="fa fa-trash"></em></span>

                        </td>

                    <?php else : ?>

                        <td>

                            <a href="<?php echo site_url('users/admin_edit_user/' . $user['id_user']) ?>" class="btn btn-outline-primary btn-sm"><em class="fa fa-pencil"></em></a>



                            <?php if ($user['deleted'] == 0) : ?>

                                <a href="<?php echo site_url('users/admin_delete_user/' . $user['id_user']) ?>" class="btn btn-outline-danger btn-sm"><em class="fa fa-trash"></em></a>

                            <?php else : ?>


                                <a href="<?php echo site_url('users/admin_recover_user/' . $user['id_user']) ?>" class="btn btn-outline-danger btn-sm"><em class="fa fa-recycle"></em></a>

                            <?php endif; ?>

                        </td>

                    <?php endif; ?>

                    <td class="text-center"><?php echo $user['username'] ?></td>
                    <td class="text-center"><?php echo $user['name'] ?></td>
                    <td class="text-center"><?php echo $user['email'] ?></td>
                    <td class="text-center"><?php echo $user['last_login'] ?></td>

                    <!-- Admin or other type of user -->
                    <?php if (preg_match("/admin/", $user['profile'])) : ?>
                        <td class="text-center"><em class="fa fa-user" title="Admin"></em></td>
                    <?php else : ?>
                        <td class="text-center"><em class="fa fa-user-o" title="Not admin"></em></td>
                    <?php endif; ?>



                    <!-- active or inactive -->
                    <?php if ($user['active'] == 1) : ?>
                        <td class="text-center"><em class="fa fa-check text-success"></em></td>
                    <?php else : ?>
                        <td class="text-center"><em class="fa fa-times text-danger"></em></td>
                    <?php endif; ?>


                    <!-- deleted or not -->
                    <?php if ($user['deleted'] != 0) : ?>
                        <td class="text-center"><em class="fa fa-check text-success"></em></td>
                    <?php else : ?>
                        <td class="text-center"><em class="fa fa-times text-danger"></em></td>
                    <?php endif; ?>


                    <td></td>
                    <td></td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

</div>

<div>Total: <strong> <?php echo count($users) ?></strong></div>


<?php $this->endSection(); ?>