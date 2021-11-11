<?php

class Barang_model {

  private $tableBrg = 'barang';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function statsBrg() {
    $this->db->query('SELECT KODE_BRG, b.NAMA_SP, NAMA_BRG, Jenis_brg, STOCK_MIN, STOCK_MAX, Stock_brg, Satuan, a.Tanggal_beli, Harga FROM barang a JOIN supplier b ON a.KODE_SP = b.KODE_SP WHERE STOCK_MIN >= Stock_brg OR STOCK_MAX <= Stock_brg ORDER BY NAMA_BRG ASC');
    return $this->db->resultSet();
  }

  public function getAllBarang() {
    $this->db->query('SELECT KODE_BRG, b.NAMA_SP, NAMA_BRG, Jenis_brg, Stock_brg, Satuan, a.Tanggal_beli, Harga FROM barang a JOIN supplier b ON a.KODE_SP = b.KODE_SP ORDER BY NAMA_BRG ASC');
    return $this->db->resultSet();
  }

  public function getOptionSpl() {
    $this->db->query('SELECT * FROM supplier');
    return $this->db->resultSet();
  }

  public function getOptBrg() {
    $this->db->query('SELECT NAMA_BRG FROM barang');
    return $this->db->resultSet();
  }

  public function tambahBrg($data) {
    $query = "INSERT INTO barang (KODE_BRG, KODE_SP, NAMA_BRG, Jenis_brg, STOCK_MIN, STOCK_MAX, Stock_brg, Satuan, Tanggal_beli, Harga) VALUES (NULL, :inputSpl, :inputNamaBrg, :inputJnsBrg, :stckMin, :stckMax, :stockBrg, :satuan, :tanggalInput, :harga)";

              $this->db->query($query);
              $this->db->bind('inputSpl', $data['inputSpl']);
              $this->db->bind('inputNamaBrg', $data['inputNamaBrg']);
              $this->db->bind('inputJnsBrg', $data['inputJnsBrg']);
              $this->db->bind('stckMin', $data['stckMin']);
              $this->db->bind('stckMax', $data['stckMax']);
              $this->db->bind('stockBrg', $data['stockBrg']);
              $this->db->bind('satuan', $data['satuan']);
              $this->db->bind('tanggalInput', $data['tanggalInput']);
              $this->db->bind('harga', $data['harga']);

              $this->db->execute();

              return $this->db->rowCount();
  }

  public function hapusDataBrg($Kode_brg) {
    $query = "DELETE FROM barang WHERE KODE_BRG=:Kode_brg";
    $this->db->query($query);
    $this->db->bind('Kode_brg', $Kode_brg);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getBrgUbah($Kode_brg) {
    $this->db->query('SELECT * FROM barang WHERE KODE_BRG=:Kode_brg');
    $this->db->bind('Kode_brg', $Kode_brg);
    return $this->db->single();
  }

  public function ubahBrg($data) {
    $query = "UPDATE barang SET
                KODE_SP = :inputSpl,
                NAMA_BRG = :inputNamaBrg,
                Jenis_brg = :inputJnsBrg,
                Stock_brg = :stockBrg,
                Satuan = :satuan,
                Harga = :harga
                WHERE KODE_BRG = :kodeBrg";

    $this->db->query($query);
    $this->db->bind('inputSpl', $data['inputSpl']);
    $this->db->bind('inputNamaBrg', $data['inputNamaBrg']);
    $this->db->bind('inputJnsBrg', $data['inputJnsBrg']);
    $this->db->bind('stockBrg', $data['stockBrg']);
    $this->db->bind('satuan', $data['satuan']);
    $this->db->bind('harga', $data['harga']);
    $this->db->bind('kodeBrg', $data['kodeBrg']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function cariData() {
    $keyword = $_POST['keyword'];
    $query = "SELECT KODE_BRG, b.NAMA_SP, NAMA_BRG, Jenis_brg, Stock_brg, Satuan, a.Tanggal_beli, Harga FROM barang a JOIN supplier b ON a.KODE_SP = b.KODE_SP WHERE NAMA_BRG LIKE :keyword";
    $this->db->query($query);
    $this->db->bind('keyword', "%$keyword%");
    return $this->db->resultSet();
  }

  // public function getMahasiswaById($No_po) {
  //     $this->db->query('SELECT * FROM ' . $this->tableDetail . ' WHERE No_po=:No_po');
  //     $this->db->bind('No_po', $No_po);
  //     return $this->db->resultSet();
  // }

  }

 ?>
