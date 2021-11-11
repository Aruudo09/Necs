<?php

    class Barang_masuk_model {

      private $tableBrgMsk = 'berita_acara' ;
      private $db;

      public function __construct() {
        $this->db = new Database;
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
        $this->db->query('SELECT NO_BCRA, NO_PO, NO_SRJLN, berita_acara_tmp.KODE_SP, supplier.NAMA_SP, TGL_BCRA, PENERIMA FROM berita_acara_tmp, supplier WHERE berita_acara_tmp.KODE_SP = supplier.KODE_SP ORDER BY NO_BCRA DESC LIMIT 1');

        return $this->db->resultSet();
      }

      public function getAllBarangMsk() {
        $this->db->query('SELECT a.NO_BCRA, a.PENERIMA, a.TGL_BCRA, a.NO_PO, c.NAMA_SP, a.KODE_BRG, b.NAMA_BRG, b.Stock_brg, a.QTY_TERIMA, b.Satuan, a.NO_SRJLN FROM berita_acara a JOIN barang b ON a.KODE_BRG = b.KODE_BRG JOIN supplier c ON b.KODE_SP = c.KODE_SP ORDER BY a.NO_PO DESC');

        return $this->db->resultSet();
      }

      public function getAllPoBcra() {
        $this->db->query('SELECT a.NO_PO, a.TGL_PO, c.KODE_SP, c.NAMA_SP, b.KODE_BRG, b.NAMA_BRG, b.Jenis_brg, b.Stock_brg, a.QTY_ORDER, a.QTY_TERIMA, b.Satuan, a.HARGA_PO, a.TOT_HARGA
        FROM purchased_order a
        LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
        LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP
        WHERE a.QTY_ORDER > a.QTY_TERIMA
        ORDER BY a.NO_PO DESC');

        return $this->db->resultSet();
      }

      public function getDataByBcra($NO_BCRA, $bcra) {
        $this->db->query('SELECT a.NO_BCRA, a.PENERIMA, a.TGL_BCRA, a.NO_PO, c.NAMA_SP, b.NAMA_BRG, b.Stock_brg, a.QTY_TERIMA, b.Satuan, a.NO_SRJLN FROM berita_acara a JOIN barang b ON a.KODE_BRG = b.KODE_BRG JOIN supplier c ON b.KODE_SP = c.KODE_SP WHERE a.NO_BCRA = :NO_BCRA"/":bcra');
        $this->db->bind('NO_BCRA', $NO_BCRA);
        $this->db->bind('bcra', $bcra);
        var_dump($NO_BCRA);
        var_dump($bcra);
        // var_dump($this->db->resultSet());
        return $this->db->resultSet();
      }

      public function getBrgMskTmp($NO_PO) {
        $query = "SELECT a.NO_BCRA, a.NO_PO, a.NO_SRJLN, a.KODE_SP, d.NAMA_SP, a.TGL_BCRA, a.PENERIMA, c.KODE_BRG, e.NAMA_BRG FROM berita_acara_tmp a RIGHT JOIN purchased_order_tmp b ON a.NO_PO = b.NO_PO RIGHT JOIN purchased_order c ON b.NO_PO = c.NO_PO LEFT JOIN supplier d ON c.KODE_SP = d.KODE_SP LEFT JOIN barang e ON c.KODE_BRG = e.KODE_BRG WHERE c.NO_PO = :NO_PO AND c.QTY_ORDER > c.QTY_TERIMA";
        $this->db->query($query);
        $this->db->bind('NO_PO', $NO_PO);
        return $this->db->resultSet();
      }

      public function getBrgMskUbah($No_msk) {
        $query = "SELECT a.NO_BCRA, a.NO_PO, a.NO_SRJLN, a.KODE_SP, d.NAMA_SP, a.TGL_BCRA, a.PENERIMA, c.KODE_BRG, e.NAMA_BRG FROM berita_acara_tmp a RIGHT JOIN purchased_order_tmp b ON a.NO_PO = b.NO_PO RIGHT JOIN purchased_order c ON b.NO_PO = c.NO_PO LEFT JOIN supplier d ON c.KODE_SP = d.KODE_SP LEFT JOIN barang e ON c.KODE_BRG = e.KODE_BRG WHERE a.NO_BCRA = :No_msk";
        $this->db->query($query);
        $this->db->bind('No_msk', $No_msk);
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
        $query = "INSERT INTO berita_acara_tmp (NO_BCRA, NO_PO, NO_SRJLN, KODE_SP, TGL_BCRA, PENERIMA)
                  SELECT :inputNoMsk, :poBa, :noSRJLN, KODE_SP, :tanggalTerima, :penerima FROM purchased_order_tmp WHERE NO_PO = :poBa";
        $this->db->query($query);
        $this->db->bind('inputNoMsk', $data['inputNoMsk']);
        $this->db->bind('noSRJLN', $data['noSRJLN']);
        $this->db->bind('tanggalTerima', $data['tanggalTerima']);
        $this->db->bind('poBa', $data['poBa']);
        $this->db->bind('penerima', $data['penerima']);

        $this->db->execute();
        return $this->db->rowCount();
      }


      public function tambahBrgMsk($data) {
        $i = 0;
        foreach( $data['optBrg'] as $optBrg) {
        $query = "INSERT INTO berita_acara (NO_BCRA, PENERIMA, TGL_BCRA, NO_PO, KODE_SP, KODE_BRG, HARGA_BL, QTY_TERIMA, NO_SRJLN)
                  SELECT :inputNoMsk, :penerima, :tanggalTerima, :poBa, KODE_SP, :kdBrg" .$i. ", :hrgBl" .$i. ", :qty" .$i. ", :noSRJLN FROM purchased_order_tmp WHERE NO_PO = :poBa";

        $this->db->query($query);
        $this->db->bind('inputNoMsk', $data['inputNoMsk']);
        $this->db->bind('tanggalTerima', $data['tanggalTerima']);
        $this->db->bind('penerima', $data['penerima']);
        $this->db->bind('poBa', $data['poBa']);
        $this->db->bind('kdBrg' .$i , $data['kdBrg'][$i]);
        $this->db->bind('noSRJLN', $data['noSRJLN']);
        $this->db->bind('qty' .$i , $data['qty'][$i]);
        $this->db->bind('hrgBl' .$i , $data['hrgBl'][$i]);

        $this->db->execute();
        $i++;
      }

      }

      public function hpsBcra($No_msk) {
        $query = "DELETE FROM berita_acara_tmp WHERE NO_BCRA LIKE :No_msk";
        $this->db->query($query);
        $this->db->bind('No_msk', $No_msk);

        $this->db->execute();
        return $this->db->rowCount();
      }

      public function hpsDtlBcra($No_msk) {
        $query = "DELETE FROM berita_acara WHERE NO_BCRA LIKE :No_msk";
        $this->db->query($query);
        $this->db->bind('No_msk', "%$No_msk%");

        $this->db->execute();
        return $this->db->rowCount();
      }

      public function ubahBrgMskDtl($data) {
        $query = "UPDATE berita_acara SET
                    QTY_TERIMA = :qtyTerima
                    WHERE NO_BCRA = :NoBcra AND KODE_BRG = :brg";

        $this->db->query($query);
        $this->db->bind('brg', $data['brg']);
        $this->db->bind('qtyTerima', $data['qtyTerima']);
        $this->db->bind('NoBcra', $data['NoBcra']);

        $this->db->execute();

        return $this->db->rowCount();
      }

      public function updateorder($data) {
        $i = 0;
        foreach( $data['optBrg'] as $optBrg) {
        $query2 = "UPDATE purchased_order SET
                    QTY_TERIMA = QTY_TERIMA + :qty" .$i. "
                    WHERE NO_PO = :poBa AND KODE_BRG = :kdBrg" .$i. " AND QTY_ORDER > QTY_TERIMA";
        $this->db->query($query2);
        $this->db->bind('poBa', $data['poBa']);
        $this->db->bind('qty' .$i , $data['qty'][$i]);
        $this->db->bind('kdBrg' .$i , $data['kdBrg'][$i]);

        $this->db->execute();
        $i++;
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
                    PENERIMA = :penerima2,
                    NO_SRJLN = :noSRJLN2
                    WHERE NO_BCRA = :inputNoMsk2";

        $this->db->query($query);
        $this->db->bind('tanggalTerima2', $data['tanggalTerima2']);
        $this->db->bind('penerima2', $data['penerima2']);
        $this->db->bind('noSRJLN2', $data['noSRJLN2']);
        $this->db->bind('inputNoMsk2', $data['inputNoMsk2']);

        $this->db->execute();

        return $this->db->rowCount();
      }

      public function cariData($keyword) {
      $query = "SELECT a.NO_BCRA, a.NO_PO, a.NO_SRJLN, a.NO_SRJLN, b.NAMA_SP, a.KODE_SP, a.TGL_BCRA, a.PENERIMA
                FROM berita_acara_tmp a
                JOIN supplier b ON a.KODE_SP = b.KODE_SP
                WHERE NO_PO LIKE :keyword OR NO_BCRA LIKE :keyword
                ORDER BY NO_BCRA DESC LIMIT 1;
                ";
      $this->db->query($query);
      $this->db->bind('keyword', "%$keyword%");

      return $this->db->single();
      }

    }

 ?>
