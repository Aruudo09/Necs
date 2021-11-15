<div class="container-fluid px-4">

    <!--MENAMPILKAN FLASH MESSAGE-->
      <div class="row">
         <div class="col-lg-6">
            <?php FLASHER::flash(); ?>
         </div>
      </div>

<div class="border border-dark rounded-3 bg-gradient mt-4 p-3">
    <!--Data Barang-->
      <!-- Button trigger modal -->
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="data-barang">
        <div class="row mb-3 mt-2">
          <div class="col-lg-6">
            <button type="button" class="btn btn-primary" id="tambahBarang" data-bs-toggle="modal" data-bs-target="#modalBarang"><i class="fas fa-plus"></i> Input Data Barang</button>
            <button type="button" name="button" class="btn btn-warning" id="cek" data-bs-toggle="modal" data-bs-target="#cekBrg" onclick="">Re-Order Point</button>
          </div>
        </div>


   <!--TABLE VIEW BARANG-->

          <div class="border border-dark rounded-3 bg-white mt-4 p-3">
          <div class="overflow-auto">
            <table class="table table-striped table-bordered table-hover text-center" id="tbBrg">
              <h3 class="fs-4 mb-3">Daftar Barang</h3>
                <thead class="table-warning">
                  <tr>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Tanggal Beli</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Nama Supplier</th>
                    <th scope="col">Fitur</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ( $data['barang'] as $brg) : ?>
                      <tr>
                        <td><?php print $brg['NAMA_BRG'] ?></td>
                        <td><?php print $brg['Jenis_brg'] ?></td>
                        <td><?php print $brg['Stock_brg'] ?></td>
                        <td><?php print $brg['Satuan'] ?></td>
                        <td><?php print $brg['Tanggal_beli'] ?></td>
                        <td><?php print $brg['Harga'] ?></td>
                        <td><?php print $brg['NAMA_SP'] ?></td>
                        <td>
                          <a href="#" class="btn btn-info btnUpdateBrg" data-bs-toggle="modal" data-bs-target="#modalBarang" data-id="<?php echo $brg['KODE_BRG'] ?>"><i class="fas fa-pen"></i></a>
                          <a href="<?php echo BASEURL; ?>/barang/hapus/<?php echo $brg['KODE_BRG'] ?>" class="btn btn-danger" onclick="return confirm('apa anda yakin?');"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                  <?php endforeach; ?>
                </tbody>
          </table>
        </div>
      </div>
       <!--END OF TABLE VIEW BARANG-->
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
                    <!--HIDDEN INPUT KODE BRG-->
                      <input type="hidden" name="kodeBrg" id="kodeBrg" value="">
                    <!--INPUT SUPPLIER-->
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputSpl" class="form-label">Nama Supplier :</label>
                                <select id="inputSpl" class="form-select" name="inputSpl" required>
                                  <option selected>Choose...</option>
                                  <?php foreach ( $data['optionSpl'] as $spl ) : ?>
                                  <option value="<?php echo $spl['KODE_SP']; ?>"><?php echo $spl['NAMA_SP']; ?></option>
                                  <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <!--INPUT NAMA BARANG-->
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputNamaBrg">Nama Barang :</label>
                                <input type="text" id="inputNamaBrg" class="form-control" name="inputNamaBrg" required>
                            </div>
                        </div>
                    <!--INPUT JENIS BARANG-->
                        <div class="row mb-3">
                            <div class="col">
                                <label for="inputJnsBrg">Jenis Barang</label>
                                <input type="text" name="inputJnsBrg" id="inputJnsBrg" class="form-control" required>
                            </div>
                        </div>
                    <!--INPUT STOCK BARANG-->
                        <div class="row mb-3">
                            <div class="col">
                                <label for="stockBrg">Stock Barang :</label>
                                <input type="number" name="stockBrg" id="stockBrg" class="form-control" required>
                            </div>
                          <!--INPUT SATUAN BARANG-->
                            <div class="col">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" class="form-control" id="satuan" value="" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                          <!--INPUT STOCK MINIMUM-->
                            <div class="col">
                                <label for="stckMin">Stock Min :</label>
                                <input type="number" name="stckMin" id="stckMin" class="form-control" required>
                            </div>
                          <!--INPUT STOCK MAXIMUM-->
                            <div class="col">
                                <label for="stckMax">Stock Max :</label>
                                <input type="number" name="stckMax" class="form-control" id="stckMax" value="" required>
                            </div>
                        </div>
                    <!--INPUT TANGGAL BARANG-->
                        <div class="row mb-3">
                          <?php $date = date("Y/m/d");
                          $newDate = date("Y-m-d", strtotime($date)); ?>
                            <div class="col">
                                <label for="tanggalInput">Tanggal Input :</label>
                                <input type="date" name="tanggalInput" id="tanggalInput" class="form-control" value="<?php echo $newDate; ?>" required>
                            </div>
                          <!--INPUT HARGA BARANG-->
                            <div class="col">
                              <label for="harga">Harga</label>
                              <input type="number" name="harga" id="harga" class="form-control" required>
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
            </div>

        <!--MODAL CEK BARANG-->
        <div class="modal fade" id="cekBrg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content p-3">
                <div class="modal-header">
                  <h5 class="modal-title">Re-Order Point</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <h4>DAFTAR TABLE BARANG</h4>
                  <table class="table table-bordered text-center">
                    <thead class="table-info">
                      <tr class="">
                        <th class="col">Nama Barang</th>
                        <th class="col">Jenis Barang</th>
                        <th class="col">Stock Min</th>
                        <th class="col">Stock Max</th>
                        <th class="col">Stock Barang</th>
                        <th class="col">Satuan</th>
                        <th class="col-2">Supplier</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach( $data['ckBrg'] as $brg) : ?>
                      <td><?php print $brg['NAMA_BRG'] ?></td>
                      <td><?php print $brg['Jenis_brg'] ?></td>
                      <td><?php print $brg['STOCK_MIN'] ?></td>
                      <td><?php print $brg['STOCK_MAX'] ?></td>
                      <td><?php print $brg['Stock_brg'] ?></td>
                      <td><?php print $brg['Satuan'] ?></td>
                      <td><?php print $brg['NAMA_SP'] ?></td>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

</div>

</div>
