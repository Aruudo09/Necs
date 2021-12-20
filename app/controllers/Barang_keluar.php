<?php

  class Barang_keluar extends Controller {

      public function index($page) {

        $cek = $_SERVER['REQUEST_URI'];
        if ( strpos($cek, '/barang_keluar/1/')) {
          $_SESSION['cari'] = '';
        } else {
          if ( isset($_POST['srchbtn']) ) {
            $_SESSION['cari'] = $_POST['keyword'];
          } elseif ( empty($_SESSION['cari']) ) {
            $_SESSION['cari'] = '';
          }
        }

        $data['barangKlr'] = $this->model('Barang_keluar_model')->getAllBarangKlr($page);
        $data['optionBrg'] = $this->model('Barang_keluar_model')->getBarangItem();
        $data['counter'] = $this->model('Barang_keluar_model')->getDataCounter();

        $this->akses();
        $this->view('templates/header', $data);
        $this->view('barang_keluar/index', $data);
        $this->view('templates/footer');
      }

      public function tambah() {
        if ( $this->model('Barang_keluar_model')->cekStock($_POST) == true) {
            if ( $this->model('Barang_keluar_model')->tambahKlr($_POST) > 0 && $this->model('Barang_keluar_model')->tambahBrgKlr($_POST) == true) {
                $this->model('Barang_keluar_model')->updateCounter();
                Flasher::setFlash('Barang Keluar', 'berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . '/barang_keluar/1');
                exit;
            } else {
              Flasher::setFlash('Barang Keluar', 'gagal', 'ditambahkan', 'danger');
              header('Location: ' . BASEURL . '/barang_keluar/1');
              exit;
            }
       } else {
        FLASHER::setFlash('Kuantitas', 'Melebihi', 'Stock Barang', 'danger');
        header('Location: ' . BASEURL . '/barang_keluar/1');
       }
      }

      public function hapus($data) {
        if ( $this->model('Barang_keluar_model')->hapusDataKlr(str_replace('-F', '/', $data)) > 0 ) {
          Flasher::setFlash('Barang Keluar', 'Berhasil', 'dihapus', 'success');
          header('Location: ' . BASEURL . '/barang_keluar/1');
          exit;
        } else {
          Flasher::setFlash('Barang Keluar', 'Gagal', 'dihapus', 'danger');
          header('Location: ' . BASEURL . '/barang_keluar/1');
          exit;
        }
      }

      public function hapusDtl() {
        echo json_encode($this->model('Barang_keluar_model')->hapusDtl($_POST));
      }

      public function getDtl() {
        echo json_encode($this->model('Barang_keluar_model')->getDtl($_POST));
      }

      public function getUbah() {
        echo json_encode($this->model('Barang_keluar_model')->getBrgKlrUbah($_POST));
      }

      public function ubahTmp() {
        if ( $this->model('Barang_keluar_model')->ubahKlr($_POST) > 0 ) {
          Flasher::setFlash('Barang Keluar', 'Berhasil', 'diubah', 'success');
          header('Location: ' . BASEURL . '/barang_keluar/1');
          exit;
        } else {
          Flasher::setFlash('Barang Keluar', 'Gagal', 'diubah', 'danger');
          header('Location: ' . BASEURL . '/barang_keluar/1');
          exit;
        }
      }

      public function ubah() {
        if ( $this->model('Barang_keluar_model')->ubahBrgKlr($_POST) == true ) {
          Flasher::setFlash('Barang Keluar', 'berhasil', 'diubah', 'success');
          header('Location: ' . BASEURL . '/barang_keluar/1');
          exit;
        } else {
          Flasher::setFlash('Barang Keluar', 'gagal', 'diubah', 'danger');
          header('Location: ' . BASEURL . '/barang_keluar/1');
          exit;
        }
      }

  }

 ?>
