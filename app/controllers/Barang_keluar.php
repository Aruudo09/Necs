<?php

  class Barang_keluar extends Controller {

      public function index() {
        $data['judul'] = 'Daftar Barang Keluar';
        $data['barangKlr'] = $this->model('Barang_keluar_model')->getAllBarangKlr();
        $this->view('templates/header', $data);
        $this->view('barang_keluar/index', $data);
        $this->view('templates/footer');
      }

      public function tambah() {
        if ( $this->model('Barang_keluar_model')->tambahBrgKlr($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/Barang_keluar');
            exit;
        } else {
          Flasher::setFlash('gagal', 'ditambahkan', 'danger');
          header('Location: ' . BASEURL . '/Barang_keluar');
          exit;
        }
      }

      public function hapus($No_pakai) {
        if ( $this->model('Barang_keluar_model')->hapusDataKlr($No_pakai)) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/Barang_keluar');
            exit;
        } else {
          Flasher::setFlash('gagal', 'dihapus', 'danger');
          header('Location: ' . BASEURL . '/Barang_keluar');
          exit;
        }
      }
  }

 ?>
