<?php

  class login extends Controller {

    public function index() {
      $this->view('login/index');
    }

    public function cek() {
      if ($this->model('login_model')->cek($_POST) == true) {
        //CEK SESSION
        $_SESSION["login"] = true;

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
