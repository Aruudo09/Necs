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

    public function tambahBrgKlr($data) {
      $query = "INSERT INTO barang_keluar
                  VALUES
                  (:inputNoPk, :inputPk, :userId, :tanggalKeluar, :keterangan)";

      $this->db->query($query);
      $this->db->bind('inputNoPk', $data['inputNoPk']);
      $this->db->bind('inputPk', $data['inputPk']);
      $this->db->bind('userId', $data['userId']);
      $this->db->bind('tanggalKeluar', $data['tanggalKeluar']);
      $this->db->bind('keterangan', $data['keterangan']);

      $this->db->execute();
      return $this->db->rowCount();
    }

    public function hapusDataKlr($No_pakai) {
      $query = "DELETE FROM barang_keluar WHERE No_pakai=:No_pakai";
      $this->db->query($query);
      $this->db->bind('No_pakai', $No_pakai);
      $this->db->execute();
      return $this->db->rowCount();
    }

  }


 ?>
