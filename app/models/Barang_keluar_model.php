<?php

  class Barang_keluar_model {

    private $tableBrgKlr = 'barang_keluar';
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function getAllBarangKlr() {
      $this->db->query('SELECT NOMOR_SLIP, b.NAMA_BRG, SHIFT, POSTING, TANGGAL_OUT, KETERANGAN, NAMA_USER, NO_REF, b.Stock_brg, QUANTITY_MINTA FROM barang_keluar a JOIN barang b ON a.KODE_BRG = b.KODE_BRG');

      return $this->db->resultSet();
    }

    public function getBrgKlrUbah($No_pakai) {
      $this->db->query('SELECT * FROM barang_keluar WHERE NOMOR_SLIP=:No_pakai');
      $this->db->bind('No_pakai', $No_pakai);
      return $this->db->single();
    }

    public function getBarangItem() {
      $this->db->query('SELECT * FROM barang');
      return $this->db->resultSet();
    }

    public function getDataCounter() {
      $this->db->query('SELECT klr FROM counter');
      return $this->db->resultSet();
    }

    public function updateCounter() {
      $this->db->query('UPDATE counter SET klr = klr + 1');
      $this->db->execute();
    }

    public function cekStock($data) {
      $query = "SELECT Stock_brg FROM barang, barang_keluar WHERE barang.KODE_BRG = :namaBrg";

      $this->db->query($query);
      $this->db->bind('namaBrg', $data['namaBrg']);
      $stk = $this->db->single();

      var_dump($stk['Stock_brg']);
      if (  $data['qtyMinta'] <= $stk['Stock_brg']) {
        var_dump($data['qtyMinta']);
        return true;
      } else {
        return false;
      }
    }

    public function tambahBrgKlr($data) {
      $query = "INSERT INTO barang_keluar
                  VALUES
                  (:inputNoPk, :namaBrg, :shift, :posting, :tanggalKeluar, :keterangan, :nama, :noRef, :qtyMinta)";

      $this->db->query($query);
      $this->db->bind('inputNoPk', $data['inputNoPk']);
      $this->db->bind('namaBrg', $data['namaBrg']);
      $this->db->bind('shift', $data['shift']);
      $this->db->bind('posting', $data['posting']);
      $this->db->bind('tanggalKeluar', $data['tanggalKeluar']);
      $this->db->bind('keterangan', $data['keterangan']);
      $this->db->bind('nama', $data['nama']);
      $this->db->bind('noRef', $data['noRef']);
      $this->db->bind('qtyMinta', $data['qtyMinta']);

      $this->db->execute();
      return $this->db->rowCount();
    }

    public function hapusDataKlr($No_pakai) {
      $query = "DELETE FROM barang_keluar WHERE NOMOR_SLIP=:No_pakai";
      $this->db->query($query);
      $this->db->bind('No_pakai', $No_pakai);
      $this->db->execute();
      return $this->db->rowCount();
    }


    public function ubahBrgKlr($data) {
      $query = "UPDATE barang_keluar SET
                  KODE_BRG = :namaBrg,
                  SHIFT = :shift,
                  POSTING = :posting,
                  TANGGAL_OUT = :tanggalKeluar,
                  KETERANGAN = :keterangan,
                  NAMA_USER = :nama,
                  NO_REF = :noRef,
                  QUANTITY_MINTA = :qtyMinta
                  WHERE NOMOR_SLIP = :No_pk";

      $this->db->query($query);
      $this->db->bind('namaBrg', $data['namaBrg']);
      $this->db->bind('shift', $data['shift']);
      $this->db->bind('posting', $data['posting']);
      $this->db->bind('tanggalKeluar', $data['tanggalKeluar']);
      $this->db->bind('keterangan', $data['keterangan']);
      $this->db->bind('nama', $data['nama']);
      $this->db->bind('noRef', $data['noRef']);
      $this->db->bind('qtyMinta', $data['qtyMinta']);
      $this->db->bind('No_pk', $data['No_pk']);

      $this->db->execute();

      return $this->db->rowCount();


    }

    public function cariData() {
    $keyword = $_POST['keyword'];
    $query = "SELECT NOMOR_SLIP, b.NAMA_BRG, SHIFT, POSTING, TANGGAL_OUT, KETERANGAN, NAMA_USER, NO_REF, b.Stock_brg, QUANTITY_MINTA FROM barang_keluar a JOIN barang b ON a.KODE_BRG = b.KODE_BRG WHERE NAMA_USER LIKE :keyword";
    $this->db->query($query);
    $this->db->bind('keyword', "%$keyword%");
    return $this->db->resultSet();
  }

  }


 ?>
