<?php

  class Barang_keluar extends Controller {

      public function index() {
        $data['judul'] = 'Daftar Barang Keluar';
        $data['barangKlr'] = $this->model('Barang_keluar_model')->getAllBarangKlr();
        $this->view('templates/header', $data);
        $this->view('barang_keluar/index', $data);
        $this->view('templates/footer');
      }
  }

 ?>
