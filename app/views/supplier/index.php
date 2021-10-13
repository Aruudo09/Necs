<div class="container-fluid px-4">

  <!--FLASHER-->
    <div class="row">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>

  <!-- Button trigger modal -->
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="data-barang">
  <div class="row mb-3 mt-4">
    <div class="col-lg-6">
      <button type="button" class="btn btn-primary" id="tambahSpl" data-bs-toggle="modal" data-bs-target="#modalSpl">
          Input Data Supplier
      </button>
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
                  <div class="row mb-3">
                      <div class="form-group">
                          <label for="inputNoSpl">No Supplier :</label>
                          <input type="number" name="inputNoSpl" id="inputNoSpl" class="form-control">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="form-group">
                          <label for="inputNmSpl">Nama Supplier :</label>
                          <input type="text" name="inputNmSpl" id="inputNmSpl" class="form-control">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="form-group">
                          <label for="alamatSpl">Alamat Supplier :</label>
                          <textarea name="alamatSpl" id="alamatSpl" rows="8" cols="60"></textarea>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="form-group col">
                          <label for="tanggalInput">Tanggal Input :</label>
                          <input type="date" name="tanggalInput" id="tanggalInput" class="form-control">
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

        
  <!--TABLE VIEW SUPPLIER-->
    <h3 class="fs-4 mb-3">Daftar Supplier</h3>
      <div class="table_wrapper">
          <table class="table table-hover text-center">
              <thead>
                <tr>
                  <th scope="col">No Supplier</th>
                  <th scope="col">Nama Supplier</th>
                  <th scope="col">Alamat Supplier</th>
                  <th scope="col">Tanggal Input</th>
                  <th scope="col">Tanggal Update</th>
                  <th scope="col">Keterangan</th>
                  <th scope="col">Fitur</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ( $data['supplier'] as $spl) : ?>
                <tr>
                  <td><?php echo $spl['No_supplier']; ?></td>
                  <td><?php echo $spl['Nama_spl']; ?></td>
                  <td><?php echo $spl['Alamat_spl']; ?></td>
                  <td><?php echo $spl['Tanggal_input']; ?></td>
                  <td><?php echo $spl['Tanggal_update']; ?></td>
                  <td><?php echo $spl['Keterangan']; ?></td>
                  <td>
                      <a href="<?php echo BASEURL; ?>/Supplier/hapus" class="btn btn-danger" onclick="return confirm('apa anda yakin?')">Hapus</a>
                      <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSpl" data-id="<?php echo $spl['No_supplier']; ?>">Edit</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
      </div>

</div>
