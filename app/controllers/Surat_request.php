<?php
class Surat_request extends Controller {

  public function index($page) {

    $cek = $_SERVER['REQUEST_URI'];
    if ( strpos($cek, '/surat_request/1/') ) {
      $_SESSION['cari'] = '';
    } else {
      if ( isset($_POST['srchbtn'])) {
        $_SESSION['cari'] = $_POST['keyword'];
      } elseif ( empty($_SESSION['cari']) ) {
        $_SESSION['cari'] = '';
      }
     }

    $data['po'] = $this->model('Surat_request_model')->getAllDataSr();
    $data['tmp'] = $this->model('Surat_request_model')->getAllDataTmp($page);
    $data['sp'] = $this->model('Surat_request_model')->getDataSpl();
    $data['brg'] = $this->model('Surat_request_model')->getDataBrg();
    $data['counter'] = $this->model('Surat_request_model')->counter_sr();

    $this->akses();
    $this->view('templates/header', $data);
    $this->view('surat_request/index', $data);
    $this->view('templates/footer');
  }

  //-------FUNGSI GET NOMOR SURAT DETAIL---------//
  public function getSr() {
    echo json_encode($this->model('Surat_request_model')->getDataSr($_POST));
  }


//---------FUNGSI GET OBJECT ARRAY DETAIL SR----------//
  public function getUbahDtl() {
    echo json_encode($this->model('Surat_request_model')->getDataSrDtl($_POST));
  }

//---------FUNGSI MENAMPILKAN REPORT SR----------//
  public function detail($No_po, $No_po1, $No_po2, $No_po3) {
    $data['judul'] = 'Detail Surat Request';
    $data['po'] = $this->model('Surat_request_model')->getAlldataPoCtkTmp($No_po, $No_po1, $No_po2, $No_po3);
    $data['po1'] = $this->model('Surat_request_model')->getAlldataPoCtkDtl($No_po, $No_po1, $No_po2, $No_po3);

    $this->view('surat_request/detail', $data);

  }

//---------FUNGSI MEMBUAT NOMOR SR----------//
  public function tambah() {
    // var_dump($_POST);
    if ( $this->model('Surat_request_model')->tambahData($_POST) > 0) {
      if ( $this->model('Surat_request_model')->tambahDataSr($_POST) == true) {
        $this->model('Surat_request_model')->updateCounter();
        Flasher::setFlash('Surat Request', 'berhasil', 'ditambahkan', 'success');
          header('Location: ' . BASEURL . '/surat_request/1');
          unset($_SESSION['cari']);
          exit;
    } else {
      Flasher::setFlash('Surat Request', 'gagal', 'ditambahkan', 'danger');
        header('Location: ' . BASEURL . '/surat_request/1');
        unset($_SESSION['cari']);
        exit;
    }
  }
}

//---------FUNGSI UBAH NOMOR SR----------//
  public function Update() {
    if ( $this->model('Surat_request_model')->ubahData($_POST) > 0) {
      Flasher::setFlash('Surat Request', 'berhasil', 'diubah', 'success');
        header('Location: ' . BASEURL . '/surat_request/1');
        unset($_SESSION['cari']);
        exit;
    } else {
      Flasher::setFlash('Surat Request', 'gagal', 'diubah', 'danger');
        header('Location: ' . BASEURL . '/surat_request/1');
        unset($_SESSION['cari']);
        exit;
    }
  }

  //---------GET DETAIL SR----------//
  public function getSrDtl() {
    echo json_encode($this->model('Surat_request_model')->getDataSrDtl($_POST));
  }

//---------FUNGSI UBAH DETAIL SR----------//
  public function ubah() {
    if ( $this->model('Surat_request_model')->ubahDataSr($_POST) == true ) {
      Flasher::setFlash('Surat Request', 'berhasil', 'diubah', 'success');
        header('Location: ' . BASEURL . '/surat_request/1');
        unset($_SESSION['cari']);
        exit;
    } else {
      Flasher::setFlash('Surat Request', 'gagal', 'diubah', 'danger');
        header('Location: ' . BASEURL . '/surat_request/1');
        unset($_SESSION['cari']);
        exit;
    }
  }

  //---------FUNSGI HAPUS NOMOR SR-----------//
  public function hapus($no_sr) {
    if ( $this->model('Surat_request_model')->hapusSr(str_replace('-f', '/', ($no_sr))) > 0 ) {
      Flasher::setFlash('Surat Request', 'berhasil', 'dihapus', 'primary');
      header('Location: ' . BASEURL . '/surat_request/1');
      unset($_SESSION['cari']);
      exit;
    } else {
      Flasher::setFlash('Surat Request', 'gagal', 'dihapus', 'danger');
      header('Location: ' . BASEURL . '/surat_request/1');
      exit;
    }
  }

//---------FUNGSI HAPUS DETAIL SR----------//
  public function hapusSr() {
    echo json_encode($this->model('Surat_request_model')->hapusData($_POST));
  }

}
 ?>
