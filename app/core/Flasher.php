<?php

  class Flasher {

    public static function setFlash($judul, $pesan, $aksi, $tipe){
      $_SESSION['flash'] = [
        'judul' => $judul,
        'pesan' => $pesan,
        'aksi' => $aksi,
        'tipe' => $tipe
      ];

    }

    public static function flash() {

      if ( isset($_SESSION['flash']) ) {
          echo '<div class="alert alert-' .$_SESSION['flash']['tipe']. ' alert-dismissible fade show" role="alert">
                  '.$_SESSION['flash']['judul'].'<strong> ' .$_SESSION['flash']['pesan']. '</strong> ' .$_SESSION['flash']['aksi']. '
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';

          unset($_SESSION['flash']);
      }
    }
  }

 ?>
