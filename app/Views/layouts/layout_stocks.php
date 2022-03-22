<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME . " " . APP_VERSION ?></title>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css') ?>">

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 text-center bg-dark text-light p-3">
                <h3>Projeto Geral - Stocks</h3>
            </div>
        </div>


        <div class="row mb-5">

            <div class="col-2">

                <div class="text-center mt-3 mb-3">

                    <a href="<?php echo site_url('stocks/metodo1') ?>" class="btn btn-outline-secondary mb-2 btn-200">Botao 1</a>
                    <a href="<?php echo site_url('stocks/metodo2') ?>" class="btn btn-outline-secondary mb-2 btn-200">Botao 2</a>
                    <a href="<?php echo site_url('stocks/metodo3') ?>" class="btn btn-outline-secondary mb-2 btn-200">Botao 3</a>
                    <a href="<?php echo site_url('stocks/metodo4') ?>" class="btn btn-outline-secondary mb-2 btn-200">Botao 4</a>
                    <a href="<?php echo site_url('stocks/') ?>" class="btn btn-outline-secondary mb-2 btn-200">Botao 5</a>

                </div>

            </div>

            <div class="col-10">
                <?php $this->renderSection('content'); ?>
            </div>
        </div>

    </div>




    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/app.js') ?>"></script>

</body>

</html>