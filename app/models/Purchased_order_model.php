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
    $this->db->query('SELECT a.NO_PO, a.PEMESAN, a.TGL_PO, c.NAMA_SP, a.KODE_BRG, b.NAMA_BRG, b.Jenis_brg, b.Stock_brg, a.QTY_ORDER, a.QTY_TERIMA, b.Satuan, a.HARGA_PO, a.TOT_HARGA FROM purchased_order a LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP WHERE QTY_ORDER > QTY_TERIMA AND status != "1" ORDER BY a.NO_PO DESC');

    return $this->db->resultSet();
  }

  public function getAlldataPoCtkTmp($No_po, $No_po1, $No_po2, $No_po3) {
    $this->db->query('SELECT a.NO_PO, a.PEMESAN, a.TGL_PO, a.KODE_SP, b.NAMA_SP, a.QTY_ORDER, a.QTY_TERIMA, a.HARGA_PO, a.TOT_HARGA FROM purchased_order a LEFT JOIN supplier b ON a.KODE_SP = b.KODE_SP WHERE NO_PO = :No_po"/":No_po1"/":No_po2"/":No_po3 LIMIT 1');

    $this->db->bind('No_po', $No_po);
    $this->db->bind('No_po1', $No_po1);
    $this->db->bind('No_po2', $No_po2);
    $this->db->bind('No_po3', $No_po3);
    // echo $No_po ."/". $No_po1. "/" .$No_po2. "/" .$No_po3;

    return $this->db->resultSet();
  }

  public function getAlldataPoCtkDtl($No_po, $No_po1, $No_po2, $No_po3) {
    $this->db->query('SELECT a.NO_PO, a.PEMESAN, a.TGL_PO, c.NAMA_SP, b.NAMA_BRG, b.Jenis_brg, b.Stock_brg, a.QTY_ORDER, a.QTY_TERIMA, b.Satuan, a.HARGA_PO, a.TOT_HARGA FROM purchased_order a LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP WHERE NO_PO = :No_po"/":No_po1"/":No_po2"/":No_po3');

    $this->db->bind('No_po', $No_po);
    $this->db->bind('No_po1', $No_po1);
    $this->db->bind('No_po2', $No_po2);
    $this->db->bind('No_po3', $No_po3);
    // echo $No_po ."/". $No_po1. "/" .$No_po2. "/" .$No_po3;

    return $this->db->resultSet();
  }

  public function getAllDataTmp() {
    $this->db->query('SELECT NO_PO, TGL_PO, PEMESAN, purchased_order_tmp.KODE_SP, supplier.NAMA_SP FROM purchased_order_tmp, supplier WHERE purchased_order_tmp.KODE_SP = supplier.KODE_SP AND status != "1" ORDER BY NO_PO DESC Limit 1');

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

  public function getDataPoDtl($data) {
      $this->db->query('SELECT NO_PO, a.KODE_BRG, b.NAMA_BRG, QTY_ORDER, HARGA_PO
                        FROM purchased_order a
                        INNER JOIN barang b ON a.KODE_BRG = b.KODE_BRG
                        WHERE a.NO_PO = :id AND a.KODE_BRG = :kd');
      $this->db->bind('id', $data['id']);
      $this->db->bind('kd', $data['kd']);
      return $this->db->single();
  }

  public function getDataPoTmp($No_po) {
      $this->db->query('SELECT * FROM purchased_order_tmp WHERE NO_PO=:No_po');
      $this->db->bind('No_po', $No_po);
      return $this->db->single();
  }

  public function tambahData($data) {
    $query = "INSERT INTO purchased_order_tmp
                VALUES
                (:noPo, :tanggal_po, :pemesan, :sp, DEFAULT, NULL)";
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
    $i = 0;
    $y = 1;
    foreach( $data['nmBrg'] as $brg) {
    $query = "INSERT INTO purchased_order (NO_PO, PEMESAN, TGL_PO, KODE_SP, KODE_BRG, QTY_ORDER, HARGA_PO, TOT_HARGA, QTY_TERIMA, status)
                VALUES
                (:noPo, :pemesan, :tanggal_po, :sp, :kdBrg" .$i. ", :qty" .$i. ", :harga" .$i. ", NULL, '', DEFAULT)";
    // var_dump($query);
    // echo $query;
    $this->db->query($query);
    $this->db->bind('noPo', $data['noPo']);
    $this->db->bind('pemesan', $data['pemesan']);
    $this->db->bind('tanggal_po', $data['tanggal_po']);
    $this->db->bind('sp', $data['sp']);
    $this->db->bind('kdBrg' .$i, $data['kdBrg'][$i]);
    $this->db->bind('qty' .$i, $data['qty'][$i]);
    $this->db->bind('harga' .$i, $data['harga'][$i]);
    $this->db->execute();

    if ( $y == count($data['nmBrg'])) {
      return true;
    } else {
      $i++;
      $y++;
      continue;
    }
    }
    // return $this->db->rowCount();
  }

  public function hapusData($data) {
    $query = "DELETE FROM purchased_order WHERE NO_PO = :id AND KODE_BRG = :kd";
    $this->db->query($query);
    $this->db->bind('id', $data['id']);
    $this->db->bind('kd', $data['kd']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function hapusPo($data) {
    $query = "UPDATE purchased_order_tmp SET status = '1' WHERE NO_PO = :id";
    $this->db->query($query);
    $this->db->bind('id', $data['id']);
    $this->db->execute();
  }

  public function ubahStat($data) {
    $query = "UPDATE purchased_order SET status = '1' WHERE NO_PO = :id";
    $this->db->query($query);
    $this->db->bind('id', $data['id']);
    $this->db->execute();
  }

  public function ubahData($data) {
    $query = "UPDATE purchased_order_tmp SET
                NO_PO = :noPo2,
                TGL_PO = :tanggal_po2,
                PEMESAN = :pemesan2,
                KODE_SP = :sp2
              WHERE NO_PO = :noPo2";

    $this->db->query($query);
    $this->db->bind('noPo2', $data['noPo2']);
    $this->db->bind('tanggal_po2', $data['tanggal_po2']);
    $this->db->bind('pemesan2', $data['pemesan2']);
    $this->db->bind('sp2', $data['sp2']);
    $this->db->bind('noPo2', $data['noPo2']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function ubahDataPo($data) {
    $query = "UPDATE purchased_order SET
                KODE_BRG = :brg,
                QTY_ORDER = :qty,
                HARGA_PO = :harga
              WHERE NO_PO = :detailNoPo AND KODE_BRG = :detailBarang";
    // var_dump($query);
    // echo $query;
    $this->db->query($query);
    $this->db->bind('brg', $data['brg']);
    $this->db->bind('qty', $data['qty']);
    $this->db->bind('harga', $data['harga']);
    $this->db->bind('detailNoPo', $data['detailNoPo']);
    $this->db->bind('detailBarang', $data['detailBarang']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function cariDataPo($keyword) {
    $query = "SELECT a.NO_PO, a.PEMESAN, a.TGL_PO, c.NAMA_SP, a.KODE_SP, b.NAMA_BRG, b.Jenis_brg, b.Stock_brg, a.QTY_ORDER, b.Satuan, a.HARGA_PO, a.TOT_HARGA
    FROM purchased_order a
    LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
    LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP
    WHERE NO_PO LIKE :keyword";
    $this->db->query($query);
    $this->db->bind('keyword', "%$keyword%");
    return $this->db->single();
  }

}
 ?>
