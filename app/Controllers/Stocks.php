<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\StocksModel;
use CodeIgniter\Model;

class stocks extends BaseController
{

    // ==============================================================================
    public function index()
    {

        echo view('stocks/main');
    }


    // ==============================================================================
    public function familias()
    {

        // carregar os dados da familias para passar para a view
        $model = new StocksModel();
        $data['familias'] = $model->get_all_families();

        echo view('stocks/familias', $data);
    }


    // ==============================================================================
    public function familias_adicionar()
    {
        // Add new familie
        $model = new StocksModel();
        $data['familias'] = $model->get_all_families();


        echo view('stocks/familias_adicionar', $data);
    }


    // ==============================================================================
    public function familias_editar($id_familia)
    {

        echo 'Formulario para editar nova familia';
    }

    // ==============================================================================
    public function familias_eliminar($id_familia)
    {

        echo 'Formulario para eliminar nova familia';
    }


    // ==============================================================================
    public function movimentos()
    {

        echo view('stocks/movimentos');
    }


    // ==============================================================================
    public function produtos()
    {

        echo view('stocks/produtos');
    }


    // ==============================================================================
    public function taxas()
    {

        echo view('stocks/taxas');
    }
}
