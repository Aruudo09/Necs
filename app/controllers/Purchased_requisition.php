<?php

  class Purchased_requisition extends Controller {

    public function index($page) {

      $cek = $_SERVER['REQUEST_URI'];
      if ( strpos($cek, '/purchased_requisition/1/') ) {
        $_SESSION['cari'] = '';
      } else {
        if ( isset($_POST['srchBtn']) ) {
          $_SESSION['cari'] = $_POST['keyword'];
        } elseif (empty($_SESSION['cari'])) {
          $_SESSION['cari'] = '';
        }
      }

      $data['selectSr'] = $this->model('Purchased_requisition_model')->getSr();
      $data['sr'] = $this->model('Purchased_requisition_model')->getAllSr($page);

      $this->akses();
      $this->view('templates/header', $data);
      $this->view('purchased_requisition/index', $data);
      $this->view('templates/footer');
    }

    public function detail($page) {

      $cek = $_SERVER['REQUEST_URI'];
      if ( strpos($cek, '/purchased_requisition/detail/1/') ) {
        $_SESSION['cari'] = '';
      } else {
        if ( isset($_POST['srchbtn']) ) {
          $_SESSION['cari'] = $_POST['keyword'];
        } elseif ( empty($_SESSION['cari']) ) {
          $_SESSION['cari'] = '';
        }
      }
      $data['pr'] = $this->model('Purchased_requisition_model')->getPr($page);

      $this->akses();
      $this->view('templates/header', $data);
      $this->view('purchased_requisition/detail', $data);
      $this->view('templates/footer');
    }

    public function tambah() {
      if ( $this->model('Purchased_requisition_model')->tambah($_POST) > 0 && $this->model('Purchased_requisition_model')->tambahpr($_POST) > 0) {
        Flasher::setFlash('Purchased Requisition', 'berhasil', 'ditambahkan', 'success');
        header('Location: ' . BASEURL . '/purchased_requisition/1');
        unset($_SESSION['cari']);
        exit;
      } else {
        Flasher::setFlash('Purchased Requisition', 'Gagal', 'ditambahkan', 'warning');
        header('Location: ' . BASEURL . '/purchased_requisition/1');
        unset($_SESSION['cari']);
        exit;
      }
    }

    public function hapus($data) {
        if ( $this->model('Purchased_requisition_model')->hapus(str_replace('-F', '/', $data)) > 0 ) {
          Flasher::setFlash('Purchased Requisition', 'berhasil', 'dihapus', 'success');
          header('Location: ' . BASEURL . '/purchased_requisition/detail/1');
          unset($_SESSION['cari']);
          exit;
        } else {
          Flasher::setFlash('Purchased Requisition', 'gagal', 'dihapus', 'danger');
          header('Location: ' . BASEURL . '/purchased_requisition/detail/1');
          unset($_SESSION['cari']);
          exit;
        }
    }

    public function getSr() {
      echo json_encode($this->model('Purchased_requisition_model')->getAllSr($_POST));
    }

    public function setPr() {
      echo json_encode($this->model('Purchased_requisition_model')->setPr($_POST));
    }

    public function dtlSr() {
      echo json_encode($this->model('Purchased_requisition_model')->getDtlSr($_POST));
    }

    public function supplier() {
      echo json_encode($this->model('Purchased_requisition_model')->getSp($_POST));
    }

    public function getDtlPr() {
      echo json_encode($this->model('Purchased_requisition_model')->getDtlPr($_POST));
    }

  }

 ?>
