<?php
class purchased_order extends Controller {

  public function index() {
    $data['judul'] = 'Daftar Mahasiswa';
    $data['po'] = $this->model('Purchased_order_model')->getAllDataPo();
    $data['tmp'] = $this->model('Purchased_order_model')->getAllDataTmp();
    $data['sp'] = $this->model('Purchased_order_model')->getDataSpl();
    $data['brg'] = $this->model('Purchased_order_model')->getDataBrg();
    $data['counter'] = $this->model('Purchased_order_model')->counter_po();

    $this->view('templates/header', $data);
    $this->view('purchased_order/index', $data);
    $this->view('templates/footer');
  }

//---------FUNGSI GET OBJECT ARRAY NOMOR PO----------//
  public function getUbah() {
    echo json_encode($this->model('Purchased_order_model')->getDataPoTmp($_POST['id']));
  }

//---------FUNGSI GET OBJECT ARRAY DETAIL PO----------//
  public function getUbahDtl() {
    echo json_encode($this->model('Purchased_order_model')->getDataPoDtl($_POST['id']));
  }

//---------FUNGSI MENAMPILKAN REPORT PO----------//
  public function detail($No_po) {
    $data['judul'] = 'Detail Purchased Order';
    $data['detail'] = $this->model('Purchased_order_model')->getDataPoById($No_po);
    $this->view('templates/header', $data);
    $this->view('purchased_order/detail', $data);
    $this->view('templates/footer');
  }

//---------FUNGSI MEMBUAT NOMOR PO----------//
  public function tambah() {
    // var_dump($_POST);
    if ( $this->model('Purchased_order_model')->tambahData($_POST) > 0) {
      $this->model('Purchased_order_model')->updateCounter();
      Flasher::setFlash('Purchased Order', 'berhasil', 'ditambahkan', 'success');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    } else {
      Flasher::setFlash('Purchased Order', 'gagal', 'ditambahkan', 'danger');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    }
  }
//---------FUNGSI MEMBUAT DETAIL PO----------//
  public function tambahDetail() {
    // var_dump($_POST);
    if ( $this->model('Purchased_order_model')->tambahDataPo($_POST) > 0) {
      Flasher::setFlash('Purchased Order', 'berhasil', 'ditambahkan', 'success');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    } else {
      Flasher::setFlash('Purchased Order', 'gagal', 'ditambahkan', 'danger');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    }
  }

//---------FUNGSI UBAH NOMOR PO----------//
  public function Update() {
    if ( $this->model('Purchased_order_model')->ubahData($_POST) > 0) {
      Flasher::setFlash('Purchased Order', 'berhasil', 'diubah', 'success');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    } else {
      Flasher::setFlash('Purchased Order', 'gagal', 'diubah', 'danger');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    }
  }

//---------FUNGSI UBAH DETAIL PO----------//
  public function ubah() {
    if ( $this->model('Purchased_order_model')->ubahDataPo($_POST) > 0) {
      Flasher::setFlash('Purchased Order', 'berhasil', 'diubah', 'success');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    } else {
      Flasher::setFlash('Purchased Order', 'gagal', 'diubah', 'danger');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    }
  }

//---------FUNGSI HAPUS NOMOR PO----------//
  public function hapusPo($No_po) {
    if ( $this->model('Purchased_order_model')->hapusData($No_po) > 0) {
      Flasher::setFlash('Purchased Order', 'berhasil', 'dihapus', 'success');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    } else {
      Flasher::setFlash('Purchased Order', 'gagal', 'dihapus', 'danger');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    }
  }

//---------FUNGSI HAPUS DETAIL PO----------//
  public function hapusDetail($No_po) {
    // var_dump($_POST);
    if ( $this->model('Purchased_order_model')->hapusDataPo($No_po) > 0) {
      Flasher::setFlash('Purchased Order', 'berhasil', 'dihapus', 'success');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    } else {
      Flasher::setFlash('Purchased Order', 'gagal', 'dihapus', 'danger');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    }
  }

//---------FUNGSI CARI DETAIL PO----------//
  public function cari() {
    $data['judul'] = 'Daftar Mahasiswa';
    $data['po'] = $this->model('Purchased_order_model')->cariDataPo();

    $this->view('templates/header', $data);
    $this->view('purchased_order/index', $data);
    $this->view('templates/footer');
  }

}
 ?>
