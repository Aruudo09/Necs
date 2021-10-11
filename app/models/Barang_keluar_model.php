<?php

  class Barang_keluar_model {

    private $tableBrgKlr = 'barang_keluar';
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function getAllBarangKlr() {
      $this->db->query('SELECT * FROM barang_keluar');
      return $this->db->resultSet();
    }

  }


 ?>
