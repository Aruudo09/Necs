<?php

  class Purchased_order extends Controller {

    public function index() {
      $data['pr'] = $this->model('Purchased_order_model')->getPr();
      $data['counter'] = $this->model('Purchased_order_model')->getCounter();

      $this->view('templates/header', $data);
      $this->view('purchased_order/index', $data);
      $this->view('templates/footer');
    }

    public function detail() {
      $data['po'] = $this->model('Purchased_order_model')->getAllPo();

      $this->view('templates/header', $data);
      $this->view('purchased_order/detail', $data);
      $this->view('templates/footer');
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

    public function hapus() {
      $this->model('Purchased_order_model')->hapus($_POST);
    }

  }

 ?>
