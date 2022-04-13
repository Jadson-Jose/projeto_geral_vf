<?php

$this->extend('layouts/layout_stocks');

?>


<?php $this->section('content'); ?>

<div class="row">

    <div class="col-12">

        <h3 class="mt-3">Famílias</h3>
        <hr>

        <!-- Apresentação da tabela com as familias registradas
            Total de familias 
            Em cada row de familia, botao para editar e eliminar
        -->

        <div class="row">
            <div class="col6 align-self-end">

                <h5>Familias de produtos: </h5>

            </div>

            <div class="col6 text-end">

                <a href="" class="btn btn-outline-primary mb-3">Adicionar familia...</a>

            </div>
        </div>


        <table class="table table-hover">

            <thead class="table-active">
                <th>ID</th>
                <th>Família</th>
                <th>Ações</th>
            </thead>

            <tbody>
                <?php foreach ($familias as $familia) : ?>
                    <tr>
                        <td><?php echo $familia['id_familia'] ?></td>
                        <td><?php echo $familia['designacao'] ?></td>

                        <td>
                            <!-- Acoes -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    </div>
</div>

<?php $this->endSection(); ?>