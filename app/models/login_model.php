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

    public function username($data) {
      $query = "SELECT USERNAME, PASSWORD FROM user WHERE USERNAME = :usrName";
      $this->db->query($query);
      $this->db->bind('usrName', $data['usrName']);
      $dt = $this->db->single();

      if ($this->db->rowCount() == 1) {
        if (password_verify($data['password'], $dt['PASSWORD'])) {
          return $dt['USERNAME'];
        }
      }
    }

    public function kodef($data) {
      $query = "SELECT KODEF, PASSWORD FROM user WHERE USERNAME = :usrName";
      $this->db->query($query);
      $this->db->bind('usrName', $data['usrName']);
      $dt = $this->db->single();

      if ($this->db->rowCount() == 1) {
        if (password_verify($data['password'], $dt['PASSWORD'])) {
          return $dt['KODEF'];
        }
      }
    }

    public function initial($data) {
      $query = "SELECT b.Initial, a.PASSWORD FROM user a INNER JOIN tarif b ON a.KODEF = b.KODEF WHERE USERNAME = :usrName";
      $this->db->query($query);
      $this->db->bind('usrName', $data['usrName']);
      $dt = $this->db->single();

      if ($this->db->rowCount() == 1) {
        if (password_verify($data['password'], $dt['PASSWORD'])) {
          return $dt['Initial'];
        }
      }
    }

    public function nmdef($data) {
      $query = "SELECT b.NMDEF, a.PASSWORD FROM user a INNER JOIN tarif b ON a.KODEF = b.KODEF WHERE USERNAME = :usrName";
      $this->db->query($query);
      $this->db->bind('usrName', $data['usrName']);
      $dt = $this->db->single();

      if ($this->db->rowCount() == 1) {
        if (password_verify($data['password'], $dt['PASSWORD'])) {
          return $dt['NMDEF'];
        }
      }
    }

    public function level($data) {
      $query = "SELECT PASSWORD, level FROM user WHERE USERNAME = :usrName";
      $this->db->query($query);
      $this->db->bind('usrName', $data['usrName']);
      $dt = $this->db->single();

      if ($this->db->rowCount() == 1) {
        if (password_verify($data['password'], $dt['PASSWORD'])) {
          return $dt['level'];
        }
      }
    }

  }

 ?>
