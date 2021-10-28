<?php
class Purchased_order_model {


  private $tablePo = 'purchased_order';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function counter_po() {
    $this->db->query('SELECT po  FROM counter');
    $counter = $this->db->resultSet();
    return $counter;
  }

  public function updateCounter() {
    $query2 = "UPDATE counter SET po = po+1";
    $this->db->query($query2);
    $this->db->execute();
  }

  public function getAllDataPo() {
    $this->db->query('SELECT a.NO_PO, a.PEMESAN, a.TGL_PO, c.NAMA_SP, b.NAMA_BRG, b.Jenis_brg, b.Stock_brg, a.QTY_ORDER, a.QTY_TERIMA, b.Satuan, a.HARGA_PO, a.TOT_HARGA FROM purchased_order a LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP WHERE QTY_ORDER > QTY_TERIMA');

    return $this->db->resultSet();
  }

  public function getAllDataTmp() {
    $this->db->query('SELECT NO_PO, TGL_PO, PEMESAN, purchased_order_tmp.KODE_SP, supplier.NAMA_SP FROM purchased_order_tmp, supplier WHERE purchased_order_tmp.KODE_SP = supplier.KODE_SP ORDER BY TGL_PO DESC Limit 1');

    return $this->db->resultSet();
  }

  public function getDataSpl() {
    $query = "SELECT * FROM supplier";
    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getDataBrg() {
    $query = "SELECT * FROM barang ";
    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getDataPoDtl($No_po) {
      $this->db->query('SELECT * FROM purchased_order WHERE NO_PO = :No_po');
      $this->db->bind('No_po', $No_po);
      return $this->db->resultSet();
  }

  public function getDataPoTmp($No_po) {
      $this->db->query('SELECT * FROM purchased_order_tmp WHERE NO_PO=:No_po');
      $this->db->bind('No_po', $No_po);
      return $this->db->single();
  }

  public function tambahData($data) {
    $query = "INSERT INTO purchased_order_tmp
                VALUES
                (:noPo, :tanggal_po, :pemesan, :sp, NULL)";
    // var_dump($query);
    // echo $query;
    $this->db->query($query);
    $this->db->bind('noPo', $data['noPo']);
    $this->db->bind('tanggal_po', $data['tanggal_po']);
    $this->db->bind('pemesan', $data['pemesan']);
    $this->db->bind('sp', $data['sp']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function tambahDataPo($data) {
    $query = "INSERT INTO purchased_order
                VALUES
                (:detailNoPo, :detailPemesan, :detailTglPo, :detailSp, :brg, :qty, :harga, NULL, '')";
    // var_dump($query);
    // echo $query;
    $this->db->query($query);
    $this->db->bind('detailNoPo', $data['detailNoPo']);
    $this->db->bind('detailPemesan', $data['detailPemesan']);
    $this->db->bind('detailTglPo', $data['detailTglPo']);
    $this->db->bind('detailSp', $data['detailSp']);
    $this->db->bind('brg', $data['brg']);
    $this->db->bind('qty', $data['qty']);
    $this->db->bind('harga', $data['harga']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function hapusData($No_po) {
    $query = "DELETE FROM purchased_order_tmp WHERE NO_PO LIKE :No_po";
    $this->db->query($query);
    $this->db->bind('No_po', "%$No_po%");
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function hapusDataPo($No_po) {
    $query = "DELETE FROM purchased_order WHERE NO_PO LIKE :No_po";
    $this->db->query($query);
    $this->db->bind('No_po', "%$No_po%");
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function ubahData($data) {
    $query = "UPDATE purchased_order_tmp SET
                TGL_PO = :tanggal_po,
                PEMESAN = :pemesan,
                KODE_SP = :sp
              WHERE NO_PO = :No_po";

    $this->db->query($query);
    $this->db->bind('tanggal_po', $data['tanggal_po']);
    $this->db->bind('pemesan', $data['pemesan']);
    $this->db->bind('sp', $data['sp']);
    $this->db->bind('No_po', $data['No_po']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function ubahDataPo($data) {
    $query = "UPDATE purchased_order SET
                PEMESAN = :pemesan,
                TGL_PO = :tanggal_po,
                KODE_SP = :sp,
                KODE_BRG = :brg,
                QTY_ORDER = :qty,
                HARGA_PO = :harga
              WHERE NO_PO = :No_po";
    // var_dump($query);
    // echo $query;
    $this->db->query($query);
    $this->db->bind('tanggal_po', $data['tanggal_po']);
    $this->db->bind('sp', $data['sp']);
    $this->db->bind('pemesan', $data['pemesan']);
    $this->db->bind('brg', $data['brg']);
    $this->db->bind('qty', $data['qty']);
    $this->db->bind('harga', $data['harga']);
    $this->db->bind('No_po', $data['No_po']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function cariDataPo() {
    $keyword = $_POST['keyword'];
    $query = "SELECT a.NO_PO, a.PEMESAN, a.TGL_PO, c.NAMA_SP, b.NAMA_BRG, b.Jenis_brg, b.Stock_brg, a.QTY_ORDER, b.Satuan, a.HARGA_PO, a.TOT_HARGA
    FROM purchased_order a
    LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
    LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP
    WHERE NO_PO LIKE :keyword";
    $this->db->query($query);
    $this->db->bind('keyword', "%$keyword%");
    return $this->db->resultSet();
  }

}
 ?>
