<?php

  class Barang_masuk extends Controller {

      public function index() {
          $data['barangMsk'] = $this->model('Barang_masuk_model')->getAllBarangMsk();
          $this->view('templates/header', $data);
          $this->view('barang_masuk/index', $data);
          $this->view('templates/footer');
      }

  }

 ?>
