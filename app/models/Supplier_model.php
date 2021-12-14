<?php

class Supplier_model {

    private $db;

    public function __construct() {
      $this->db = new Database;
      $this->dbh = new Database;
    }

    public function getAllSupplier($page) {
      $key = $_SESSION['cari'];
      $query = "SELECT * FROM supplier WHERE status != 1 AND NAMA_SP LIKE :key";
      $this->dbh->query($query);
      $this->dbh->bind('key', "%$key%");
      $this->dbh->execute();

      $banyakDataPerHal = 7;
      $banyakData = $this->dbh->rowCount();
      $banyakHal = ceil($banyakData/$banyakDataPerHal);

      if ( $page >= 1) {
        $halamanAktif = $page;
      } else {
        $halamanAktif = 1;
      }

      $dataAwal = ($halamanAktif*$banyakDataPerHal) - $banyakDataPerHal;

      $query2 = "SELECT * FROM supplier WHERE status != 1 AND NAMA_SP LIKE :key LIMIT $dataAwal, $banyakDataPerHal";
      $this->db->query($query2);
      $this->db->bind('key', "%$key%");

      $dt = array(
        "data" => $this->db->resultSet(),
        "banyakHal" => $banyakHal,
        "halamanAktif" => $halamanAktif
      );

      return $dt;
    }

    public function tambahSupplier($data) {
      $query = "INSERT INTO supplier
                  VALUES
                  (:inputNoSpl, :inputNmSpl, :alamatSpl, :telepon, :email, :hubungan, :npwp, :tanggalInput, '', :qtyBln)";

      $this->db->query($query);

      $this->db->bind('inputNoSpl', $data['inputNoSpl']);
      $this->db->bind('inputNmSpl', $data['inputNmSpl']);
      $this->db->bind('alamatSpl', $data['alamatSpl']);
      $this->db->bind('telepon', $data['telepon']);
      $this->db->bind('email', $data['email']);
      $this->db->bind('hubungan', $data['hubungan']);
      $this->db->bind('npwp', $data['npwp']);
      $this->db->bind('tanggalInput', $data['tanggalInput']);
      $this->db->bind('qtyBln', $data['qtyBln']);

      $this->db->execute();

      return $this->db->rowCount();
    }

    public function hapusSupplier($data) {
      $query = "UPDATE supplier SET status = 1 WHERE KODE_SP = :KODE_SP";

      $this->db->query($query);
      $this->db->bind('KODE_SP', $data);

      $this->db->execute();
      return $this->db->rowCount();
    }

    public function getSplUbah($No_spl) {
      $this->db->query('SELECT * FROM supplier WHERE KODE_SP=:No_supplier');
      $this->db->bind('No_supplier', $No_spl);
      return $this->db->single();
    }

    public function ubahSpl($data) {
    $query = "UPDATE supplier SET
                NAMA_SP = :inputNmSpl,
                ALAMAT_SP = :alamatSpl,
                TELEPON = :telepon,
                email = :email,
                HUBUNGAN = :hubungan,
                npwp = :npwp,
                Tanggal_update = :tanggalUpdate
                WHERE KODE_SP = :No_spl";

    $this->db->query($query);
    $this->db->bind('inputNmSpl', $data['inputNmSpl']);
    $this->db->bind('alamatSpl', $data['alamatSpl']);
    $this->db->bind('telepon', $data['telepon']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('hubungan', $data['hubungan']);
    $this->db->bind('npwp', $data['npwp']);
    $this->db->bind('tanggalUpdate', $data['tanggalUpdate']);
    $this->db->bind('No_spl', $data['No_spl']);

    $this->db->execute();

    return $this->db->rowCount();
  }

}

 ?>
