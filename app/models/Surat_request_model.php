<?php
class Surat_request_model {


  private $tablePo = 'purchased_order';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function counter_sr() {
    $this->db->query('SELECT sr  FROM counter');
    $counter = $this->db->resultSet();
    return $counter;
  }

  public function updateCounter() {
    $query = "UPDATE counter SET sr = sr+1";
    $this->db->query($query);
    $this->db->execute();
  }

  public function getAllDataSr() {
    $this->db->query('SELECT a.NO_SR, a.PEMINTA, a.TGL_SR, a.KODE_SP, c.NAMA_SP, a.KODE_BRG, b.NAMA_BRG, b.Jenis_brg, b.Stock_brg, a.QTY_MINTA, a.QTY_TERIMA, b.Satuan, a.HARGA_SR, a.TOT_HARGA
      FROM surat_request a
      LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
      LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP
      WHERE a.KODEF = :kodef AND status != "1" AND a.QTY_MINTA > a.QTY_TERIMA
      ORDER BY a.NO_SR DESC;');

    $this->db->bind('kodef', $_SESSION['login']['KODEF']);
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
    $this->db->query('SELECT NO_SR, TGL_SR, PEMINTA, a.KODE_SP, b.NAMA_SP
                      FROM surat_request_tmp a
                      INNER JOIN supplier b ON a.KODE_SP = b.KODE_SP
                      WHERE status != "1" AND KODEF = :kodef ORDER BY NO_SR DESC Limit 1;');

    $this->db->bind('kodef', $_SESSION['login']['KODEF']);
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

  public function getDataSrDtl($data) {
      $this->db->query('SELECT NO_SR, a.KODE_BRG, b.NAMA_BRG, QTY_MINTA, HARGA_SR
                        FROM surat_request a
                        INNER JOIN barang b ON a.KODE_BRG = b.KODE_BRG
                        WHERE a.NO_SR = :id AND a.KODE_BRG = :kd');
      $this->db->bind('id', $data['id']);
      $this->db->bind('kd', $data['kd']);
      return $this->db->single();
  }

  public function tambahData($data) {
    $query = "INSERT INTO surat_request_tmp (NO_SR, TGL_SR, PEMINTA, KODEF, KODE_SP, status)
                VALUES
                (:noSr, :tanggal_sr, :peminta, :kodef, :sp, DEFAULT)";
    // var_dump($query);
    // echo $query;
    $this->db->query($query);
    $this->db->bind('noSr', $data['noSr']);
    $this->db->bind('tanggal_sr', $data['tanggal_sr']);
    $this->db->bind('peminta', $data['peminta']);
    $this->db->bind('kodef', $_SESSION['login']['KODEF']);
    $this->db->bind('sp', $data['sp']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function tambahDataSr($data) {
    $i = 0;
    $y = 1;
    foreach( $data['nmBrg'] as $brg) {
      if ( $data['qty'][$i] <= 0 || is_null($data['qty'][$i]) ) {
        if ( $y == count($data['nmBrg']) ) {
          return true;
        } else {
          $i++;
          $y++;
          continue;
        }
      } else {
        $query = "INSERT INTO surat_request (NO_SR, TGL_SR, PEMINTA, KODEF, KODE_SP, KODE_BRG, QTY_MINTA, HARGA_SR, TOT_HARGA, QTY_TERIMA, status)
                    VALUES
                    (:noSr, :tanggal_sr, :peminta, :kodef, :sp, :kdBrg" .$i. ", :qty" .$i. ", :harga" .$i. ", NULL, DEFAULT, DEFAULT)";
        // var_dump($query);
        // echo $query;
        $this->db->query($query);
        $this->db->bind('noSr', $data['noSr']);
        $this->db->bind('tanggal_sr', $data['tanggal_sr']);
        $this->db->bind('peminta', $data['peminta']);
        $this->db->bind('kodef', $_SESSION['login']['KODEF']);
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
    }
  }

  public function hapusData($data) {
    $query = "DELETE FROM surat_request WHERE NO_SR = :id AND KODE_BRG = :kd";
    $this->db->query($query);
    $this->db->bind('id', $data['id']);
    $this->db->bind('kd', $data['kd']);
    $this->db->execute();
    return $this->db->rowCount();
  }

  public function hapusSr($data) {
    $query = "UPDATE surat_request_tmp SET status = '1' WHERE NO_SR = :id";
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
    $query = "UPDATE surat_request_tmp SET
                NO_SR = :noSr2,
                TGL_SR = :tanggal_sr2,
                PEMINTA = :peminta2,
                KODE_SP = :sp2
              WHERE NO_SR = :No_sr";

    $this->db->query($query);
    $this->db->bind('noSr2', $data['noSr2']);
    $this->db->bind('tanggal_sr2', $data['tanggal_sr2']);
    $this->db->bind('peminta2', $data['peminta2']);
    $this->db->bind('sp2', $data['sp2']);
    $this->db->bind('noPo2', $data['noPo2']);
    $this->db->bind('No_sr', $data['No_sr']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function ubahDataSr($data) {
    $query = "UPDATE surat_request SET
                KODE_BRG = :brg,
                QTY_MINTA = :qty,
                HARGA_SR = :harga
              WHERE NO_SR = :detailNoPo AND KODE_BRG = :detailBarang";

    $this->db->query($query);
    $this->db->bind('brg', $data['brg']);
    $this->db->bind('qty', $data['qty']);
    $this->db->bind('harga', $data['harga']);
    $this->db->bind('detailNoPo', $data['detailNoPo']);
    $this->db->bind('detailBarang', $data['detailBarang']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function cariDataSr($keyword) {
    $query = "SELECT a.NO_SR, a.PEMINTA, a.TGL_SR, c.NAMA_SP, a.KODE_SP, b.NAMA_BRG, b.Jenis_brg, b.Stock_brg, a.QTY_MINTA, b.Satuan, a.HARGA_SR, a.TOT_HARGA
    FROM surat_request a
    LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
    LEFT JOIN supplier c ON a.KODE_SP = c.KODE_SP
    WHERE NO_SR LIKE :keyword";
    $this->db->query($query);
    $this->db->bind('keyword', "%$keyword%");
    return $this->db->single();
  }

}
 ?>
