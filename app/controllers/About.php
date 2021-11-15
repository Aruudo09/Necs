<?php
class About extends Controller {

  public function index($nama = 'Aldo', $pekerjaan = 'Mahasiswa', $umur = '21') {
    // echo "Halo. nama saya $nama, saya adalah seorang $pekerjaan";
    $data['nama'] = $nama;
    $data['pekerjaan'] = $pekerjaan;
    $data['umur'] = $umur;
    $data['judul'] = 'About Me';

    $this->akses();
    $this->view('templates/header', $data);
    $this->view('about/index', $data);
    $this->view('templates/footer');
  }

  public function page() {
    // echo "About/page";
    $data['judul'] = 'My Page';
    $this->view('templates/header', $data);
    $this->view('about/page');
    $this->view('templates/footer');
  }
}
 ?>
