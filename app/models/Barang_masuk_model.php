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

      public function tambahBrgMsk($data) {
        $query = "INSERT INTO barang_msk
                    VALUES
                    (:inputNoMsk, :inputPnr, :inputPng, :totHrg, :tanggalMasuk, :keterangan)";
        $this->db->query($query);
        $this->db->bind('inputNoMsk', $data['inputNoMsk']);
        $this->db->bind('inputPnr', $data['inputPnr']);
        $this->db->bind('inputPng', $data['inputPng']);
        $this->db->bind('totHrg', $data['totHrg']);
        $this->db->bind('tanggalMasuk', $data['tanggalMasuk']);
        $this->db->bind('keterangan', $data['keterangan']);

        $this->db->execute();
        return $this->db->rowCount();

      }

      public function hapusBrgMsk($No_msk) {
        $query = "DELETE FROM barang_msk WHERE No_msk=:No_msk";
        $this->db->query($query);
        $this->db->bind('No_msk', $No_msk);

        $this->db->execute();
        return $this->db->rowCount();
      }

      public function getBrgMskUbah($No_msk) {
        $query = "SELECT * FROM barang_msk WHERE No_msk=:No_msk";
        $this->db->query($query);
        $this->db->bind('No_msk', $No_msk);
        return $this->db->single();
      }

      public function ubahBrgMsk($data) {
        $query = "UPDATE barang_msk SET
                    Pihak_satu = :inputPnr,
                    Pihak_dua = :inputPng,
                    Total_harga = :totHrg,
                    Tanggal_msk = :tanggalMasuk,
                    Keterangan = :keterangan
                    WHERE No_msk = :No_msk";

        $this->db->query($query);
        $this->db->bind('inputPnr', $data['inputPnr']);
        $this->db->bind('inputPng', $data['inputPng']);
        $this->db->bind('totHrg', $data['totHrg']);
        $this->db->bind('tanggalMasuk', $data['tanggalMasuk']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('No_msk', $data['No_msk']);

        $this->db->execute();

        return $this->db->rowCount();
      }

    }

 ?>
