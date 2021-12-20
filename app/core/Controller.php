<?php

class Controller {

      public function akses() {
        if ( !isset($_SESSION["login"]['status'])) {
          header('Location: ' . BASEURL . '/login');
          exit;
        }
        else {
          $_SESSION['login']['USERNAME'];
          $_SESSION['login']['KODEF'];
          $_SESSION['login']['Initial'];
          $_SESSION['login']['NMDEF'];
          $_SESSION['login']['LEVEL'];
        }
      }

      public function view($view, $data = [] ) {
        require_once '../app/views/' . $view . '.php';
      }

      public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model;
      }

}


 ?>
