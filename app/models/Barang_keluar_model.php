<?php

  class Barang_keluar_model {

    private $tableBrgKlr = 'barang_keluar';
    private $db;

    public function __construct() {
      $this->db = new Database;
      $this->dbh = new Database;
    }

    public function getAllBarangKlr($page) {
      $key = $_SESSION['cari'];
      $this->dbh->query('SELECT a.NOMOR_SLIP, a.KODEF, b.NMDEF, a.SHIFT, a.POSTING, a.NO_REF, a.NAMA_USER, a.TANGGAL_OUT FROM barang_keluar_tmp a LEFT JOIN tarif b ON a.KODEF = b.KODEF WHERE a.NOMOR_SLIP LIKE :key');
      $this->dbh->bind('key', "%$key%");
      $this->dbh->execute();

      $banyakData = $this->dbh->rowCount();
      $banyakDataPerHal = 5;
      $banyakHal = ceil($banyakData/$banyakDataPerHal);

      if ( $page >= 1 ) {
        $halamanAktif = $page;
      } else {
        $halamanAktif = 1;
      }

      $dataAwal = ($halamanAktif*$banyakDataPerHal) - $banyakDataPerHal;

      $query = "SELECT a.NOMOR_SLIP, a.KODEF, b.NMDEF, a.SHIFT, a.POSTING, a.NO_REF, a.NAMA_USER, a.TANGGAL_OUT FROM barang_keluar_tmp a LEFT JOIN tarif b ON a.KODEF = b.KODEF WHERE a.NOMOR_SLIP LIKE :key ORDER BY a.NOMOR_SLIP DESC LIMIT $dataAwal, $banyakDataPerHal";
      $this->db->query($query);
      $this->db->bind('key', "%$key%");

      $dt = array(
        "data" => $this->db->resultSet(),
        "banyakHal" => $banyakHal,
        "halamanAktif" => $halamanAktif
      );

      return $dt;
    }

    public function getBrgKlrUbah($data) {
      $this->db->query('SELECT NOMOR_SLIP, TANGGAL_OUT FROM barang_keluar_tmp WHERE NOMOR_SLIP = :id');
      $this->db->bind('id', $data['id']);
      return $this->db->single();
    }

    public function getDtl($data) {
      $query = "SELECT a.NOMOR_SLIP, a.KODEF, b.NMDEF, a.SHIFT, a.POSTING, a.NO_REF, a.NAMA_USER, a.TANGGAL_OUT, a.KODE_BRG, c.NAMA_BRG, a.QUANTITY_MINTA, c.satuan
      FROM barang_keluar a
      LEFT JOIN tarif b ON a.KODEF = b.KODEF
      LEFT JOIN barang c ON a.KODE_BRG = c.KODE_BRG WHERE a.NOMOR_SLIP = :id";

      $this->db->query($query);
      $this->db->bind('id', $data['id']);

      return $this->db->resultSet();
    }

    public function getBarangItem() {
      $this->db->query('SELECT * FROM barang');
      return $this->db->resultSet();
    }

    public function getDataCounter() {
      $this->db->query('SELECT klr FROM counter');
      return $this->db->resultSet();
    }

    public function updateCounter() {
      $this->db->query('UPDATE counter SET klr = klr + 1');
      $this->db->execute();
    }

    public function cekStock($data) {
      $i = 0;
      $y = 1;
      foreach( $data['nmBrg'] as $brg ) {

      $query = "SELECT Stock_brg FROM barang WHERE barang.KODE_BRG = :kdBrg" .$i. "";

      $this->db->query($query);
      $this->db->bind('kdBrg' .$i , $data['kdBrg'][$i]);
      $stk = $this->db->single();

        if (  $data['qtyMinta'][$i] <= $stk['Stock_brg']) {
            if ( $y == count($data['nmBrg'])) {
              return true;
            }
            else {
              $i++;
              $y++;
              continue;
            }
          } elseif( $data['qtyMinta'][$i] > $stk['Stock_brg']) {
            return false;
          }
      }
    }

    public function tambahKlr($data) {
      $query = "INSERT INTO barang_keluar_tmp (NOMOR_SLIP ,KODEF, SHIFT, POSTING, NO_REF, NAMA_USER, TANGGAL_OUT)
                VALUES (CONCAT((SELECT klr FROM counter) + 1, '-K/', DATE_FORMAT(NOW(), '%y')), :kodef, :shift, :posting, :noRef, :nama, :tanggalKeluar)";

      $this->db->query($query);
      $this->db->bind('kodef', $_SESSION['login']['KODEF']);
      $this->db->bind('shift', $data['shift']);
      $this->db->bind('posting', $data['posting']);
      $this->db->bind('noRef', $data['noRef']);
      $this->db->bind('nama', $data['nama']);
      $this->db->bind('tanggalKeluar', $data['tanggalKeluar']);

      $this->db->execute();

      return $this->db->rowCount();
    }

    public function tambahBrgKlr($data) {
      $i = 0;
      $y = 1;
      foreach( $data['nmBrg'] as $brg) {
        if ( $data['qtyMinta'][$i] == NULL || $data['qtyMinta'] == '' && $y == count($data['nmBrg'])) {
          return true;
        } elseif ( $data['qtyMinta'][$i] == NULL || $data['qtyMinta'] == '' ) {
          $i++;
          $y++;
          continue;
        } else {
          $query = "INSERT INTO barang_keluar (NOMOR_SLIP, KODE_BRG, SHIFT, POSTING, KODEF, TANGGAL_OUT, KETERANGAN, NAMA_USER, NO_REF, QUANTITY_MINTA) VALUES (CONCAT((SELECT klr FROM counter) + 1, '-K/', DATE_FORMAT(NOW(), '%y')), :kdBrg" .$i. ", :shift, :posting, :kodef, :tanggalKeluar, :keterangan" .$i. ", :nama, :noRef, :qtyMinta" .$i. ")";

          $this->db->query($query);
          $this->db->bind('kdBrg' .$i, $data['kdBrg'][$i]);
          $this->db->bind('shift', $data['shift']);
          $this->db->bind('posting', $data['posting']);
          $this->db->bind('kodef', $_SESSION['login']['KODEF']);
          $this->db->bind('tanggalKeluar', $data['tanggalKeluar']);
          $this->db->bind('keterangan' .$i, $data['keterangan'][$i]);
          $this->db->bind('nama', $data['nama']);
          $this->db->bind('noRef', $data['noRef']);
          $this->db->bind('qtyMinta' .$i, $data['qtyMinta'][$i]);

          $this->db->execute();
          if ( $y == count($data['nmBrg'])) {
            return true;
          } else {
            $i++;
            $y++;
            continue;
          }
        }
     }
    }

    public function hapusDataKlr($data) {
      $query = "UPDATE barang_keluar_tmp SET status = 1 WHERE NOMOR_SLIP = :id";
      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      $this->db->execute();
      return $this->db->rowCount();
    }

    public function hapusDtl($data) {
      $query = "DELETE FROM barang_keluar WHERE NOMOR_SLIP = :id AND KODE_BRG = :kd";
      $this->db->query($query);
      $this->db->bind('id', $data['id']);
      $this->db->bind('kd', $data['kd']);
      $this->db->execute();

      return $this->db->rowCount();
    }

    public function ubahKlr($data) {
      var_dump($data);
      $query = "UPDATE barang_keluar_tmp SET
                TANGGAL_OUT = :tglKlr WHERE NOMOR_SLIP = :inputNoKlr";

      $this->db->query($query);
      $this->db->bind('tglKlr', $data['tglKlr']);
      $this->db->bind('inputNoKlr', $data['inputNoKlr']);
      $this->db->execute();

      return $this->db->rowCount();
    }

    public function ubahBrgKlr($data) {

      $i = 0;
      $y = 1;
      foreach ($data['brg'] as $brg) {
        $query = "UPDATE barang_keluar SET
                    QUANTITY_MINTA = :qty" .$i. "
                    WHERE NOMOR_SLIP = :noslip AND KODE_BRG = :brg" .$i. "";

        $this->db->query($query);
        $this->db->bind('qty' .$i, $data['qty'][$i]);
        $this->db->bind('brg' .$i, $data['brg'][$i]);
        $this->db->bind('noslip', $data['noslip']);

        $this->db->execute();
        if ( $y == count($data['brg']) ) {
          return true;
        } else {
          $i++;
          $y++;
          continue;
        }

      }

    }


  }


 ?>
