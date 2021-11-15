<?php

  class account_model {

    public function __construct() {
      $this->db = new Database;
    }

    public function cek($data) {
      $query = "SELECT USERNAME FROM user WHERE USERNAME = :usrName";

      $this->db->query($query);
      $this->db->bind('usrName', $data['usrName']);
      $dt = $this->db->resultSet();
      var_dump($dt);

      if (count($dt) > 0) {
        return false;
      } else {
        return true;
      }
    }

    public function tambah($data) {
      $password = password_hash($data['password'], PASSWORD_DEFAULT);
      $query = "INSERT INTO user (USER_ID, USERNAME, PASSWORD, CREATE_DATE)
                VALUES
                (NULL, :usrName, :password, :tanggal)";

      $this->db->query($query);
      $this->db->bind('usrName', $data['usrName']);
      $this->db->bind('password', $password);
      $this->db->bind('tanggal', $data['tanggal']);

      $this->db->execute();

      return $this->db->rowCount();
    }

  }

 ?>
