<?php

  class Barang_keluar_model {

    private $tableBrgKlr = 'barang_keluar';
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function getAllBarangKlr() {
      $this->db->query('SELECT NOMOR_SLIP, a.KODE_BRG, b.NAMA_BRG, SHIFT, POSTING, TANGGAL_OUT, KETERANGAN, NAMA_USER, NO_REF, b.Stock_brg, QUANTITY_MINTA FROM barang_keluar a JOIN barang b ON a.KODE_BRG = b.KODE_BRG');

      return $this->db->resultSet();
    }

    public function getBrgKlrUbah($data) {
      $this->db->query('SELECT * FROM barang_keluar WHERE NOMOR_SLIP=:No_pakai AND KODE_BRG = :kode_brg');
      $this->db->bind('No_pakai', $data['No_pakai']);
      $this->db->bind('kode_brg', $data['kode_brg']);
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
      $i = 0;
      $y = 1;
      foreach( $data['nmBrg'] as $brg ) {

      $query = "SELECT Stock_brg FROM barang WHERE barang.KODE_BRG = :kdBrg" .$i. "";

      $this->db->query($query);
      $this->db->bind('kdBrg' .$i , $data['kdBrg'][$i]);
      $stk = $this->db->single();

    if (  $data['qtyMinta'][$i] <= $stk['Stock_brg']) {
        if ( $y == count($data['nmBrg'])) {
          return true;
        }
        else {
          $i++;
          $y++;
          continue;
        }
      } elseif( $data['qtyMinta'][$i] > $stk['Stock_brg']) {
        return false;
      }

    }
    }

    public function tambahBrgKlr($data) {
      $i = 0;
      $y = 1;
      foreach( $data['nmBrg'] as $brg) {
      $query = "INSERT INTO barang_keluar (NOMOR_SLIP, KODE_BRG, SHIFT, POSTING, TANGGAL_OUT, KETERANGAN, NAMA_USER, NO_REF, QUANTITY_MINTA) VALUES (:inputNoPk, :kdBrg" .$i. ", :shift, :posting, :tanggalKeluar, :keterangan" .$i. ", :nama, :noRef, :qtyMinta" .$i. ")";

      $this->db->query($query);
      $this->db->bind('inputNoPk', $data['inputNoPk']);
      $this->db->bind('kdBrg' .$i, $data['kdBrg'][$i]);
      $this->db->bind('shift', $data['shift']);
      $this->db->bind('posting', $data['posting']);
      $this->db->bind('tanggalKeluar', $data['tanggalKeluar']);
      $this->db->bind('keterangan' .$i, $data['keterangan'][$i]);
      $this->db->bind('nama', $data['nama']);
      $this->db->bind('noRef', $data['noRef']);
      $this->db->bind('qtyMinta' .$i, $data['qtyMinta'][$i]);

      $this->db->execute();
      if ( $y == count($data['nmBrg'])) {
        return true;
      } else {
        $i++;
        $y++;
        continue;
      }
    }
      // return $this->db->rowCount();
    }

    public function hapusDataKlr($data) {
      $query = "DELETE FROM barang_keluar WHERE NOMOR_SLIP = :id AND KODE_BRG = :brg";
      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      $this->db->bind('brg', $data['brg']);
      $this->db->execute();
      return $this->db->rowCount();
    }


    public function ubahBrgKlr($data) {
      $query = "UPDATE barang_keluar SET
                  KODE_BRG = :namaBrg2,
                  SHIFT = :shift2,
                  POSTING = :posting2,
                  TANGGAL_OUT = :tanggalkeluar2,
                  KETERANGAN = :keterangan2,
                  NAMA_USER = :nama2,
                  NO_REF = :noRef2,
                  QUANTITY_MINTA = :qtyMinta2
                  WHERE NOMOR_SLIP = :inputNoPk2 AND KODE_BRG = :kd_brg";

      $this->db->query($query);
      $this->db->bind('namaBrg2', $data['namaBrg2']);
      $this->db->bind('shift2', $data['shift2']);
      $this->db->bind('posting2', $data['posting2']);
      $this->db->bind('tanggalkeluar2', $data['tanggalkeluar2']);
      $this->db->bind('keterangan2', $data['keterangan2']);
      $this->db->bind('nama2', $data['nama2']);
      $this->db->bind('noRef2', $data['noRef2']);
      $this->db->bind('qtyMinta2', $data['qtyMinta2']);
      $this->db->bind('inputNoPk2', $data['inputNoPk2']);
      $this->db->bind('kd_brg', $data['kd_brg']);

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
