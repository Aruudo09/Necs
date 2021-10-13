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

      public function tambah() {
        var_dump($_POST);
        if ( $this->model('Barang_model')->tambahBrg($_POST) > 0) {
          Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/Barang');
            exit;
        } else {
          Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/Barang');
            exit;
        }
      }

      public function hapus($Kode_brg) {
        // var_dump($Kode_brg);
        if ( $this->model('Barang_model')->hapusDataBrg($Kode_brg) > 0) {
          Flasher::setFlash('berhasil', 'dihapus', 'success');
          header('Location: ' . BASEURL . '/Barang');
          exit;
        } else {
          Flasher::setFlash('gagal', 'dihapus', 'danger');
          header('Location: ' . BASEURL . '/Barang');
          exit;
        }
      }

      public function getUbah() {
        echo json_encode($this->model('Barang_model')->getBrgUbah($_POST['Kode_brg']));

      }

    }
 ?>
