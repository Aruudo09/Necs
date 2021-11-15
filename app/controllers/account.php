<?php

  class account extends Controller {

    public function index() {
      $this->akses();
      $this->view('templates/header');
      $this->view('account/index');
      $this->view('templates/footer');
    }

    //-------MENAMBAHKAN AKUN BARU------//
    public function tambah() {
      if ($this->model('account_model')->cek($_POST) == false) {
        Flasher::setFlash('Account', 'Sudah', 'Terdaftar', 'warning');
        header('Location: ' . BASEURL . '/account');
        exit;
      } else {
        if ($this->model('account_model')->tambah($_POST) > 0) {
          var_dump("hello world");
          Flasher::setFlash('Account', 'Berhasil', 'Ditambahkan', 'success');
          header('Location: ' . BASEURL . '/account');
          exit;
        } else {
          Flasher::setFlash('Account', 'Gagal', 'Ditambahkan', 'danger');
          header('Location: ' . BASEURL . '/account');
          exit;
        }
      }
    }

  }

 ?>
