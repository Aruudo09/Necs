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
                  (:inputNoSpl, :inputNmSpl, :alamatSpl, :tanggalInput, '', :keterangan)";

      $this->db->query($query);

      $this->db->bind('inputNoSpl', $data['inputNoSpl']);
      $this->db->bind('inputNmSpl', $data['inputNmSpl']);
      $this->db->bind('alamatSpl', $data['alamatSpl']);
      $this->db->bind('tanggalInput', $data['tanggalInput']);
      $this->db->bind('keterangan', $data['keterangan']);

      $this->db->execute();

      return $this->db->rowCount();
    }

    public function hapusSupplier($data) {
      $query = "DELETE FROM supplier WHERE No_supplier=:No_supplier";

      $this->db->query($query);
      $this->db->bind('No_supplier', $data['No_supplier']);

      $this->db->execute();
      return $this->db->rowCount();
    }

}

 ?>
