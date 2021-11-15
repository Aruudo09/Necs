<?php

  class Barang_keluar extends Controller {

      public function index() {
        $data['judul'] = 'Daftar Barang Keluar';
        $data['barangKlr'] = $this->model('Barang_keluar_model')->getAllBarangKlr();
        $data['optionBrg'] = $this->model('Barang_keluar_model')->getBarangItem();
        $data['counter'] = $this->model('Barang_keluar_model')->getDataCounter();

        $this->akses();
        $this->view('templates/header', $data);
        $this->view('barang_keluar/index', $data);
        $this->view('templates/footer');
      }

      public function tambah() {
        if ( $this->model('Barang_keluar_model')->cekStock($_POST) == true) {
          echo "<script type='text/javascript'>alert('PAS MANTAB!');</script>";
        if ($this->model('Barang_keluar_model')->tambahBrgKlr($_POST) == true) {
            $this->model('Barang_keluar_model')->updateCounter();
            Flasher::setFlash('Barang Keluar', 'berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/barang_keluar');
            exit;
        } else {
          Flasher::setFlash('Barang Keluar', 'gagal', 'ditambahkan', 'danger');
          header('Location: ' . BASEURL . '/barang_keluar');
          exit;
        }
      } else {
        echo "<script type='text/javascript'>alert('Kuantitas Melibihi Stock!');</script>";
      }
      }

      public function hapus($No_pakai) {
        if ( $this->model('Barang_keluar_model')->hapusDataKlr($No_pakai)) {
            Flasher::setFlash('Barang Keluar', 'berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/barang_keluar');
            exit;
        } else {
          Flasher::setFlash('Barang Keluar', 'gagal', 'dihapus', 'danger');
          header('Location: ' . BASEURL . '/barang_keluar');
          exit;
        }
      }

      public function getUbah() {
        echo json_encode($this->model('Barang_keluar_model')->getBrgKlrUbah($_POST['No_pakai']));
      }

      public function ubah() {
        if ( $this->model('Barang_keluar_model')->ubahBrgKlr($_POST) > 0) {
          Flasher::setFlash('Barang Keluar', 'berhasil', 'diubah', 'success');
          header('Location: ' . BASEURL . '/barang_keluar');
          exit;
        } else {
          Flasher::setFlash('Barang Keluar', 'gagal', 'diubah', 'danger');
          header('Location: ' . BASEURL . '/barang_keluar');
          exit;
        }
      }

      public function cari() {
      $data['judul'] = 'Daftar Mahasiswa';
      $data['barangKlr'] = $this->model('Barang_keluar_model')->cariData();
      $this->view('templates/header', $data);
      $this->view('barang_keluar/index', $data);
      $this->view('templates/footer');
    }
  }

 ?>
