<?php
class purchased_order extends Controller {

  public function index() {
    $data['judul'] = 'Daftar Mahasiswa';
    $data['po'] = $this->model('Purchased_order_model')->getAllDataPo();
    $this->view('templates/header', $data);
    $this->view('purchased_order/index', $data);
    $this->view('templates/footer');
  }

  public function detail($No_po) {
    $data['judul'] = 'Detail Purchased Order';
    $data['detail'] = $this->model('Purchased_order_model')->getDataPoById($No_po);
    $this->view('templates/header', $data);
    $this->view('purchased_order/detail', $data);
    $this->view('templates/footer');
  }

  public function tambah() {
    // var_dump($_POST);
    if ( $this->model('Purchased_order_model')->tambahDataPo($_POST) > 0) {
      Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    } else {
      Flasher::setFlash('gagal', 'ditambahkan', 'danger');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    }
  }

  public function hapus($No_po) {
    // var_dump($_POST);
    if ( $this->model('Purchased_order_model')->hapusDataPo($No_po) > 0) {
      Flasher::setFlash('berhasil', 'dihapus', 'success');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    } else {
      Flasher::setFlash('gagal', 'dihapus', 'danger');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    }
  }

  public function getubah() {
    echo json_encode($this->model('Purchased_order_model')->getDataPoUbah($_POST['id']));
  }

  public function ubah() {
    if ( $this->model('Purchased_order_model')->ubahDataPo($_POST) > 0) {
      Flasher::setFlash('berhasil', 'diubah', 'success');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    } else {
      Flasher::setFlash('gagal', 'diubah', 'danger');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
    }
  }

  public function cari() {
    $data['judul'] = 'Daftar Mahasiswa';
    $data['po'] = $this->model('Purchased_order_model')->cariDataPo();
    $this->view('templates/header', $data);
    $this->view('purchased_order/index', $data);
    $this->view('templates/footer');
  }

}
 ?>
