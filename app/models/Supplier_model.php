<?php

class Supplier_model {

    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function getAllSupplier() {
      $query = "SELECT * FROM supplier";

      $this->db->query($query);
      return $this->db->resultSet();
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
      $query = "DELETE FROM supplier WHERE KODE_SP=:KODE_SP";

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

  public function cariData() {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM supplier WHERE NAMA_SP LIKE :keyword";
    $this->db->query($query);
    $this->db->bind('keyword', "%$keyword%");
    return $this->db->resultSet();
  }

}

 ?>
