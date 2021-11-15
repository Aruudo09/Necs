<?php

class Controller {

      public function akses() {
        if ( !isset($_SESSION["login"])) {
          header('Location: ' . BASEURL . '/login');
          exit;
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
