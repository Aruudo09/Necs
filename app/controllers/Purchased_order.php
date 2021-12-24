<?php

  class Purchased_order extends Controller {

    public function index() {

      if ( $_SESSION['login']['KODEF'] != 10) {
        header('Location:' . BASEURL . '/not_found');
        exit;
      } else {
        $data['pr'] = $this->model('Purchased_order_model')->getPr();
        $data['sp'] = $this->model('Purchased_order_model')->getSp();
        $data['counter'] = $this->model('Purchased_order_model')->getCounter();

        $this->akses();
        $this->view('templates/header', $data);
        $this->view('purchased_order/index', $data);
        $this->view('templates/footer');
      }
    }

    public function detail($page) {

      $cek = $_SERVER['REQUEST_URI'];
      if ( strpos($cek, '/purchased_order/detail/1/')) {
        $_SESSION['cari'] = '';
      } else {
        if ( isset($_POST['srchbtn'])) {
          $_SESSION['cari'] = $_POST['keyword'];
        } elseif ( empty($_SESSION['cari']) ) {
          $_SESSION['cari'] = '';
        }
      }

      $data['po'] = $this->model('Purchased_order_model')->getAllPo($page);

      $this->akses();
      $this->view('templates/header', $data);
      $this->view('purchased_order/detail', $data);
      $this->view('templates/footer');
    }

    public function report($id) {
      $data['report'] = $this->model('Purchased_order_model')->getReport(str_replace('F', '/', $id));
      $data['dtlReport'] = $this->model('Purchased_order_model')->getDtlRpt(str_replace('F', '/', $id));

      $this->view('purchased_order/report', $data);
    }

    public function getSp() {
      echo json_encode($this->model('Purchased_order_model')->getSp($_POST));
    }

    public function getBrg() {
      echo json_encode($this->model('Purchased_order_model')->getBrg($_POST));
    }

    public function getPo() {
      echo json_encode($this->model('Purchased_order_model')->getPo($_POST));
    }

    public function getDtl() {
      echo json_encode($this->model('Purchased_order_model')->getDtl($_POST));
    }

    public function tambah() {
      if ( $this->model('Purchased_order_model')->tmbhPo($_POST) > 0 && $this->model('Purchased_order_model')->tmbhDtl($_POST) == true) {
        $this->model('Purchased_order_model')->setPo($_POST);
        $this->model('Purchased_order_model')->updtCnt($_POST);
        Flasher::setFlash('Purchased Order', 'Berhasil', 'ditambahkan' , 'success');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
      } else {
        Flasher::setFlash('Purchased Order', 'Gagal', 'ditambahkan', 'danger');
        header('Location: ' . BASEURL . '/purchased_order');
        exit;
      }
    }

    public function ubah() {
      if ($this->model('Purchased_order_model')->ubah($_POST) > 0 ) {
        Flasher::setFlash('Purchased Order', 'Berhasil', 'diubah', 'success');
        header('Location: ' . BASEURL . '/purchased_order/detail/1');
        exit;
      } else {
        Flasher::setFlash('Purchased Order', 'Gagal', 'diubah', 'danger');
        header('Location: ' . BASEURL . '/purchased_order/detail/1');
        exit;
      }
    }

    public function ubahDtl() {
      if ($this->model('Purchased_order_model')->ubahDtl($_POST) == true ) {
        Flasher::setFlash('Purchased order', 'Berhasil', 'diubah', 'success');
        header('Location: ' . BASEURL . '/purchased_order/detail/1');
        exit;
      } else {
        Flasher::setFlash('Purchased Order', 'Gagal', 'diubah' , 'danger');
        header('Location: ' . BASEURL . '/purchased_order/detail/1');
        exit;
      }
    }

    public function hapus($data) {
      if ($this->model('Purchased_order_model')->hapus(str_replace('-F', '/', $data)) > 0 ) {
        Flasher::setFlash('Purchased Order', 'Berhasil', 'Dihapus', 'success');
        header('Location: ' .  bASEURL . '/purchased_order/detail/1');
        exit;
      } else {
        Flasher::setFlash('Purchased Order', 'Gagal', 'Dihapus', 'danger');
        header('Location: ' . BASEURL . '/purchased_order/detail/1');
        exit;
      }
    }

  }

 ?>
