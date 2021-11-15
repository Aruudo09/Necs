<?php
    class Barang extends Controller {

      public function index() {
        $data['judul'] = 'Daftar Barang';
        $data['barang'] = $this->model('Barang_model')->getAllBarang();
        $data['optionSpl'] = $this->model('Barang_model')->getOptionSpl();
        $data['optBrg'] = $this->model('Barang_model')->getOptBrg();
        $data['ckBrg'] = $this->model('Barang_model')->statsBrg();

        $this->view('templates/header', $data);
        $this->view('barang/index', $data);
        $this->view('templates/footer');
      }

      public function tambah() {
        var_dump($_POST);
        if ( $this->model('Barang_model')->tambahBrg($_POST) > 0) {
          Flasher::setFlash('Barang', 'berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/barang');
            exit;
        } else {
          Flasher::setFlash('Barang', 'gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/barang');
            exit;
        }
      }

      public function hapus($Kode_brg) {
        // var_dump($Kode_brg);
        if ( $this->model('Barang_model')->hapusDataBrg($Kode_brg) > 0) {
          Flasher::setFlash('Barang', 'berhasil', 'dihapus', 'success');
          header('Location: ' . BASEURL . '/barang');
          exit;
        } else {
          Flasher::setFlash('Barang', 'gagal', 'dihapus', 'danger');
          header('Location: ' . BASEURL . '/barang');
          exit;
        }
      }

      public function getUbah() {
        echo json_encode($this->model('Barang_model')->getBrgUbah($_POST['Kode_brg']));
      }

      public function barang() {
        echo json_encode($data['barang'] = $this->model('Barang_model')->getAllBarang($_POST));
      }

      public function ubah() {
        if ( $this->model('Barang_model')->ubahBrg($_POST) > 0) {
            Flasher::setFlash('Barang', 'berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/barang');
            exit;
        } else {
          Flasher::setFlash('Barang', 'gagal', 'diubah', 'danger');
          header('Location: ' . BASEURL . '/barang');
          exit;
        }
      }

      public function cari() {
        $data['judul'] = 'Daftar Mahasiswa';
        $data['barang'] = $this->model('Barang_model')->cariData();
        $this->view('templates/header', $data);
        $this->view('barang/index', $data);
        $this->view('templates/footer');
      }

    }
 ?>
