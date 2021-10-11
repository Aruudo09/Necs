  <div id="page-content-wrapper">
      <div class="container-fluid row my-5">

            <div class="row">
               <div class="col-lg-6">
                  <?php FLASHER::flash(); ?>
               </div>
            </div>

            <div class="row mb-3">
              <div class="col-lg-6">
                <button type="button" class="btn btn-primary" id="tambahData" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                </button>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-6">
                <form class="" action="<?php echo BASEURL; ?>/purchased_order/cari" method="post">
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="cari data.." name="keyword" id="keyword" autocomplete="off" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="tombolCari">Cari</button>
                  </div>
                </form>
              </div>
            </div>

            <div class="row">
                  <div class="col-sm">
                          <h3>DAFTAR PURCHASED ORDER</h3>
                    <table class="table text-center table-hover">
                          <thead>
                            <tr class="table-warning ">
                              <th scope="col">No.</th>
                              <th scope="col">No. PO</th>
                              <th scope="col">Tanggal Dibuat</th>
                              <th scope="col">Pemesan</th>
                              <th scope="col">Tanggal Update</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach( $data['po'] as $mhs ) : ?>
                            <tr>
                              <th scope="row">1</th>
                              <td><?php echo $mhs['No_po']; ?></td>
                              <td><?php echo $mhs['Tanggal_keluar']; ?></td>
                              <td><?php echo $mhs['Pemesan']; ?></td>
                              <td><?php echo $mhs['Tanggal_update']; ?></td>
                        <!--TOMBOL DETAIL-->
                              <td><a href="<?php echo BASEURL; ?>/purchased_order/detail/<?php echo $mhs['No_po']; ?>"
                                class="badge rounded-pill bg-info">Detail</td>
                        <!--TOMBOL UPDATE-->
                              <td><a href="<?php echo BASEURL; ?>/purchased_order/update/<?php echo $mhs['No_po']; ?>"
                                class="badge rounded-pill bg-primary tampilModalUpdate" id="tampilModalUpdate" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-id="<?php echo $mhs['No_po']; ?>">Update</td>
                        <!--TOMBOL HAPUS-->
                              <td><a href="<?php echo BASEURL; ?>/purchased_order/hapus/<?php echo $mhs['No_po']; ?>"
                                class="badge rounded-pill bg-danger" onclick="return confirm('apa anda yakin?');">Hapus</td>
                            </tr>
                            <?php endforeach; ?>
                          </tbody>
                      </table>
                  </div>
              </div>

              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1" class="formLabel" >Tambah Data Purchased Order</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo BASEURL; ?>/purchased_order/tambah" method="post">
                          <!--HIDDEN INPUT-->
                              <input type="hidden" name="No_po" id="No_po" value="">
                          <!--TANGGAL INPUT-->
                              <div class="mb-3">
                                  <label for="Tanggal_keluar" class="form-label">Tanggal :</label>
                                  <input type="date" class="form-control" id="Tanggal_keluar" name="Tanggal_keluar">
                              </div>
                          <!--PEMESAN INPUT-->
                              <div class="mb-3">
                                  <label for="Pemesan" class="form-label">Pemesan :</label>
                                  <input type="text" class="form-control" id="Pemesan" name="Pemesan">
                              </div>

                              <div class="mb-3">
                                  <label for="Tanggal_update" class="form-label">Tanggal Update :</label>
                                  <input type="date" class="form-control" id="Tanggal_update" name="Tanggal_update">
                              </div>

                          </div>


                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
