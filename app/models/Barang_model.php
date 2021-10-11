<?php

class Barang_model {

  private $tableBrg = 'barang';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getAllBarang() {
    $this->db->query('SELECT * FROM supplier_view');
    return $this->db->resultSet();

  }

  public function getOptionSpl() {
    $this->db->query('SELECT * FROM supplier');
    return $this->db->resultSet();
  }

  // public function getMahasiswaById($No_po) {
  //     $this->db->query('SELECT * FROM ' . $this->tableDetail . ' WHERE No_po=:No_po');
  //     $this->db->bind('No_po', $No_po);
  //     return $this->db->resultSet();
  // }

  }

 ?>
