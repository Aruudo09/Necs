<div class="container-fluid px-4">

    <!--FLASHER-->
    <div class="row">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>

    <!--DATA KELUAR BARANG-->
    <!-- Button trigger modal -->
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="data-barang">
      <div class="row mb-3 mt-4">
        <div class="col-lg-6">
          <button type="button" class="btn btn-primary" id="tambahBrgKlr" data-bs-toggle="modal" data-bs-target="#modalBrgKlr">
              Input Data Barang Keluar
          </button>
        </div>
      </div>

   <!-- Modal -->
          <div class="modal fade" id="modalBrgKlr" tabindex="-1" role="dialog" aria-labelledby="modalBrgKlr" aria-hidden="true">
          <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Barang Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="" action="<?php echo BASEURL; ?>/Barang_keluar/tambah" method="post">
                    <div class="row mb-3">
                        <div class="form-group">
                            <label for="inputNoPk">No Pemakaian :</label>
                            <input type="number" name="inputNoPk" id="inputNoPk" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group">
                            <label for="inputPk">Penginput :</label>
                            <input type="text" name="inputPk" id="inputPk" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group">
                            <label for="userId">User ID :</label>
                            <input type="text" name="userId" id="userId" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col">
                            <label for="tanggalKeluar">Tanggal Keluar :</label>
                            <input type="date" name="tanggalKeluar" id="tanggalKeluar" class="form-control">
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
        <h3 class="fs-4 mb-3">Daftar Barang Keluar</h3>
            <table class="table table-hover text-center">
              <thead>
                <tr>
                  <th scope="col">No Pemakaian</th>
                  <th scope="col">Penginput</th>
                  <th scope="col">User ID</th>
                  <th scope="col">Tanggal Keluar</th>
                  <th scope="col">Keterangan</th>
                  <th scope="col">Fitur</th>
                </tr>
             </thead>
             <tbody>
                <?php foreach ($data['barangKlr'] as $brgK) : ?>
                <tr>
                  <td><?php echo $brgK['No_pakai']; ?></td>
                  <td><?php echo $brgK['User']; ?></td>
                  <td><?php echo $brgK['USER_ID']; ?></td>
                  <td><?php echo $brgK['Tanggal_out']; ?></td>
                  <td><?php echo $brgK['Keterangan']; ?></td>
                  <td scope="row">
                      <a href="<?php echo BASEURL; ?>/Barang_keluar/detail" class="btn btn-success">Detail</a>
                      <a href="<?php echo BASEURL; ?>/Barang_keluar/hapus/<?php echo $brgK['No_pakai']; ?>" class="btn btn-danger" onclick="return confirm('apa anda yakin?')">Hapus</a>
                      <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="modalBrgKlr" data-id="<?php echo $brgK['No_pakai']; ?>">Edit</a>
                  </td>
                </tr>
                <?php endforeach; ?>
             </tbody>
            </table>
      <!--VIEW TABLE MASUK BARANG-->

  </div>
</div>
