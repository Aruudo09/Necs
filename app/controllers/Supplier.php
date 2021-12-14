<?php

  class Supplier extends Controller {

    public function index($page) {

      $cek = $_SERVER['REQUEST_URI'];
      if ( strpos($cek, '/supplier/1/')) {
        $_SESSION['cari'] = '';
      } else {
        if ( isset($_POST['srchBtn']) ) {
          $_SESSION['cari'] = $_POST['keyword'];
        } elseif ( empty($_SESSION['cari'])) {
          $_SESSION['cari'] = '';
        }
      }

      $data['supplier'] = $this->model('Supplier_model')->getAllSupplier($page);

      $this->akses();
      $this->view('templates/header', $data);
      $this->view('supplier/index', $data);
      $this->view('templates/footer');
    }

    public function tambah() {

      if ( $this->model('Supplier_model')->tambahSupplier($_POST) > 0) {
        Flasher::setFlash('Supplier', 'berhasil', 'ditambahkan', 'success');
        header('Location: ' . BASEURL . '/supplier/1');
        exit;
      } else {
        Flasher::setFlash('Supplier', 'berhasil', 'ditambahkan', 'danger');
        header('Location :' .BASEURL . '/supplier/1');
        exit;
      }
    }

    public function hapus($data) {
      if ( $this->model('Supplier_model')->hapusSupplier($data) > 0) {
        Flasher::setFlash('Supplier', 'berhasil', 'dihapus', 'success');
        header('Location: ' . BASEURL . '/supplier/1');
        exit;
      } else {
        Flasher::setFlash('Supplier', 'gagal', 'dihapus', 'danger');
        header('Location: ' . BASEURL . '/supplier/1');
        exit;
      }
    }

    public function getUbah() {
        echo json_encode($this->model('Supplier_model')->getSplUbah($_POST['KODE_SP']));
      }

    public function ubah() {
        if ( $this->model('Supplier_model')->ubahSpl($_POST) > 0) {
          Flasher::setFlash('Supplier', 'berhasil', 'diubah', 'success');
          header('Location: ' . BASEURL . '/supplier/1');
          exit;
        } else {
          Flasher::setFlash('Supplier', 'gagal', 'diubah', 'danger');
          header('Location: ' . BASEURL . '/supplier/1');
          exit;
        }
      }

    public function cari() {
    $data['judul'] = 'Daftar Mahasiswa';
    $data['supplier'] = $this->model('Supplier_model')->cariData();
    $this->view('templates/header', $data);
    $this->view('supplier/index', $data);
    $this->view('templates/footer');
    }

  }


 ?>
