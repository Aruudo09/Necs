<?php

    class Barang_masuk_model {

      private $tableBrgMsk = 'berita_acara' ;
      private $db;

      public function __construct() {
        $this->db = new Database;
        $this->dbh = new Database;
      }

      public function counter_po() {
        $this->db->query('SELECT ba  FROM counter');
        $counter = $this->db->resultSet();
        return $counter;
      }

      public function updateCounter() {
        $this->db->query('UPDATE counter SET ba = ba + 1');
        $this->db->execute();
      }

      public function getOptionBrg($opt) {
        $this->db->query('SELECT a.KODE_BRG, b.NAMA_BRG, a.HARGA_PO, b.NAMA_BRG
                          FROM purchased_order a
                          LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
                          WHERE NO_PO = :opt AND QTY_ORDER > QTY_TERIMA;');
        $this->db->bind('opt', $opt);
        return $this->db->resultSet();
      }

      public function getOptionSpl() {
        $this->db->query('SELECT * FROM supplier');
        return $this->db->resultSet();
      }


      public function getDataBcraTmp() {
        $this->db->query('SELECT NO_BCRA, NO_PO, NO_SRJLN, a.KODE_SP, b.NAMA_SP, TGL_BCRA, PENERIMA
                          FROM berita_acara_tmp a
                          INNER JOIN supplier b ON a.KODE_SP = b.KODE_SP
                          ORDER BY TGL_BCRA DESC LIMIT 1;');

        return $this->db->resultSet();
      }

      public function getAllBarangMsk($page) {
        $key = $_SESSION['cari'];
        $this->dbh->query('SELECT * FROM berita_acara_tmp WHERE NO_BCRA LIKE :key');
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

        $query = "SELECT a.NO_BCRA, a.PENERIMA, a.TGL_BCRA, a.NO_PO, c.NAMA_SP, a.KODE_BRG, b.NAMA_BRG, b.Stock_brg, a.QTY_TERIMA, b.Satuan, a.NO_SRJLN FROM berita_acara a JOIN barang b ON a.KODE_BRG = b.KODE_BRG JOIN supplier c ON b.KODE_SP = c.KODE_SP WHERE a.NO_BCRA LIKE :key ORDER BY a.TGL_BCRA DESC LIMIT $dataAwal, $banyakDataPerHal";

        $this->db->query($query);
        $this->db->bind('key', "%$key%");

        $dt = array(
          "data" => $this->db->resultSet(),
          "halamanAktif" => $halamanAktif,
          "banyakHal" => $banyakHal
        );

        return $dt;
      }

      public function getAllPoBcra($page) {

        $key = $_SESSION['cari'];
        $query2 = "SELECT a.NO_PO, a.TGL_PO, a.PEMESAN, a.KODEF, c.NMDEF, a.KODE_SP, d.NAMA_SP
                    FROM purchased_order_tmp a
                    LEFT JOIN purchased_order b ON a.NO_PO = b.NO_PO
                    LEFT JOIN tarif c ON a.KODEF = c.KODEF
                    LEFT JOIN supplier d ON a.KODE_SP = d.KODE_SP
                    WHERE a.NO_PO LIKE :key AND b.QTY_ORDER > b.QTY_TERIMA AND b.status != '1'";
        $this->dbh->query($query2);
        $this->dbh->bind('key', "%$key%");

        $banyakData = $this->dbh->rowCount();
        $banyakDataPerHal = 5;
        $banyakHal = ceil($banyakData/$banyakDataPerHal);

        if ( $page >= 1 ) {
          $halamanAktif = $page;
        } else {
          $halamanAktif = 1;
        }

        $dataAwal = ($halamanAktif*$banyakDataPerHal) - $banyakDataPerHal;

        $query = "SELECT a.NO_PO, a.TGL_PO, a.PEMESAN, a.KODEF, c.NMDEF, a.KODE_SP, d.NAMA_SP
                    FROM purchased_order_tmp a
                    LEFT JOIN purchased_order b ON a.NO_PO = b.NO_PO
                    LEFT JOIN tarif c ON a.KODEF = c.KODEF
                    LEFT JOIN supplier d ON a.KODE_SP = d.KODE_SP
                    WHERE a.NO_PO LIKE :key AND b.QTY_ORDER > b.QTY_TERIMA AND b.status != '1' ORDER BY a.NO_PO ASC";
        $this->db->query($query);
        $this->db->bind('key', "%$key%");

        $dt = array(
          "data" => $this->db->resultSet(),
          "banyakHal" => $banyakHal,
          "halamanAktif" => $halamanAktif
        );

        return $dt;
      }

      public function getAllDataPo() {
        $this->db->query('SELECT a.NO_PO FROM purchased_order_tmp a
        INNER JOIN purchased_order b ON a.NO_PO = b.NO_PO
        WHERE B.QTY_ORDER > b.QTY_TERIMA');
        return $this->db->resultSet();
      }

      public function getDataByBcra($NO_BCRA, $bcra) {
        $this->db->query('SELECT a.NO_BCRA, a.PENERIMA, a.TGL_BCRA, a.NO_PO, c.NAMA_SP, b.NAMA_BRG, b.Stock_brg, a.QTY_TERIMA, b.Satuan, a.NO_SRJLN FROM berita_acara a JOIN barang b ON a.KODE_BRG = b.KODE_BRG JOIN supplier c ON b.KODE_SP = c.KODE_SP WHERE a.NO_BCRA = :NO_BCRA"/":bcra');
        $this->db->bind('NO_BCRA', $NO_BCRA);
        $this->db->bind('bcra', $bcra);
        // var_dump($this->db->resultSet());
        return $this->db->resultSet();
      }

      public function getBrgMsk($data) {
        $query = "SELECT a.NO_BCRA, a.PENERIMA, a.NO_PO, a.NO_SRJLN, a.KODEF, b.NMDEF, a.TGL_BCRA, a.KODE_SP, c.NAMA_SP, a.KODE_BRG, d.NAMA_BRG, d.satuan, a.HARGA_BL, a.QTY_TERIMA
        FROM berita_acara a
        LEFT JOIN tarif b ON a.KODEF = b.KODEF
        LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP
        LEFT JOIN barang d ON a.KODE_BRG = d.KODE_BRG
        WHERE NO_BCRA = :id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        return $this->db->resultSet();
      }

      public function getBrgMskUbah($data) {
        $query = "SELECT a.NO_BCRA, a.NO_PO, a.NO_SRJLN, a.KODE_SP, d.NAMA_SP, a.TGL_BCRA, a.PENERIMA, c.KODE_BRG, e.NAMA_BRG FROM berita_acara_tmp a RIGHT JOIN purchased_order_tmp b ON a.NO_PO = b.NO_PO RIGHT JOIN purchased_order c ON b.NO_PO = c.NO_PO LEFT JOIN supplier d ON c.KODE_SP = d.KODE_SP LEFT JOIN barang e ON c.KODE_BRG = e.KODE_BRG WHERE a.NO_BCRA = :id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        return $this->db->single();
      }

      public function getBrgMskInput($NO_PO) {
        $query = "SELECT * FROM purchased_order WHERE NO_PO=:NO_PO";
        $this->db->query($query);
        $this->db->bind('NO_PO', $NO_PO);
        return $this->db->single();
      }

      public function cekOrder($data) {
        $i = 0;
        $y = 1;
        foreach($data['optBrg'] as $optBrg) {
        $query = "SELECT NO_PO, PEMESAN, TGL_PO, KODE_BRG, QTY_ORDER, QTY_TERIMA, HARGA_PO, TOT_HARGA FROM purchased_order WHERE NO_PO = :poBa AND KODE_BRG = :kdBrg" .$i. " AND QTY_ORDER > QTY_TERIMA";

        $this->db->query($query);
        $this->db->bind('poBa', $data['poBa']);
        $this->db->bind('kdBrg' .$i , $data['kdBrg'][$i]);

        $ord = $this->db->resultSet();
        $selisih = $ord[0]['QTY_ORDER'] - $ord[0]['QTY_TERIMA'];
        if ( $selisih >= $data['qty'][$i]) {
          if ( $y == count($data['optBrg'])) {
            return true;
          } else {
            $i++;
            $y++;
            continue;
          }
        }
        else {
          return false;
        }
      }
      }

      public function updateStats($data) {
        $query = "UPDATE purchased_order SET status = 0
                  WHERE NO_PO = :poBa AND QTY_ORDER > QTY_TERIMA";

        $this->db->query($query);
        $this->db->bind('poBa', $data['poBa']);

        $this->db->execute();
      }

      public function tambahBrgMskTmp($data) {
        $query = "INSERT INTO berita_acara_tmp (NO_BCRA, NO_PO, NO_SRJLN, KODE_SP, KODEF, TGL_BCRA, PENERIMA)
                  SELECT :inputNoMsk, :poBa, :noSRJLN, KODE_SP, :kodef, :tanggalTerima, :penerima FROM purchased_order_tmp WHERE NO_PO = :poBa";
        $this->db->query($query);
        $this->db->bind('inputNoMsk', $data['inputNoMsk']);
        $this->db->bind('noSRJLN', $data['noSRJLN']);
        $this->db->bind('kodef', $_SESSION['login']['KODEF']);
        $this->db->bind('tanggalTerima', $data['tanggalTerima']);
        $this->db->bind('poBa', $data['poBa']);
        $this->db->bind('penerima', $data['penerima']);

        $this->db->execute();
        return $this->db->rowCount();
      }


      public function tambahBrgMsk($data) {
        $i = 0;
        $y = 1;
        foreach( $data['optBrg'] as $optBrg) {

        if ( $data['qty'][$i] == NULL || $data['qty'][$i] == '' && $y == count($data['optBrg']) ) {
          return true;
        } elseif ( $data['qty'][$i] == NULL || $data['qty'][$i] == '' ) {
          $i++;
          $y++;
          continue;
        } else {
          $query = "INSERT INTO berita_acara (NO_BCRA, PENERIMA, TGL_BCRA, NO_PO, KODEF, KODE_SP, KODE_BRG, HARGA_BL, QTY_TERIMA, NO_SRJLN)
                    SELECT :inputNoMsk, :penerima, :tanggalTerima, :poBa, :kodef, KODE_SP, :kdBrg" .$i. ", :hrgBl" .$i. ", :qty" .$i. ", :noSRJLN FROM purchased_order_tmp WHERE NO_PO = :poBa";

          $this->db->query($query);
          $this->db->bind('inputNoMsk', $data['inputNoMsk']);
          $this->db->bind('tanggalTerima', $data['tanggalTerima']);
          $this->db->bind('penerima', $data['penerima']);
          $this->db->bind('poBa', $data['poBa']);
          $this->db->bind('kodef', $_SESSION['login']['KODEF']);
          $this->db->bind('kdBrg' .$i , $data['kdBrg'][$i]);
          $this->db->bind('noSRJLN', $data['noSRJLN']);
          $this->db->bind('qty' .$i , $data['qty'][$i]);
          $this->db->bind('hrgBl' .$i , $data['hrgBl'][$i]);

          $this->db->execute();

          if ( $y == count($data['optBrg']) ) {
            return true;
          } else {
            $i++;
            $y++;
            continue;
            }
          }
        }
      }

      public function hpsBcra($data) {
        $query = "UPDATE berita_acara_tmp SET status = '1' WHERE NO_BCRA = :id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
      }

      public function ubahStat($data) {
        $query = "UPDATE berita_acara SET status = '1' WHERE NO_BCRA = :id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);

        $this->db->execute();
        return $this->db->rowCount();
      }

      public function hpsDtlBcra($data) {
        $query = "DELETE FROM berita_acara WHERE NO_BCRA LIKE :id AND KODE_BRG = :kd";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('kd', $data['kd']);

        $this->db->execute();
        if ($this->db->rowCount() > 0 ) {
          return true;
        } else {
          return false;
        }
      }

      public function ubahBrgMskDtl($data) {
        $i = 0;
        $y = 1;
        foreach ( $data['qty'] as $dt ) {
          $query = "UPDATE berita_acara SET
                      QTY_TERIMA = :qty" .$i. "
                      WHERE NO_BCRA = :no_msk AND KODE_BRG = :brg" .$i. "";

          $this->db->query($query);
          $this->db->bind('brg' .$i, $data['brg'][$i]);
          $this->db->bind('qty' .$i, $data['qty'][$i]);
          $this->db->bind('no_msk', $data['no_msk']);

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

      public function updateorder($data) {
        $i = 0;
        $y = 1;
        foreach( $data['optBrg'] as $optBrg) {

            $query2 = "UPDATE purchased_order SET QTY_TERIMA = QTY_TERIMA + :qty" .$i. " WHERE NO_PO = :poBa AND KODE_BRG = :kdBrg" .$i. "";

            $this->db->query($query2);
            $this->db->bind('poBa', $data['poBa']);
            $this->db->bind('qty' .$i , $data['qty'][$i]);
            $this->db->bind('kdBrg' .$i , $data['kdBrg'][$i]);


            $this->db->execute();
            if ( $y == count($data['optBrg']) ) {
              return true;
            } else {
              $i++;
              $y++;
              continue;
            }

        }
      }

      public function setStats($data) {
        $query = "UPDATE purchased_order SET status = 1
                  WHERE NO_PO = :nopo AND KODE_BRG = :brg AND QTY_ORDER > QTY_TERIMA AND status = 0";

                  $this->db->query($query);
                  $this->db->bind('nopo', $data['nopo']);
                  $this->db->bind('brg', $data['brg']);

                  $this->db->execute();
      }

      public function ubahBrgMskTmp($data) {
        $query = "UPDATE berita_acara_tmp SET
                    TGL_BCRA = :tanggalTerima2,
                    NO_SRJLN = :noSRJLN2
                    WHERE NO_BCRA = :nobcra";

        $this->db->query($query);
        $this->db->bind('tanggalTerima2', $data['tanggalTerima2']);
        $this->db->bind('noSRJLN2', $data['noSRJLN2']);
        $this->db->bind('nobcra', $data['nobcra']);

        $this->db->execute();

        return $this->db->rowCount();
      }

    }

 ?>
