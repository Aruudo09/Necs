<?php

  class Purchased_requisition_model {

    public function __construct() {
      $this->db = new Database;
    }

    public function setpr($data) {
      $query = "SELECT * FROM purchased_requisition WHERE NO_PR = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      return $this->db->single();
    }

    public function getSr() {
      $query = "SELECT * FROM surat_request_tmp WHERE NO_PR IS NULL";
      $this->db->query($query);
      return $this->db->resultSet();
    }

    public function getPr() {
      $query = "SELECT a.NO_PR, a.USER, a.KODEF, b.NMDEF, a.KODE_SP, c.NAMA_SP, a.TGL_PR
                FROM purchased_requisition a
                INNER JOIN tarif b ON a.KODEF = b.KODEF
                INNER JOIN supplier c ON a.KODE_SP = c.KODE_SP
                WHERE status != '1'";

      $this->db->query($query);
      return $this->db->resultSet();
    }

    public function getSp($data) {
      $query = "SELECT a.KODE_SP, b.NAMA_SP FROM surat_request_tmp a INNER JOIN supplier b ON a.KODE_SP = b.KODE_SP WHERE NO_SR = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      $this->db->execute();
      return $this->db->single();
    }

    public function getAllSr() {
      $query = "SELECT a.NO_SR, a.NO_PR, a.TGL_SR, a.PEMINTA, a.KODEF, b.NMDEF, a.KODE_SP, c.NAMA_SP
                FROM surat_request_tmp a
                INNER JOIN tarif b ON a.KODEF = b.KODEF
                INNER JOIN supplier c ON a.KODE_SP = c.KODE_SP
                WHERE status != '1' AND a.NO_PR IS NULL;";
      $this->db->query($query);
      return $this->db->resultSet();
    }

    public function getDtlSr($data) {
      $query = "SELECT a.NO_SR, a.PEMINTA, a.KODEF, c.NMDEF, a.KODE_SP, d.NAMA_SP, a.KODE_BRG, b.NAMA_BRG, a.QTY_MINTA, a.HARGA_SR, a.TOT_HARGA, a.QTY_TERIMA, b.Satuan FROM surat_request a LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
      LEFT JOIN tarif c ON a.KODEF = c.KODEF LEFT JOIN supplier d ON a.KODE_SP = d.KODE_SP WHERE NO_SR = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      return $this->db->resultSet();
    }

    public function tambah($data) {
      $query = "INSERT INTO purchased_requisition (NO_PR, TGL_PR, USER, KODEF, KODE_SP)
                VALUES (:noPr, :tgl_pr, :user, :kodef, :hdnSp)";

      $this->db->query($query);
      $this->db->bind('noPr', $data['noPr']);
      $this->db->bind('tgl_pr', $data['tgl_pr']);
      $this->db->bind('user', $data['user']);
      $this->db->bind('kodef', $_SESSION['login']['KODEF']);
      $this->db->bind('hdnSp', $data['hdnSp']);
      $this->db->execute();

      return $this->db->rowCount();
    }

    public function tambahpr($data) {
      $query = "UPDATE surat_request_tmp SET NO_PR = :noPr WHERE NO_SR = :noSr";

      $this->db->query($query);
      $this->db->bind('noPr', $data['noPr']);
      $this->db->bind('noSr', $data['noSr']);
      $this->db->execute();

      return $this->db->rowCount();
    }

    public function hapus($data) {
      $query = "UPDATE purchased_requisition SET status = '1' WHERE NO_PR = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      $this->db->execute();
      return $this->db->rowCount();
    }

  }

 ?>
