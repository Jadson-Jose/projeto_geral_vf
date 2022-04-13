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
        $query = "SELECT * FROM stock_familias";
        return $this->database->query($query)->getResult('array');
    }
}
