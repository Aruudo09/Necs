<?php

  class Purchased_order_model {

    public function __construct() {
      $this->db = new Database;
      $this->dbh = new Database;
    }

    public function getCounter() {
      $query = "SELECT po FROM counter";
      $this->db->query($query);
      return $this->db->resultSet();
    }

    public function updtCnt() {
      $query = "UPDATE counter SET po = po + 1";
      $this->db->query($query);
      $this->db->execute();
    }

    public function getAllPo($page) {
      $key = $_SESSION['cari'];

      $query2 = "SELECT * FROM purchased_order_tmp WHERE NO_PO LIKE :key AND status != '1'";
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

      $query = "SELECT a.NO_PO, a.TGL_PO, a.PEMESAN, a.KODEF, b.NMDEF, a.KODE_SP, c.NAMA_SP
                FROM purchased_order_tmp a
                LEFT JOIN tarif b ON a.KODEF = b.KODEF
                LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP
                WHERE a.NO_PO LIKE :key AND status != '1'
                ORDER BY a.NO_PO
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

    public function getPr() {
      $query = "SELECT NO_PR FROM surat_request_tmp WHERE NO_PR IS NOT NULL AND NO_PO IS NULL";
      $this->db->query($query);
      return $this->db->resultSet();
    }

    public function getSp($data) {
      $query = "SELECT a.KODE_SP, b.NAMA_SP FROM surat_request_tmp a INNER JOIN supplier b ON a.KODE_SP = b.KODE_SP WHERE NO_PR = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      return $this->db->single();
    }

    public function getBrg($data) {
      $query = "SELECT a.KODE_BRG, c.NAMA_BRG, a.QTY_MINTA, c.Satuan, a.HARGA_SR, a.TOT_HARGA FROM surat_request a LEFT JOIN surat_request_tmp b ON a.NO_SR = b.NO_SR LEFT JOIN barang c ON a.KODE_BRG = c.KODE_BRG WHERE b.NO_PR = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      return $this->db->resultSet();
    }

    public function getPo($data) {
      $query = "SELECT a.NO_PO, a.TGL_PO, a.PEMESAN, a.KODEF, b.NMDEF, a.KODE_SP, c.NAMA_SP
                FROM purchased_order_tmp a
                LEFT JOIN tarif b ON a.KODEF = b.KODEF
                LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP WHERE a.NO_PO = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      return $this->db->single();
    }

    public function getDtl($data) {
      $query="SELECT a.KODE_BRG, b.NAMA_BRG, a.QTY_ORDER, a.QTY_TERIMA, b.Satuan, a.HARGA_PO, a.TOT_HARGA
              FROM purchased_order a
              LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
              WHERE NO_PO = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      $this->db->execute();
      return $this->db->resultSet();
    }

    public function tmbhPo($data) {
      $query = "INSERT INTO purchased_order_tmp (NO_PO, TGL_PO, PEMESAN, KODEF, KODE_SP, status)
                VALUES (:noPo, :tgl_po, :pmsn, :kodef, :hdnSp, DEFAULT)";

      $this->db->query($query);
      $this->db->bind('noPo', $data['noPo']);
      $this->db->bind('tgl_po', $data['tgl_po']);
      $this->db->bind('pmsn', $data['pmsn']);
      $this->db->bind('kodef', $_SESSION['login']['KODEF']);
      $this->db->bind('hdnSp', $data['hdnSp']);

      $this->db->execute();
      return $this->db->rowCount();
    }

    public function tmbhDtl($data) {
      $i = 0;
      $y = 1;
      foreach( $data['qty'] as $dt) {
        if ( $data['qty'][$i] == 0 || is_null($data['qty'][$i]) ) {
          if ($y == count($data['qty'])) {
            return true;
          } else {
            $i++;
            $y++;
            continue;
          }
        } else {
          $query = "INSERT INTO purchased_order (NO_PO, PEMESAN, TGL_PO, KODEF, KODE_SP, KODE_BRG, QTY_ORDER, HARGA_PO, TOT_HARGA, QTY_TERIMA, status)
                    VALUES
                    (:noPo, :pmsn, :tgl_po, :kodef, :hdnSp, :kd" .$i. ", :qty" .$i. ", :hrg" .$i. ", NULL, DEFAULT, DEFAULT)";

          $this->db->query($query);
          $this->db->bind('noPo', $data['noPo']);
          $this->db->bind('pmsn', $data['pmsn']);
          $this->db->bind('tgl_po', $data['tgl_po']);
          $this->db->bind('kodef', $_SESSION['login']['KODEF']);
          $this->db->bind('hdnSp', $data['hdnSp']);
          $this->db->bind('kd' .$i, $data['kd'][$i]);
          $this->db->bind('qty' .$i, $data['qty'][$i]);
          $this->db->bind('hrg' .$i, $data['hrg'][$i]);

          $this->db->execute();

          if ($y == count($data['qty'])) {
            return true;
          } else {
            $i++;
            $y++;
            continue;
          }
        }
      }
    }

    public function ubahDtl($data) {
      $i = 0;
      $y = 1;
      foreach ($data['qty'] as $dt) {
        $query = "UPDATE purchased_order SET QTY_ORDER = :qty" .$i. " WHERE NO_PO = :Po AND KODE_BRG = :kd" .$i. "";
        $this->db->query($query);
        $this->db->bind('qty' .$i, $data['qty'][$i]);
        $this->db->bind('kd' .$i, $data['kd'][$i]);
        $this->db->bind('Po', $data['Po']);
        $this->db->execute();

        if ( $y == count($data['qty']) ) {
          return true;
        } else {
          $i++;
          $y++;
          continue;
        }
      }
    }

    public function setPo($data) {
      $query = "UPDATE surat_request_tmp SET NO_PO = :noPo WHERE NO_PR = :noPr";

      $this->db->query($query);
      $this->db->bind('noPo', $data['noPo']);
      $this->db->bind('noPr', $data['noPr']);
      $this->db->execute();
    }

    public function hapus($data) {
      $query = "UPDATE purchased_order_tmp SET status = '1' WHERE NO_PO = :id";

      $this->db->query($data);
      $this->db->bind('id', $data);
      $this->db->execute();

      return $this->db->rowCount();
    }

  }

 ?>
