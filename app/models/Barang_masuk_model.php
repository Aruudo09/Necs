<?php

    class Barang_masuk_model {

      private $tableBrgMsk = 'barang_msk' ;
      private $db;

      public function __construct() {
        $this->db = new Database;
      }

      public function getAllBarangMsk() {
        $this->db->query('SELECT * FROM barang_msk');
        return $this->db->resultSet();
      }

    }

 ?>
