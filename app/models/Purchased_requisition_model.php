<?php

  class Purchased_requisition_model {

    public function __construct() {
      $this->db = new Database;
      $this->dbh = new Database;
    }

    public function setpr($data) {
      $query = "SELECT a.NO_PR, a.TGL_PR, a.USER, a.KODEF, b.NMDEF, a.KODE_SP, c.NAMA_SP
                FROM purchased_requisition a
                LEFT JOIN tarif b ON a.KODEF = b.KODEF
                LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP
                WHERE a.NO_PR = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      return $this->db->single();
    }

    public function getSr() {
      $query = "SELECT * FROM surat_request_tmp WHERE NO_PR IS NULL AND status != 1";
      $this->db->query($query);
      return $this->db->resultSet();
    }

    public function getPr($page) {
      $key = $_SESSION['cari'];
      $this->dbh->query('SELECT * FROM purchased_requisition WHERE NO_PR LIKE :key AND status != 1');
      $this->dbh->bind('key', "%$key%");
      $this->dbh->execute();

      $banyakDataPerHal = 5;
      $banyakData = $this->dbh->rowCount();
      $banyakHal = ceil($banyakData/$banyakDataPerHal);

      if ( $page >= 1) {
        $halamanAktif = $page;
      } else {
        $halamanAktif = 1;
      }

      $dataAwal = ($halamanAktif*$banyakDataPerHal) - $banyakDataPerHal;

      $query = "SELECT a.NO_PR, a.USER, a.KODEF, b.NMDEF, a.KODE_SP, c.NAMA_SP, a.TGL_PR
                FROM purchased_requisition a
                LEFT JOIN tarif b ON a.KODEF = b.KODEF
                LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP
                WHERE a.NO_PR LIKE :key AND a.status != '1'
                ORDER BY a.NO_PR DESC
                LIMIT $dataAwal, $banyakDataPerHal";

      $this->db->query($query);
      $this->db->bind('key', "%$key%");

      $dt = array(
        "data" => $this->db->resultSet(),
        "halamanAktif" => $halamanAktif,
        "banyakHal" => $banyakHal
      );

      return $dt;
    }

    public function getDtlPr($data) {
      $query = "SELECT e.NO_PR, a.PEMINTA, a.KODEF, c.NMDEF, a.KODE_SP, d.NAMA_SP, a.KODE_BRG, b.NAMA_BRG, a.QTY_MINTA, a.QTY_TERIMA, b.Satuan
                FROM surat_request a
                LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
                LEFT JOIN tarif c ON a.KODEF = c.KODEF
                LEFT JOIN supplier d ON a.KODE_SP = d.KODE_SP
                LEFT JOIN surat_request_tmp e ON a.NO_SR = e.NO_SR
                LEFT JOIN purchased_requisition f ON e.NO_PR = f.NO_PR
                WHERE f.NO_PR = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      $this->db->execute();

      return $this->db->resultSet();
    }

    public function getAllSr($page) {
      $key = $_SESSION['cari'];
      $query2 = "SELECT *FROM surat_request_tmp WHERE NO_SR LIKE :key AND status != 1 AND NO_PR IS NULL";
      $this->dbh->query($query2);
      $this->dbh->bind('key', "%$key%");
      $this->dbh->execute();

      $banyakDataPerHal = 5;
      $banyakData = $this->dbh->rowCount();
      $banyakHal = ceil($banyakData/$banyakDataPerHal);

      if ( $page >= 1) {
        $halamanAktif = $page;
      } else {
        $halamanAktif = 1;
      }

      $dataAwal = ($halamanAktif*$banyakDataPerHal) - $banyakDataPerHal;

      $query = "SELECT a.NO_SR, a.NO_PR, a.TGL_SR, a.PEMINTA, a.KODEF, b.NMDEF, a.KODE_SP, c.NAMA_SP
                FROM surat_request_tmp a
                LEFT JOIN tarif b ON a.KODEF = b.KODEF
                LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP
                WHERE a.NO_SR LIKE :key AND a.status != 1 AND a.NO_PR IS NULL
                ORDER BY a.NO_SR
                LIMIT $dataAwal, $banyakDataPerHal";
      $this->db->query($query);
      $this->db->bind('key', "%$key%");

      $dt = array(
        "data" => $this->db->resultSet(),
        "halamanAktif" => $halamanAktif,
        "banyakHal" => $banyakHal
      );

      return $dt;
    }

    public function getAllSr2($page) {
      $this->dbh->query('SELECT *FROM surat_request_tmp');
      $this->dbh->execute();

      $banyakDataPerHal = 5;
      $banyakData = $this->dbh->rowCount();
      $banyakHal = ceil($banyakData/$banyakDataPerHal);
      $keyword = $_SESSION['cari'];


      if ( $page >= 1) {
        $halamanAktif = $page;
      } else {
        $halamanAktif = 1;
      }


      $dataAwal = ($halamanAktif*$banyakDataPerHal) - $banyakDataPerHal;

      $query = "SELECT a.NO_SR, a.NO_PR, a.TGL_SR, a.PEMINTA, a.KODEF, b.NMDEF, a.KODE_SP, c.NAMA_SP
                FROM surat_request_tmp a
                INNER JOIN tarif b ON a.KODEF = b.KODEF
                INNER JOIN supplier c ON a.KODE_SP = c.KODE_SP
                WHERE status != '1' AND a.NO_PR IS NULL AND
                a.NO_SR LIKE :keyword
                ORDER BY NO_SR
                LIMIT $dataAwal, $banyakDataPerHal";
      $this->db->query($query);
      $this->db->bind('keyword', "%$keyword%");

      $dt = array(
        "data" => $this->db->resultSet(),
        "halamanAktif" => $halamanAktif,
        "banyakHal" => $banyakHal
      );

      return $dt;
    }

    public function getDtlSr($data) {
      $query = "SELECT a.NO_SR, a.PEMINTA, a.KODEF, c.NMDEF, a.KODE_SP, d.NAMA_SP, a.KODE_BRG, b.NAMA_BRG, a.QTY_MINTA, a.QTY_TERIMA, b.Satuan FROM surat_request a LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
      LEFT JOIN tarif c ON a.KODEF = c.KODEF LEFT JOIN supplier d ON a.KODE_SP = d.KODE_SP WHERE NO_SR = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      return $this->db->resultSet();
    }

    public function tambah($data) {
      $query = "INSERT INTO purchased_requisition (NO_PR, TGL_PR, USER, KODEF, KODE_SP)
                VALUES (CONCAT(:hdnPr, '-', :initial, '/', DATE_FORMAT(NOW(), '%m'), '/', DATE_FORMAT(NOW(), '%y')), :tgl_pr, :user, :kodef, :hdnSp)";

      $this->db->query($query);
      $this->db->bind('hdnPr', $data['hdnPr']);
      $this->db->bind('initial', $_SESSION['login']['Initial']);
      $this->db->bind('tgl_pr', $data['tgl_pr']);
      $this->db->bind('user', $data['user']);
      $this->db->bind('kodef', $_SESSION['login']['KODEF']);
      $this->db->bind('hdnSp', $data['hdnSp']);
      $this->db->execute();

      return $this->db->rowCount();
    }

    public function tambahpr($data) {
      $query = "UPDATE surat_request_tmp SET NO_PR = CONCAT(:hdnPr, '-', :initial, '/', DATE_FORMAT(NOW(), '%m'), '/', DATE_FORMAT(NOW(), '%y')) WHERE NO_SR = :noSr";

      $this->db->query($query);
      $this->db->bind('hdnPr', $data['hdnPr']);
      $this->db->bind('initial', $_SESSION['login']['Initial']);
      $this->db->bind('noSr', $data['noSr']);
      $this->db->execute();

      return $this->db->rowCount();
    }

    public function hapus($data) {
      $query = "UPDATE purchased_requisition SET status = '1' WHERE NO_PR = :id";

      $this->db->query($query);
      $this->db->bind('id', $data);
      $this->db->execute();
      return $this->db->rowCount();
    }

    public function ubah($data) {
      $query = "UPDATE purchased_requisition SET USER = :usr, TGL_PR = :tgl_pr";
      $this->db->query($query);
      $this->db->bind('usr', $data['usr']);
      $this->db->bind('tgl_pr', $data['tgl_pr']);
      $this->db->execute();

      return $this->db->rowCount();
    }

  }

 ?>
