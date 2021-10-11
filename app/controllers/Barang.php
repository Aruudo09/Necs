<?php
    class Barang extends Controller {

      public function index() {
        $data['judul'] = 'Daftar Barang';
        $data['barang'] = $this->model('Barang_model')->getAllBarang();
        $data['optionSpl'] = $this->model('Barang_model')->getOptionSpl();

        $this->view('templates/header', $data);
        $this->view('barang/index', $data);
        $this->view('templates/footer');
      }

      

    }
 ?>
