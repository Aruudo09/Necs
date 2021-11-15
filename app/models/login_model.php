<?php

  class login_model {

    public function __construct() {
      $this->db = new Database;
    }

    public function cek($data) {
      $query = "SELECT * FROM user WHERE USERNAME = :usrName";
      $this->db->query($query);
      $this->db->bind('usrName', $data['usrName']);
      $dt = $this->db->single();

      if ($this->db->rowCount() == 1) {
        if (password_verify($data['password'], $dt['PASSWORD'])) {
          return true;
        } else {
          return false;
        }
      }
    }

  }

 ?>
