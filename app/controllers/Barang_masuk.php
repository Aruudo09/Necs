<?php

  class Barang_masuk extends Controller {

      public function index($page) {
        $this->akses();
        if ( $_SESSION['login']['KODEF'] != 6 && $_SESSION['login']['KODEF'] != 7 && $_SESSION['login']['KODEF'] != 5 ) {
          header('Location: ' . BASEURL . '/not_found');
        } else {
          $cek = $_SERVER['REQUEST_URI'];
          if ( strpos($cek, '/barang_masuk/1/') ) {
            $_SESSION['cari'] = '';
          } else {
            if ( isset($_POST['srchbtn']) ) {
              $_SESSION['cari'] = $_POST['keyword'];
            } elseif ( empty($_SESSION['cari'])) {
              $_SESSION['cari'] = '';
            }
        }

          }

          $data['barangMsk'] = $this->model('Barang_masuk_model')->getAllBarangMsk($page);
          $data['bcraTmp'] = $this->model('Barang_masuk_model')->getDataBcraTmp();
          $data['po1'] = $this->model('Barang_masuk_model')->getAllDataPo();
          $data['sp'] = $this->model('Barang_masuk_model')->getOptionSpl();
          // $data['opsiBrg'] = $this->model('Barang_masuk_model')->getOptionBrg();
          $data['counter'] = $this->model('Barang_masuk_model')->counter_po();

          $this->view('templates/header', $data);
          $this->view('barang_masuk/index', $data);
          $this->view('templates/footer');
      }

      public function report($id) {
        $data['rptBa'] = $this->model('Barang_masuk_model')->getBcra(str_replace('F', '/', $id));
        $data['rptDtlBa'] = $this->model('Barang_masuk_model')->getDtlBcra(str_replace('F', '/', $id));

        $this->view('barang_masuk/report', $data);
      }

      public function detail($page) {

        $cek = $_SERVER['REQUEST_URI'];
        if ( strpos($cek, '/barang_masuk/detail/1/')) {
          $_SESSION['cari'] = '';
        } else {
          if ( isset($_POST['srchbtn'])) {
            $_SESSION['cari'] = $_POST['keyword'];
          } elseif ( empty($_SESSION['cari'])) {
            $_SESSION['cari'] = '';
          }
        }

        $data['po'] = $this->model('Barang_masuk_model')->getAllPoBcra($page);

        $this->view('templates/header');
        $this->view('barang_masuk/detail', $data);
        $this->view('templates/footer');
      }


      public function tambah() {
      if( $this->model('Barang_masuk_model')->cekOrder($_POST) == true) {
        if ( $this->model('Barang_masuk_model')->tambahBrgMskTmp($_POST) > 0 && $this->model('Barang_masuk_model')->tambahBrgMsk($_POST) == true && $this->model('Barang_masuk_model')->updateorder($_POST) == true ) {
            $this->model('Barang_masuk_model')->updateCounter();
            Flasher::setFlash('Berita Acara', 'berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/barang_masuk/1');
            exit;
        } else {
          Flasher::setFlash('Berita Acara', 'gagal', 'ditambahkan', 'danger');
          header('Location: ' . BASEURL . '/barang_masuk/1');
          exit;
        }
      }
      else {
        Flasher::setFlash('Kuantitas', 'Melebihi', 'Order', 'warning');
        header('Location: ' . BASEURL . '/barang_masuk/1');
        exit;
        }
      }

      public function hapus($data) {
        if ($this->model('Barang_masuk_model')->hpsBcra(str_replace('F', '/', $data)) > 0 ) {
          $this->model('Barang_masuk_model')->ubahStat(str_replace('F', '/', $data));
          Flasher::setFlash('Berita Acara', 'Berhasil', 'diubah', 'success');
          header('Location: ' . BASEURL . '/barang_masuk/1');
          exit;
        } else {
          Flasher::setFlash('Berita Acara', 'Gagal', 'diubah', 'danger');
          header('Location: ' . BASEURL . '/barang_masuk/1');
          exit;
        }

      }

      public function hapusDtl() {
        echo json_encode($this->model('Barang_masuk_model')->hpsDtlBcra($_POST));
      }

      public function optBrg() {
        echo json_encode($this->model('Barang_masuk_model')->getOptionBrg($_POST['opt']));
      }

      public function getInput() {
        echo json_encode($this->model('Barang_masuk_model')->getBrgMskInput($_POST['NO_PO']));
      }

      public function getUbah() {
        echo json_encode($this->model('Barang_masuk_model')->getBrgMsk($_POST));
      }

      public function getUbahTmp() {
        echo json_encode($this->model('Barang_masuk_model')->getBrgMskUbah($_POST));
      }


      public function ubahDtl() {
        if ( $this->model('Barang_masuk_model')->ubahBrgMskDtl($_POST) == true ) {
            Flasher::setFlash('Berita Acara', 'berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/barang_masuk/1');
            exit;
        } else {
            Flasher::setFlash('Berita Acara', 'gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/barang_masuk/1');
            exit;
        }
      }

      public function ubahTmp() {
        if ( $this->model('Barang_masuk_model')->ubahBrgMskTmp($_POST) > 0) {
            Flasher::setFlash('Berita Acara', 'berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/barang_masuk/1');
            exit;
        } else {
            Flasher::setFlash('Berita Acara', 'gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/barang_masuk/1');
            exit;
        }
      }

  }

 ?>
