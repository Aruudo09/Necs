<?php

  class Barang_masuk extends Controller {

      public function index() {
          $data['barangMsk'] = $this->model('Barang_masuk_model')->getAllBarangMsk();
          $this->view('templates/header', $data);
          $this->view('barang_masuk/index', $data);
          $this->view('templates/footer');
      }

      public function tambah() {
        if ( $this->model('Barang_masuk_model')->tambahBrgMsk($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/Barang_masuk');
            exit;
        } else {
          Flasher::setFlash('gagal', 'ditambahkan', 'danger');
          header('Location: ' . BASEURL . '/Barang_masuk');
          exit;
        }
      }

      public function hapus($No_msk) {
        if ( $this->model('Barang_masuk_model')->hapusBrgMsk($No_msk) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/Barang_masuk');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dhapus', 'danger');
            header('Location: ' . BASEURL . '/Barang_masuk');
            exit;
        }
      }

      public function getUbah() {
        echo json_encode($this->model('Barang_masuk_model')->getBrgMskUbah($_POST['No_msk']));
      }

      public function ubah() {
        if ( $this->model('Barang_masuk_model')->ubahBrgMsk($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/Barang_masuk');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/Barang_masuk');
            exit;
        }
      }

  }

 ?>
