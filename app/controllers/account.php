<?php

  class account extends Controller {

    public function index() {

      if ( $_SESSION['login']['LEVEL'] != 'admin' ) {
        header('Location: ' . BASEURL . '/not_found');
        exit;
      } else {
        $data['dept'] = $this->model('account_model')->getDept();

        $this->akses();
        $this->view('templates/header');
        $this->view('account/index', $data);
        $this->view('templates/footer');
      }

    }

    public function detail($page) {

      if ( $_SESSION['login']['LEVEL'] != 'admin') {
        header('Location: ' . BASEURL . '/not_found');
        exit;
      } else {
        if ( isset($_POST['srchbtn'])) {
          $_SESSION['cari'] = $_POST['keyword'];
        } elseif ( empty($_SESSION['cari'])) {
          $_SESSION['cari'] = '';
        }

        $data['usr'] = $this->model('account_model')->getUser($page);
        $data['dept'] = $this->model('account_model')->getDept();

        $this->akses();
        $this->view('templates/header');
        $this->view('account/detail', $data);
        $this->view('templates/footer');
      }

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

    //----------EDIT ACCOUNT----------//
    public function edit() {
      if ( $this->model('account_model')->edit($_POST) > 0 ) {
        Flasher::setFlash('Account', 'Berhasil', 'Diubah', 'success');
        header('Location: ' . BASEURL . '/account/detail/1');
        exit;
      } else {
        Flasher::setFlash('Account', 'Gagal', 'Ditambahkan', 'danger');
        header('Location: ' . BASEURL . '/account/detail/1');
        exit;
      }
    }

    public function getDtl() {
      echo json_encode($this->model('account_model')->getDtl($_POST));
    }

  }

 ?>
