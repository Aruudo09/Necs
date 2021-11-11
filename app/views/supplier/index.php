<div class="container-fluid px-4">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>

<div class="border border-dark rounded-3 bg-gradient mt-3 p-3">
  <!-- Button trigger modal -->
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="data-barang">
  <div class="row mb-3 mt-2">
    <div class="col-lg-6">
      <button type="button" class="btn btn-primary" id="tambahSpl" data-bs-toggle="modal" data-bs-target="#modalSpl">
          Input Data Supplier
      </button>
    </div>
  </div>


  <!--TABLE VIEW SUPPLIER-->
  <h3 class="fs-4 mb-3">Daftar Supplier</h3>
    <div class="border border-dark rounded-3 bg-white mt-3 p-3">
      <div class="overflow-auto">
          <table class="table table-hover text-center" id="tbSp">
              <thead>
                <tr>
                  <th class="col">Supplier</th>
                  <th class="col">No Telp</th>
                  <th class="col">Email</th>
                  <th class="col">Contact Person</th>
                  <th class="col">NPWP</th>
                  <th class="col">Tanggal Input</th>
                  <th class="col">Tanggal Update</th>
                  <th class="col">Qty Bulan</th>
                  <th class="col" style="width:100%">Alamat</th>
                  <th class="col">Fitur</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ( $data['supplier'] as $spl) : ?>
                <tr>
                  <td><?php echo $spl['NAMA_SP']; ?></td>
                  <td><?php echo $spl['TELEPON']; ?></td>
                  <td><?php echo $spl['email']; ?></td>
                  <td><?php echo $spl['HUBUNGAN']; ?></td>
                  <td><?php echo $spl['npwp']; ?></td>
                  <td><?php echo $spl['Tanggal_input']; ?></td>
                  <td><?php echo $spl['Tanggal_update']; ?></td>
                  <td><?php echo $spl['quantity_perbulan']; ?></td>
                  <td><?php echo $spl['ALAMAT_SP']; ?></td>
                  <td class="">
                    <!--HAPUS SUPPLIER-->
                      <a href="<?php echo BASEURL; ?>/Supplier/hapus/<?php echo $spl['KODE_SP']; ?>" class="btn btn-danger" onclick="return confirm('apa anda yakin?')"><i class="fa fa-trash"></i></a>
                    <!--EDIT SUPPLIER-->
                      <a href="<?php echo BASEURL; ?>/Supplier/ubah" class="btn btn-success editSpl" data-bs-toggle="modal" data-bs-target="#modalSpl" data-id="<?php echo $spl['KODE_SP']; ?>"><i class="fa fa-pen"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
      </div>
    </div>
  </div>

      <!-- Modal -->
            <div class="modal fade" id="modalSpl" tabindex="-1" role="dialog" aria-labelledby="modalSpl" aria-hidden="true">
            <div class="modal-dialog" >
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabelSpl">Input Supplier</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form class="" action="<?php echo BASEURL; ?>/Supplier/tambah" method="post">
                  <!--HIDDEN INPUT NOMOR SUPPLIER-->
                    <input type="hidden" name="No_spl" id="No_spl" value="">
                    <!--INPUT NOMOR SUPPLIER-->
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="inputNoSpl">No Supplier :</label>
                              <input type="number" name="inputNoSpl" id="inputNoSpl" class="form-control" >
                          </div>
                      </div>
                    <!--INPUT NAMA SUPPLIER-->
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="inputNmSpl">Nama Supplier :</label>
                              <input type="text" name="inputNmSpl" id="inputNmSpl" class="form-control" required>
                          </div>
                      </div>
                    <!--INPUT ALAMAT SUPPLIER-->
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="alamatSpl">Alamat Supplier :</label>
                              <textarea name="alamatSpl" id="alamatSpl" rows="8" cols="60"></textarea>
                          </div>
                      </div>
                    <!--INPUT TELEPON SUPPLIER-->
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="telepon">No Telepon :</label>
                              <input type="text" name="telepon" id="telepon" class="form-control">
                          </div>
                      </div>
                    <!--INPUT EMAIL SUPPLIER-->
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="email">Email :</label>
                              <input type="email" name="email" id="email" class="form-control">
                          </div>
                      </div>
                    <!--INPUT CONTACT PERSON SUPPLIER-->
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="hubungan">Nama :</label>
                              <input type="text" name="hubungan" id="hubungan" class="form-control">
                          </div>
                      </div>
                    <!--INPUT NPWP-->
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="npwp">NPWP :</label>
                              <input type="text" name="npwp" id="npwp" class="form-control">
                          </div>
                      </div>
                    <!--INPUT TANGGAL INPUT-->
                      <div class="row mb-3">
                          <div class="form-group col">
                              <label for="tanggalInput">Tanggal Input :</label>
                              <input type="date" name="tanggalInput" id="tanggalInput" class="form-control">
                          </div>
                      </div>
                    <!--INPUT TANGGAL UPDATE-->
                      <div class="row mb-3">
                          <div class="form-group col">
                              <label for="tanggalUpdate">Tanggal Update :</label>
                              <input type="date" name="tanggalUpdate" id="tanggalUpdate" class="form-control">
                          </div>
                      </div>
                    <!--INPUT QUANTITY-->
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="qtyBln">Quantity :</label>
                              <input type="text" name="qtyBln" id="qtyBln" class="form-control">
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

</div>
