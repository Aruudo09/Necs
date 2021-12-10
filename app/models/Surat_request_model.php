<?php
class Surat_request_model {


  private $tablePo = 'purchased_order';
  private $db;

  public function __construct() {
    $this->db = new Database;
    $this->dbh = new Database;
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

  public function getDataSr($data) {
    $query = "SELECT * FROM surat_request_tmp WHERE NO_SR = :id";
    $this->db->query($query);
    $this->db->bind('id', $data['id']);

    return $this->db->single();
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

  public function getAllDataTmp($page) {
    $key = $_SESSION['cari'];
    $this->dbh->query('SELECT * FROM surat_request_tmp WHERE NO_SR LIKE :key AND kodef = :kodef');
    $this->dbh->bind('key', "%$key%");
    $this->dbh->bind('kodef', $_SESSION['login']['KODEF']);
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
    $query = "SELECT a.NO_SR, a.TGL_SR, a.PEMINTA, a.KODE_SP, b.NAMA_SP , a.KODEF, c.NMDEF
                      FROM surat_request_tmp a
                      INNER JOIN supplier b ON a.KODE_SP = b.KODE_SP
                      INNER JOIN tarif c ON a.KODEF = c.KODEF
                      WHERE NO_SR LIKE :key AND status != 1 AND a.KODEF = :kodef ORDER BY NO_SR
                      LIMIT $dataAwal, $banyakDataPerHal";
    $this->db->query($query);
    $this->db->bind('key', "%$key%");
    $this->db->bind('kodef', $_SESSION['login']['KODEF']);

    $dt = array(
      "data" => $this->db->resultSet(),
      "halamanAktif" => $halamanAktif,
      "banyakHal" => $banyakHal
    );

    return $dt;
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
      $this->db->query('SELECT a.NO_SR, a.TGL_SR, a.PEMINTA, a.KODEF, c.NMDEF, a.KODE_SP, d.NAMA_SP, c.NMDEF, a.KODE_BRG, b.NAMA_BRG, b.Satuan, QTY_MINTA, HARGA_SR, TOT_HARGA
                        FROM surat_request a
                        LEFT JOIN barang b ON a.KODE_BRG = b.KODE_BRG
                        LEFT JOIN tarif c ON a.KODEF = c.KODEF
                        LEFT JOIN supplier d ON a.KODE_SP = d.KODE_SP
                        WHERE a.NO_SR = :id');
      $this->db->bind('id', $data['id']);
      return $this->db->resultSet();
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

    if ( $this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function hapusSr($no_sr) {
    $query = "UPDATE surat_request_tmp SET status = '1' WHERE NO_SR = :no_sr";
    $this->db->query($query);
    $this->db->bind('no_sr', $no_sr);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function ubahData($data) {
    $query = "UPDATE surat_request_tmp SET
                TGL_SR = :tanggal_sr2,
                KODE_SP = :sp2
              WHERE NO_SR = :noSr2";

    $this->db->query($query);
    $this->db->bind('noSr2', $data['noSr2']);
    $this->db->bind('tanggal_sr2', $data['tanggal_sr2']);
    $this->db->bind('sp2', $data['sp2']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function ubahDataSr($data) {
    $i = 0;
    $y = 1;
    foreach ($data['brg'] as $brg ) {
      $query = "UPDATE surat_request SET
                  QTY_MINTA = :qty" .$i. ",
                  HARGA_SR = :hrg" .$i. "
                WHERE NO_SR = :Sr AND KODE_BRG = :brg" .$i. "";

      $this->db->query($query);
      $this->db->bind('brg' .$i, $data['brg'][$i]);
      $this->db->bind('qty' .$i, $data['qty'][$i]);
      $this->db->bind('hrg' .$i, $data['hrg'][$i]);
      $this->db->bind('Sr', $data['Sr']);

      $this->db->execute();

      if ( $y == count($data['brg'])) {
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
