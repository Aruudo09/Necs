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

      public function getOptionBrg() {
        $this->db->query('SELECT * FROM barang');
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
        $this->db->query('SELECT a.NO_BCRA, a.PENERIMA, a.TGL_BCRA, a.NO_PO, c.NAMA_SP, a.KODE_BRG, b.NAMA_BRG, b.Stock_brg, a.QTY_TERIMA, b.Satuan, a.NO_SRJLN FROM berita_acara a JOIN barang b ON a.KODE_BRG = b.KODE_BRG JOIN supplier c ON b.KODE_SP = c.KODE_SP');

        return $this->db->resultSet();
      }

      public function getDataByPenerima($PENERIMA) {
        $this->db->query('SELECT a.NO_BCRA, a.PENERIMA, a.TGL_BCRA, a.NO_PO, c.NAMA_SP, b.NAMA_BRG, b.Stock_brg, a.QTY_TERIMA, b.Satuan, a.NO_SRJLN FROM berita_acara a JOIN barang b ON a.KODE_BRG = b.KODE_BRG JOIN supplier c ON b.KODE_SP = c.KODE_SP WHERE a.PENERIMA = :PENERIMA');
        $this->db->bind('PENERIMA', $PENERIMA);
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
        $query = "SELECT NO_PO, PEMESAN, TGL_PO, QTY_ORDER, QTY_TERIMA, HARGA_PO, TOT_HARGA FROM purchased_order WHERE NO_PO = :nopo AND KODE_BRG = :opsiBrg AND QTY_ORDER > QTY_TERIMA";

        $this->db->query($query);
        $this->db->bind('nopo', $data['nopo']);
        $this->db->bind('opsiBrg', $data['opsiBrg']);

        $ord = $this->db->single();
        var_dump($ord['QTY_ORDER']);
        if ( $ord['QTY_ORDER'] >= $data['qtyTerima']) {
            return true;
        } else {
          return false;
        }

      }

      public function tambahBrgMskTmp($data) {
        $query = "INSERT INTO berita_acara_tmp
                    VALUES
                    (:inputNoMsk, :poBa, :noSRJLN, :opsiSpl, :tanggalTerima, :penerima)";
        $this->db->query($query);
        $this->db->bind('inputNoMsk', $data['inputNoMsk']);
        $this->db->bind('noSRJLN', $data['noSRJLN']);
        $this->db->bind('tanggalTerima', $data['tanggalTerima']);
        $this->db->bind('poBa', $data['poBa']);
        $this->db->bind('opsiSpl', $data['opsiSpl']);
        $this->db->bind('penerima', $data['penerima']);

        $this->db->execute();
        return $this->db->rowCount();
      }


      public function tambahBrgMsk($data) {
        $query = "INSERT INTO berita_acara
                    VALUES
                    (:NoBcra, :penerimadt, :tanggalbcra, :nopo, :nomorsp, :opsiBrg, :qtyTerima, :srjln)";

        $this->db->query($query);
        $this->db->bind('NoBcra', $data['NoBcra']);
        $this->db->bind('tanggalbcra', $data['tanggalbcra']);
        $this->db->bind('nomorsp', $data['nomorsp']);
        $this->db->bind('penerimadt', $data['penerimadt']);
        $this->db->bind('nopo', $data['nopo']);
        $this->db->bind('opsiBrg', $data['opsiBrg']);
        $this->db->bind('srjln', $data['srjln']);
        $this->db->bind('qtyTerima', $data['qtyTerima']);

        $this->db->execute();
        return $this->db->rowCount();

      }

      public function hpsBcra($No_msk) {
        $query = "DELETE FROM berita_acara_tmp WHERE NO_BCRA LIKE :No_msk";
        $this->db->query($query);
        $this->db->bind('No_msk', "%$No_msk%");

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
        $query2 = "UPDATE purchased_order SET
                    QTY_TERIMA = QTY_TERIMA + :qtyTerima
                    WHERE NO_PO = :nopo AND KODE_BRG = :opsiBrg AND QTY_ORDER > QTY_TERIMA";
        $this->db->query($query2);
        $this->db->bind('nopo', $data['nopo']);
        $this->db->bind('qtyTerima', $data['qtyTerima']);
        $this->db->bind('opsiBrg', $data['opsiBrg']);

        $this->db->execute();
      }

      public function ubahBrgMskTmp($data) {
        $query = "UPDATE berita_acara_tmp SET
                    TGL_BCRA = :tanggalTerima,
                    NO_PO = :noPo,
                    PENERIMA = :penerima,
                    KODE_SP = :opsiSpl,
                    NO_SRJLN = :noSRJLN
                    WHERE NO_BCRA = :No_msk";

        $this->db->query($query);
        $this->db->bind('tanggalTerima', $data['tanggalTerima']);
        $this->db->bind('noPo', $data['noPo']);
        $this->db->bind('penerima', $data['penerima']);
        $this->db->bind('opsiSpl', $data['opsiSpl']);
        $this->db->bind('noSRJLN', $data['noSRJLN']);
        $this->db->bind('No_msk', $data['No_msk']);

        $this->db->execute();

        return $this->db->rowCount();
      }

      public function cariData() {
      $keyword = $_POST['keyword'];
      $query = "SELECT a.NO_BCRA, a.PENERIMA, a.TGL_BCRA, a.NO_PO, c.NAMA_SP, b.NAMA_BRG, b.Stock_brg, a.QTY_TERIMA, b.Satuan, a.NO_SRJLN FROM berita_acara a JOIN barang b ON a.KODE_BRG = b.KODE_BRG JOIN supplier c ON b.KODE_SP = c.KODE_SP WHERE penerima LIKE :keyword";
      $this->db->query($query);
      $this->db->bind('keyword', "%$keyword%");
      return $this->db->resultSet();
}

    }

 ?>
