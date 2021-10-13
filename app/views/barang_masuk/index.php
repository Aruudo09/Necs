<div class="container-fluid px-4">

  <!--FLASHER-->
    <div class="row">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>

  <!--DATA MASUK BARANG-->
  <!-- Button trigger modal -->
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="data-barang">
    <div class="row mb-3 mt-4">
      <div class="col-lg-6">
        <button type="button" class="btn btn-primary" id="tambahBrgMsk" data-bs-toggle="modal" data-bs-target="#modalBrgMsk">
            Input Data Barang Masuk
        </button>
      </div>
    </div>

 <!-- Modal -->
        <div class="modal fade" id="modalBrgMsk" tabindex="-1" role="dialog" aria-labelledby="modalBrgMsk" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabelBrgMsk">Input Barang Masuk</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="" action="<?php echo BASEURL; ?>/barang_masuk/tambah" method="post">
                <input type="hidden" name="No_msk" id="No_msk" value="">
                  <div class="row mb-3">
                      <div class="form-group">
                          <label for="inputNoMsk">No Masuk :</label>
                          <input type="number" name="inputNoMsk" id="inputNoMsk" class="form-control">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="form-group">
                          <label for="inputPnr">Penerima :</label>
                          <input type="text" name="inputPnr" id="inputPnr" class="form-control">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="form-group">
                          <label for="inputPng">Pengirim :</label>
                          <input type="text" name="inputPng" id="inputPng" class="form-control">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="form-group col">
                          <label for="totHrg">Total Harga :</label>
                          <input type="number" name="totHrg" id="totHrg" class="form-control">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="form-group col">
                          <label for="tanggalMasuk">Tanggal Masuk :</label>
                          <input type="date" name="tanggalMasuk" id="tanggalMasuk" class="form-control">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="form-group">
                          <label for="keterangan">Keterangan :</label>
                          <input type="text" name="keterangan" id="keterangan" class="form-control">
                      </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
          </div>
        </div>
        </div>

    <!--VIEW TABLE MASUK BARANG-->
      <h3 class="fs-4 mb-3">Daftar Barang Masuk</h3>
          <table class="table table-hover text-center">
            <thead>
              <tr>
                <th scope="col">No Masuk</th>
                <th scope="col">Penerima</th>
                <th scope="col">Pengirim</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Fitur</th>
              </tr>
           </thead>

           <tbody>
             <?php foreach ( $data['barangMsk'] as $brgM) : ?>
                <tr>
                  <td><?php echo $brgM['No_msk']; ?></td>
                  <td><?php echo $brgM['Pihak_satu']; ?></td>
                  <td><?php echo $brgM['Pihak_dua']; ?></td>
                  <td><?php echo $brgM['Total_harga']; ?></td>
                  <td><?php echo $brgM['Tanggal_msk']; ?></td>
                  <td><?php echo $brgM['Keterangan']; ?></td>
                  <td>
                      <a href="<?php echo BASEURL; ?>/barang_masuk/detail" class="btn btn-primary">Detail</a>
                      <a href="<?php echo BASEURL; ?>/barang_masuk/hapus/<?php echo $brgM['No_msk']; ?>" class="btn btn-danger" onclick="return confirm('apa anda yakin?')">Hapus</a>
                      <a href="<?php echo BASEURL; ?>/barang_masuk/ubah" class="btn btn-warning btnUpdateBrgMsk" data-bs-toggle="modal" data-bs-target="#modalBrgMsk" data-id="<?php echo $brgM['No_msk']; ?>">Edit</a>
                  </td>
                </tr>
             <?php endforeach; ?>
           </tbody>
          </table>
    <!--VIEW TABLE MASUK BARANG-->

</div>
</div>
