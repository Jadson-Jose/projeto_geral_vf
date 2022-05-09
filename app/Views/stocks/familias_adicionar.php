<?php $this->extend('layouts/layout_stocks') ?>;

<?php $this->section('content') ?>

<div class="row">

    <div class="col-12">

        <h3 class="mt-3">Familias > Adicionar</h3>

        <div class="col-12 mt-3">

            <form action="" method="POST">

                <div class="form-group">
                    <label>Familia que pertence:</label>

                    <select name="" id="" class="form-control">
                        <option value="0">Nenhuma</option>
                        <?php foreach ($familias as $familia) : ?>
                            <option value="<?php echo $familia['id_familia'] ?>"><?php echo $familia['designacao'] ?></option>
                        <?php endforeach ?>
                    </select>

                </div>

                <div class="form-group mt-3">
                    <label>Designacao:</label>
                    <input type="text" class="form-control" name="text_designacao" required>

                </div>

                <div class="form-group mt-3">
                    <a href="<?php echo site_url('stocks/familias') ?>" class="btn btn-secondary">Cancelar</a>
                    <button class="btn btn-primary">Salvar</button>
                </div>


            </form>

        </div>

    </div>

</div>

<?php $this->endSection() ?>
