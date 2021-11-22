<?php
class Surat_request extends Controller {

  public function index() {
    $data['judul'] = 'Daftar Mahasiswa';
    $data['po'] = $this->model('Surat_request_model')->getAllDataSr();
    $data['tmp'] = $this->model('Surat_request_model')->getAllDataTmp();
    $data['sp'] = $this->model('Surat_request_model')->getDataSpl();
    $data['brg'] = $this->model('Surat_request_model')->getDataBrg();
    $data['counter'] = $this->model('Surat_request_model')->counter_sr();

    $this->akses();
    $this->view('templates/header', $data);
    $this->view('surat_request/index', $data);
    $this->view('templates/footer');
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
          header('Location: ' . BASEURL . '/surat_request');
          exit;
    } else {
      Flasher::setFlash('Surat Request', 'gagal', 'ditambahkan', 'danger');
        header('Location: ' . BASEURL . '/surat_request');
        exit;
    }
  }
}

//---------FUNGSI UBAH NOMOR SR----------//
  public function Update() {
    if ( $this->model('Surat_request_model')->ubahData($_POST) > 0) {
      Flasher::setFlash('Surat Request', 'berhasil', 'diubah', 'success');
        header('Location: ' . BASEURL . '/surat_request');
        exit;
    } else {
      Flasher::setFlash('Surat Request', 'gagal', 'diubah', 'danger');
        header('Location: ' . BASEURL . '/surat_request');
        exit;
    }
  }

//---------FUNGSI UBAH DETAIL SR----------//
  public function ubah() {
    if ( $this->model('Surat_request_model')->ubahDataSr($_POST) > 0) {
      Flasher::setFlash('Surat Request', 'berhasil', 'diubah', 'success');
        header('Location: ' . BASEURL . '/surat_request');
        exit;
    } else {
      Flasher::setFlash('Surat Request', 'gagal', 'diubah', 'danger');
        header('Location: ' . BASEURL . '/surat_request');
        exit;
    }
  }

  //---------FUNSGI HAPUS NOMOR SR-----------//
  public function hapus() {
    $this->model('Surat_request_model')->hapusSr($_POST);
    $this->model('Surat_request_model')->ubahStat($_POST);
  }

//---------FUNGSI HAPUS DETAIL SR----------//
  public function hapusSr() {
    $this->model('Surat_request_model')->hapusData($_POST);
  }



//---------FUNGSI CARI SR----------//
  public function cari() {
    echo json_encode($this->model('Surat_request_model')->cariDataSr($_POST['srchPo']));
  }

}
 ?>
