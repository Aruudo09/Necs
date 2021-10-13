<?php

class Barang_model {

  private $tableBrg = 'barang';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getAllBarang() {
    $this->db->query('SELECT * FROM tampil_brg');
    return $this->db->resultSet();

  }

  public function getOptionSpl() {
    $this->db->query('SELECT * FROM supplier');
    return $this->db->resultSet();
  }

  public function tambahBrg($data) {
    $query = "INSERT INTO barang
                VALUES
                (:Kode_brg, :inputSpl, :inputNamaBrg, :inputJnsBrg, :stockBrg, :satuan, :tanggalInput, :harga)";

              $this->db->query($query);
              var_dump($query);
              $this->db->bind('Kode_brg', $data['Kode_brg']);
              $this->db->bind('inputSpl', $data['inputSpl']);
              $this->db->bind('inputNamaBrg', $data['inputNamaBrg']);
              $this->db->bind('inputJnsBrg', $data['inputJnsBrg']);
              $this->db->bind('stockBrg', $data['stockBrg']);
              $this->db->bind('satuan', $data['satuan']);
              $this->db->bind('tanggalInput', $data['tanggalInput']);
              $this->db->bind('harga', $data['harga']);

              $this->db->execute();

              return $this->db->rowCount();
  }

  public function hapusDataBrg($Kode_brg) {
    $query = "DELETE FROM barang WHERE Kode_brg=:Kode_brg";
    $this->db->query($query);
    $this->db->bind('Kode_brg', $Kode_brg);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getBrgUbah($Kode_brg) {
    $this->db->query('SELECT * FROM barang WHERE Kode_brg=:Kode_brg');
    $this->db->bind('Kode_brg', $Kode_brg);
    return $this->db->single();
  }

  // public function getMahasiswaById($No_po) {
  //     $this->db->query('SELECT * FROM ' . $this->tableDetail . ' WHERE No_po=:No_po');
  //     $this->db->bind('No_po', $No_po);
  //     return $this->db->resultSet();
  // }

  }

 ?>
