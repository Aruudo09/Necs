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
            <button type="button" class="btn btn-primary" id="tambahBarang" data-bs-toggle="modal" data-bs-target="#modalBarang">
                Input Data Barang
            </button>
          </div>
        </div>


   <!--TABLE VIEW BARANG-->
        <h3 class="fs-4 mb-3">Daftar Barang</h3>
      <!--SEARCH-->
        <div class="row mb-2">
            <div class="col-lg-6">
              <form class="" action="<?php echo BASEURL; ?>/barang/cari" method="post">
                <div class="input-group mb-2">
                  <input type="text" class="form-control" placeholder="cari data.." name="keyword" id="keyword" autocomplete="off" aria-label="Recipient's username" aria-describedby="button-addon2">
                  <button class="btn btn-outline-secondary" type="submit" id="tombolCari">Cari</button>
                </div>
              </form>
            </div>
          </div>
        <!---END SEARCH-->
          <div class="scrollme">
          <div class="overflow-auto">
            <table class="table table-hover text-center">
                <thead class="table-info">
                  <tr>
                    <th scope="col">Nama Supplier</th>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Tanggal Beli</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Fitur</th>
                  </tr>
                </thead>

                <tbody>
                  <?php foreach ( $data['barang'] as $brg) : ?>
                      <tr>
                        <td><?php print $brg['NAMA_SP']; ?></td>
                        <td><?php print $brg['KODE_BRG']; ?></td>
                        <td><?php print $brg['NAMA_BRG']; ?></td>
                        <td><?php print $brg['Jenis_brg']; ?></td>
                        <td><?php print $brg['Stock_brg']; ?></td>
                        <td><?php print $brg['Satuan']; ?></td>
                        <td><?php print $brg['Tanggal_beli']; ?></td>
                        <td><?php print $brg['Harga']; ?></td>
                        <td class="d-flex justify-content-center">
                          <!--FITUR HAPUS-->
                            <a href="<?php echo BASEURL; ?>/barang/hapus/<?php echo $brg['KODE_BRG']; ?>" class="btn btn-danger" onclick="return confirm('apa anda yakin?')"><i class="fa fa-trash"></i></a>
                          <!--FITUR UPDATE-->
                            <a href="<?php echo BASEURL; ?>/barang/update/<?php echo $brg['KODE_BRG']; ?>" data-bs-toggle="modal" data-bs-target="#modalBarang" class="btn btn-primary btnUpdateBrg" data-id="<?php echo $brg['KODE_BRG']; ?>"><i class="fa fa-pen"></i></a>
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
                            <div class="form-group">
                                <label for="inputSpl" class="form-label">Nama Supplier :</label>
                                <select id="inputSpl" class="form-select" name="inputSpl">
                                  <option selected>Choose...</option>
                                  <?php foreach ( $data['optionSpl'] as $spl ) : ?>
                                  <option value="<?php echo $spl['KODE_SP']; ?>"><?php echo $spl['NAMA_SP']; ?></option>
                                  <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <!--INPUT NAMA BARANG-->
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="inputNamaBrg">Nama Barang :</label>
                                <input type="text" id="inputNamaBrg" class="form-control" name="inputNamaBrg">
                            </div>
                        </div>
                    <!--INPUT JENIS BARANG-->
                        <div class="row mb-3">
                            <div class="form-group">
                                <label for="inputJnsBrg">Jenis Barang</label>
                                <input type="text" name="inputJnsBrg" id="inputJnsBrg" class="form-control">
                            </div>
                        </div>
                    <!--INPUT STOCK BARANG-->
                        <div class="row mb-3">
                            <div class="form-group col">
                                <label for="stockBrg">Stock Barang :</label>
                                <input type="number" name="stockBrg" id="stockBrg" class="form-control">
                            </div>
                          <!--INPUT SATUAN BARANG-->
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
                    <!--INPUT TANGGAL BARANG-->
                        <div class="row mb-3">
                            <div class="form-group col">
                                <label for="tanggalInput">Tanggal Input :</label>
                                <input type="date" name="tanggalInput" id="tanggalInput" class="form-control">
                            </div>
                          <!--INPUT HARGA BARANG-->
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


</div>

</div>
