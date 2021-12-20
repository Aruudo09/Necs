<?php

  class account_model {

    public function __construct() {
      $this->db = new Database;
      $this->dbh = new Database;
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

    public function getDept() {
      $query = "SELECT KODEF, NMDEF, Initial FROM tarif";
      $this->db->query($query);
      return $this->db->resultSet();
    }

    public function getUser($page) {
      $key = $_SESSION['cari'];
      $query = "SELECT * FROM user WHERE USERNAME LIKE :key";
      $this->dbh->query($query);
      $this->dbh->bind('key', "%$key%");
      $this->dbh->execute();

      $banyakDataPerHal = 5;
      $banyakData = $this->dbh->rowCount();
      $banyakHal = ceil($banyakData/$banyakDataPerHal);

      if ( $page >= 1 ) {
        $halamanAktif = $page;
      } else {
        $halamanAktif = 1;
      }

      $dataAwal = ($halamanAktif*$banyakDataPerHal) - $banyakDataPerHal;

      $query2 = "SELECT a.USER_ID, a.USERNAME, a.PASSWORD, a.level, a.KODEF, b.NMDEF, a.CREATE_DATE
                  FROM user a
                  LEFT JOIN tarif b ON a.KODEF = b.KODEF WHERE USERNAME LIKE :key LIMIT $dataAwal, $banyakDataPerHal";
      $this->db->query($query2);
      $this->db->bind('key', "%$key%");

      $dt = array(
        "data" => $this->db->resultSet(),
        "banyakHal" => $banyakHal,
        "halamanAktif" => $halamanAktif
      );

      return $dt;

    }

    public function tambah($data) {
      $password = password_hash($data['password'], PASSWORD_DEFAULT);
      $query = "INSERT INTO user (USER_ID, USERNAME, PASSWORD, level, KODEF, CREATE_DATE)
                VALUES
                (NULL, :usrName, :password, :level, :dprt, :tanggal)";

      $this->db->query($query);
      $this->db->bind('usrName', $data['usrName']);
      $this->db->bind('password', $password);
      $this->db->bind('level', $data['level']);
      $this->db->bind('dprt', $data['dprt']);
      $this->db->bind('tanggal', $data['tanggal']);

      $this->db->execute();

      return $this->db->rowCount();
    }

    public function edit($data) {

      if (empty($data['password'])) {
        $query = "UPDATE user SET USERNAME = :usr, KODEF = :dept, level = :level, tanggal_update = curdate() WHERE USER_ID = :hdnID";

        $this->db->query($query);
        $this->db->bind('usr', $data['usr']);
        $this->db->bind('dept', $data['dept']);
        $this->db->bind('level', $data['level']);
        $this->db->bind('hdnID', $data['hdnID']);

        $this->db->execute();

        return $this->db->rowCount();
      } else {
        $query = "UPDATE user SET USERNAME = :usr, PASSWORD = :password, KODEF = :dept, level = :level, tanggal_update = curdate() WHERE USER_ID = :hdnID";

        $this->db->query($query);
        $this->db->bind('usr', $data['usr']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('dept', $data['dept']);
        $this->db->bind('level', $data['level']);
        $this->db->bind('hdnID', $data['hdnID']);

        $this->db->execute();

        return $this->db->rowCount();
      }
    }

    public function getDtl($data) {
      $query = "SELECT USERNAME, KODEF FROM user WHERE USER_ID = :id";
      $this->db->query($query);
      $this->db->bind('id', $data['id']);

      return $this->db->single();
    }

  }

 ?>
