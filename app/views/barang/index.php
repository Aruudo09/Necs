<div class="container-fluid px-4">



    <!--FLASHER-->
      <div class="row">
         <div class="col-lg-6">
            <?php FLASHER::flash(); ?>
         </div>
      </div>

    <!--Data Barang-->
      <!-- Button trigger modal -->
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="data-barang">
        <div class="row mb-3 mt-4">
          <div class="col-lg-6">
            <button type="button" class="btn btn-primary" id="tambahBarang" data-bs-toggle="modal" data-bs-target="#modalBarang">
                Input Data Barang
            </button>
          </div>
        </div>

     <!-- Modal -->
          <div class="modal fade" id="modalBarang" tabindex="-1" aria-labelledby="modalBarang" aria-hidden="true">
            <div class="modal-dialog" >
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabelBrg">Input Barang</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="<?php echo BASEURL; ?>/barang/tambah" method="post">
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="Kode_brg" class="form-label">Kode Barang :</label>
                              <input type="number" id="Kode_brg" class="form-control" name="Kode_brg">
                          </div>
                      </div>
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="inputSpl" class="form-label">Nama Supplier :</label>
                              <select id="inputSpl" class="form-select" name="inputSpl">
                                <option selected>Choose...</option>
                                <?php foreach ( $data['optionSpl'] as $spl ) : ?>
                                <option value="<?php echo $spl['No_supplier']; ?>"><?php echo $spl['Nama_spl']; ?></option>
                                <?php endforeach; ?>
                              </select>
                          </div>
                      </div>
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="inputNamaBrg">Nama Barang :</label>
                              <input type="text" id="inputNamaBrg" class="form-control" name="inputNamaBrg">
                          </div>
                      </div>
                      <div class="row mb-3">
                          <div class="form-group">
                              <label for="inputJnsBrg">Jenis Barang</label>
                              <input type="text" name="inputJnsBrg" id="inputJnsBrg" class="form-control">
                          </div>
                      </div>
                      <div class="row mb-3">
                          <div class="form-group col">
                              <label for="stockBrg">Stock Barang :</label>
                              <input type="number" name="stockBrg" id="stockBrg" class="form-control">
                          </div>
                          <div class="form-group col">
                              <label for="satuan">Satuan</label>
                              <select class="form-select" name="satuan" id="satuan" >
                                  <option selected></option>
                                  <option>Pcs</option>
                                  <option>Rim</option>
                                  <option>Kilogram</option>
                              </select>
                          </div>
                      </div>
                      <div class="row mb-3">
                          <div class="form-group col">
                              <label for="tanggalInput">Tanggal Input :</label>
                              <input type="date" name="tanggalInput" id="tanggalInput" class="form-control">
                          </div>
                          <div class="form-group col">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control">
                          </div>
                      </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                  </form>
                </div>
              </div>
            </div>
            </div>


     <!--TABLE VIEW BARANG-->
        <h3 class="fs-4 mb-3">Daftar Barang</h3>
          <div class="scrollme">
          <div class="overflow-auto">
            <table class="table table-hover text-center">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Nama Supplier</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Tanggal Input</th>
                    <th scope="col">Harga</th>
                    <th class="text-center" scope="col">Fitur</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ( $data['barang'] as $brg) : ?>
                      <tr>
                        <th scope="row">1</th>
                        <td><?php echo $brg['Kode_brg']; ?></td>
                        <td><?php echo $brg['Nama_spl']; ?></td>
                        <td><?php echo $brg['Nama_brg']; ?></td>
                        <td><?php echo $brg['Jenis_brg']; ?></td>
                        <td><?php echo $brg['Stock_brg']; ?></td>
                        <td><?php echo $brg['Satuan']; ?></td>
                        <td><?php echo $brg['Tanggal_input']; ?></td>
                        <td><?php echo $brg['Harga_beli']; ?></td>
                        <td scope="row">
                          <!--FITUR HAPUS-->
                            <a href="<?php echo BASEURL; ?>/barang/hapus/<?php echo $brg['Kode_brg']; ?>" class="btn btn-danger" onclick="return confirm('apa anda yakin?')">Hapus</a>
                          <!--FITUR UPDATE-->
                            <a href="<?php echo BASEURL; ?>/barang/update/<?php echo $brg['Kode_brg']; ?>" data-bs-toggle="modal" data-bs-target="#modalBarang" class="btn btn-primary btnUpdateBrg" data-id="<?php echo $brg['Kode_brg']; ?>">Update</a>
                        </td>
                      </tr>
                  <?php endforeach; ?>
                </tbody>
          </table>
        </div>
      </div>
       <!--END OF TABLE VIEW BARANG-->

</div>

</div>
