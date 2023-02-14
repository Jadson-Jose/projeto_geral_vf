<?php

namespace App\Models;

use CodeIgniter\Model;

class StocksModel extends Model
{

    protected $database;

    // ==============================================================================================
    public function __construct()
    {

        $this->database = db_connect();
    }

    // ==============================================================================================
    public function get_all_families()
    {

        // Returs all families
        // $query = "SELECT * FROM stock_familias";
        // return $this->database->query($query)->getResult('array');

        $query = "SELECT a.*, b.designacao AS parent FROM stock_familias a LEFT JOIN stock_familias b ON a.id_parent = b.id_familia";

        return $this->database->query($query)->getResult('array');
    }

    // ==============================================================================================
    public function check_family($designacao) {

        $params = array(
            $designacao 
        );
        $results = $this->database->query("SELECT * FROM stock_familias WHERE designacao = ?", $params)->getResult('array');
        if (count($results) != 0 ) {
            return true;
        } else {
            return false;
        }
    }

    // ==============================================================================================
    public function family_add(){

        // Adiciona uma nova familia de produtos a base de dados
        $request = \Config\Services::request();
        $params = array(
            $request->getPost('select_parent'),
            $request->getPost('text_designacao')
        );

        $this->query("INSERT INTO stock_familias")
    }
}
