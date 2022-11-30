<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\StocksModel;

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

        // Adicionar nova familia
        
        // Carregar os dados das familias para passar para a view
        $model = new StocksModel();
        $data ['familias'] = $model->get_all_families();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
            // Vai buscar os dados submetidos pelo fomrulario
            $request = \Config\Services::request();
            $id_parent = $request->getPost('select_parent');
            $id_designacao = $request->getPost('text_designacao');


            // Verificar se ja existe a familia com o mesmo nome
            $resultado = $model->check_family($id_designacao);
            if ($resultado) {
                die('ja existe');
            } else {
                die('nao existe');
            }
            //Guardar na base de dados o valor

              
        }
        
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
