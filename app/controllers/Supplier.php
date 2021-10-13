<?php

  class Supplier extends Controller {

    public function index() {
      $data['judul'] = 'Daftar Supplier';
      $data['supplier'] = $this->model('Supplier_model')->getAllSupplier();

      $this->view('templates/header', $data);
      $this->view('supplier/index', $data);
      $this->view('templates/footer');
    }

    public function tambah() {

      if ( $this->model('Supplier_model')->tambahSupplier($_POST) > 0) {
        Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        header('Location: ' . BASEURL . '/Supplier');
        exit;
      } else {
        Flasher::setFlash('berhasil', 'ditambahkan', 'danger');
        header('Location :' .BASEURL . '/Supplier');
        exit;
      }
    }

    public function hapus() {
      if ( $this->model('Supplier_model')->hapusSupplier($data) > 0) {
        Flasher::setFlash('berhasil', 'dihapus', 'success');
        header('Location: ' . BASEURL . '/Supplier');
        exit;
      } else {
        Flasher::setFlash('gagal', 'dihapus', 'danger');
        header('Location: ' . BASEURL . '/Supplier');
        exit;
      }
    }

  }


 ?>
