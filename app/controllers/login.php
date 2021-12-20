<?php

  class login extends Controller {

    public function index() {
      $this->view('login/index');
    }

    public function cek() {
      if ($this->model('login_model')->cek($_POST) == true) {
        //CEK SESSION
        $_SESSION["login"] = [
          'status' => true,
          'USERNAME' => $this->model('login_model')->username($_POST),
          'KODEF' => $this->model('login_model')->kodef($_POST),
          'Initial' => $this->model('login_model')->initial($_POST),
          'NMDEF' => $this->model('login_model')->nmdef($_POST),
          'LEVEL' => $this->model('login_model')->level($_POST)
        ];
        header('Location: ' . BASEURL . '/home');
        exit;
      } else {
        Flasher::setFlash('Anda', 'Gagal', 'Login', 'warning');
        header('Location: ' . BASEURL . '/login');
        exit;
      }
    }

    public function logout() {
      $_SESSION = [];
      session_unset();
      session_destroy();

      header('Location: ' . BASEURL . '/login');
      exit;
    }
  }

 ?>
