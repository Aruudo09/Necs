<?php
class Purchased_order_model {
  // private $mhs = [
  //     [
  //       "nama" => "Aldo",
  //       "nrp" => "1318095",
  //       "email" => "audricafabiano@gmail.com",
  //       "jurusan" => "Sistem Informasi"
  //     ],
  //     [
  //       "nama" => "Imron",
  //       "nrp" => "1318096",
  //       "email" => "audricafabiano@gmail.com",
  //       "jurusan" => "Sistem Informasi"
  //     ],
  //     [
  //       "nama" => "Febi",
  //       "nrp" => "1318097",
  //       "email" => "audricafabiano@gmail.com",
  //       "jurusan" => "Sistem Informasi"
  //     ]
  //
  // ];

  // private $dbh;
  // private $stmt;
  //
  // public function __construct() {
  //   $dsn = 'mysql:host=localhost;dbname=phpmvc';
  //
  //   try {
  //     $this->dbh = new PDO($dsn, 'root', '');
  //
  //   } catch (PDOException $e) {
  //     die($e->getMessage());
  //   }
  //
  // }

  private $tablePo = 'purchased_order';
  private $tableDetail = 'detail_po';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getAllDataPo() {
    $this->db->query('SELECT * FROM '. $this->tablePo);
    return $this->db->resultSet();

  }

  public function getDataPoById($No_po) {
      $this->db->query('SELECT * FROM ' . $this->tableDetail . ' WHERE No_po=:No_po');
      $this->db->bind('No_po', $No_po);
      return $this->db->resultSet();
  }

  public function tambahDataPo($data) {
    $query = "INSERT INTO purchased_order
                VALUES
                ('', :Tanggal_keluar, :Pemesan, '')";
    var_dump($query);
    // echo $query;
    $this->db->query($query);
    $this->db->bind('Tanggal_keluar', $data['Tanggal_keluar']);
    $this->db->bind('Pemesan', $data['Pemesan']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function hapusDataPo($No_po) {
    $query = "DELETE FROM purchased_order WHERE No_po=:No_po";
    $this->db->query($query);
    $this->db->bind('No_po', $No_po);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getDataPoUbah($No_po) {
      $this->db->query('SELECT * FROM ' . $this->tablePo . ' WHERE No_po=:No_po');
      $this->db->bind('No_po', $No_po);
      return $this->db->single();
  }

  public function ubahDataPo($data) {
    $query = "UPDATE purchased_order SET
                Tanggal_keluar = :Tanggal_keluar,
                Pemesan = :Pemesan,
                Tanggal_update = :Tanggal_update
              WHERE No_po = :No_po";
    // var_dump($query);
    // echo $query;
    $this->db->query($query);
    $this->db->bind('Tanggal_keluar', $data['Tanggal_keluar']);
    $this->db->bind('Pemesan', $data['Pemesan']);
    $this->db->bind('Tanggal_update', $data['Tanggal_update']);
    $this->db->bind('No_po', $data['No_po']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function cariDataPo() {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM purchased_order WHERE Pemesan LIKE :keyword";
    $this->db->query($query);
    $this->db->bind('keyword', "%$keyword%");
    return $this->db->resultSet();
  }

}
 ?>
