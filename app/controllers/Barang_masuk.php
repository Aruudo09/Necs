<?php

  class Barang_masuk extends Controller {

      public function index() {
          $data['barangMsk'] = $this->model('Barang_masuk_model')->getAllBarangMsk();
          $data['bcraTmp'] = $this->model('Barang_masuk_model')->getDataBcraTmp();
          $data['po'] = $this->model('Purchased_order_model')->getAllDataPo();
          $data['sp'] = $this->model('Barang_masuk_model')->getOptionSpl();
          $data['opsiBrg'] = $this->model('Barang_masuk_model')->getOptionBrg();
          $data['counter'] = $this->model('Barang_masuk_model')->counter_po();

          $this->view('templates/header', $data);
          $this->view('barang_masuk/index', $data);
          $this->view('templates/footer');
      }

      public function detail($PENERIMA) {
        $data['detail'] = $this->model('Barang_masuk_model')->getDataByPenerima($PENERIMA);

        $this->view('barang_masuk/detail', $data);
      }

      public function tambahTmp() {
        if ( $this->model('Barang_masuk_model')->tambahBrgMskTmp($_POST) > 0) {
            $this->model('Barang_masuk_model')->updateCounter();
            Flasher::setFlash('Berita Acara', 'berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/barang_masuk');
            exit;
        } else {
          Flasher::setFlash('Berita Acara', 'gagal', 'ditambahkan', 'danger');
          header('Location: ' . BASEURL . '/barang_masuk');
          exit;
        }
      }

      public function tambah() {
      if( $this->model('Barang_masuk_model')->cekOrder($_POST) == true) {
        if ( $this->model('Barang_masuk_model')->tambahBrgMsk($_POST) > 0) {
            $this->model('Barang_masuk_model')->updateorder($_POST);
            Flasher::setFlash('Berita Acara', 'berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/barang_masuk');
            exit;
        } else {
          Flasher::setFlash('Berita Acara', 'gagal', 'ditambahkan', 'danger');
          header('Location: ' . BASEURL . '/barang_masuk');
          exit;
        }
      }
      else {
        echo "<script type='text/javascript'>alert('Kuantitas Melibihi Order!');</script>";
      }
      }

      public function hapus($No_msk) {
        if ( $this->model('Barang_masuk_model')->hpsBcra($No_msk) > 0) {
            Flasher::setFlash('Berita Acara', 'berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/barang_masuk');
            exit;
        } else {
            Flasher::setFlash('Berita Acara', 'gagal', 'dhapus', 'danger');
            header('Location: ' . BASEURL . '/barang_masuk');
            exit;
        }
      }

      public function hapusDtl($No_msk) {
        if ( $this->model('Barang_masuk_model')->hpsDtlBcra($No_msk) > 0) {
            Flasher::setFlash('Berita Acara', 'berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/barang_masuk');
            exit;
        } else {
            Flasher::setFlash('Berita Acara', 'gagal', 'dhapus', 'danger');
            header('Location: ' . BASEURL . '/barang_masuk');
            exit;
        }
      }

      public function getInput() {
        echo json_encode($this->model('Barang_masuk_model')->getBrgMskInput($_POST['NO_PO']));
      }

      public function getUbahTmp() {
        echo json_encode($this->model('Barang_masuk_model')->getBrgMskTmp($_POST['NO_PO']));
      }

      public function getUbah() {
        echo json_encode($this->model('Barang_masuk_model')->getBrgMskUbah($_POST['No_msk']));
      }


      public function ubahDtl() {
        if ( $this->model('Barang_masuk_model')->ubahBrgMskDtl($_POST) > 0) {
          // $this->model('Barang_masuk_model')->ubahTrmPo($_POST);
            Flasher::setFlash('Berita Acara', 'berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/barang_masuk');
            exit;
        } else {
            Flasher::setFlash('Berita Acara', 'gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/barang_masuk');
            exit;
        }
      }

      public function ubahTmp() {
        if ( $this->model('Barang_masuk_model')->ubahBrgMskTmp($_POST) > 0) {
            Flasher::setFlash('Berita Acara', 'berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/barang_masuk');
            exit;
        } else {
            Flasher::setFlash('Berita Acara', 'gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/barang_masuk');
            exit;
        }
      }

      public function cari() {
        $data['barangMsk'] = $this->model('Barang_masuk_model')->cariData();

        $this->view('templates/header', $data);
        $this->view('barang_masuk/index', $data);
        $this->view('templates/footer');

      }

  }

 ?>
