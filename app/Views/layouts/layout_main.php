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
                <h3>Projeto Geral</h3>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <?php $this->renderSection('content'); ?>
            </div>
        </div>

    </div>


    
    <!-- Script -->
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>