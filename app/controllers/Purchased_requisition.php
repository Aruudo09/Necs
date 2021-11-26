<?php

  class Purchased_requisition extends Controller {

    public function index() {
      $data['selectSr'] = $this->model('Purchased_requisition_model')->getSr();
      $data['sr'] = $this->model('Purchased_requisition_model')->getAllSr();

      $this->akses();
      $this->view('templates/header', $data);
      $this->view('purchased_requisition/index', $data);
      $this->view('templates/footer');
    }

    public function detail() {
      $data['pr'] = $this->model('Purchased_requisition_model')->getPr();

      $this->akses();
      $this->view('templates/header', $data);
      $this->view('purchased_requisition/detail', $data);
      $this->view('templates/footer');
    }

    public function tambah() {
      if ( $this->model('Purchased_requisition_model')->tambah($_POST) > 0 && $this->model('Purchased_requisition_model')->tambahpr($_POST) > 0) {
        Flasher::setFlash('Purchased Requisition', 'berhasil', 'ditambahkan', 'success');
        header('Location: ' . BASEURL . '/purchased_requisition');
        exit;
      } else {
        Flasher::setFlash('Purchased Requisition', 'Gagal', 'ditambahkan', 'warning');
        header('Location: ' . BASEURL . '/purchased_requisition');
        exit;
      }
    }

    public function hapus() {
        $this->model('Purchased_requisition_model')->hapus($_POST);
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

  }

 ?>
