<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class stocks extends BaseController
{

    // ==============================================================================
    public function index()
    {

        echo view('stocks/main');
    }

    public function metodo1()
    {
        echo '1';
    }

    public function metodo2()
    {

        echo '2';
    }

    public function metodo3()
    {

        echo '3';
    }

    public function metodo4()
    {

        echo '4';
    }
}
