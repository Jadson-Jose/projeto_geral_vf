<?php 
    $this->extend('layouts/layout_stocks');
?>

<?php $this->section('content') ?>

    <div class="row mt-2">
        
        <div class="col-12" >
            <h4>Familias > Adicionar</h4>
            <hr>
        </div>

        <div class="col-12 mt-3">

            <form action="<?php echo site_url('stocks/familias_adicionar')?>" method="POST">
            
            <div class="form-group">
                
                <label>Familia a que pertence</label>
                    <select name="select_parent" class="form-control">
                        <option value="0">Nenhuma</option>
                        <?php foreach($familias as $familia) : ?>
                            <option value="<?php echo $familia['id_familia'] ?>"><?php echo $familia['designacao'] ?></option>
                        <?php endforeach; ?>

                </select>

            </div>    
            
            <div class="form-group my-3">

                <label>Designação</label>
                <input class="form-control" type="text" name="text_designacao" id="" required>

            </div>    
            
            <div class="form-group">
                <a href="<?php echo site_url('stocks/familias') ?>" class="btn btn-secondary">Cancelar</a>
                <button class="btn btn-primary">Salvar</button>
            </div>
            
            </form>

        </div>
         
    </div>

<?php $this->endSection() ?>

