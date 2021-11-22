      <div class="container-fluid px-4">

          <!--FLASH MESSAGE-->
            <div class="row my-2">
               <div class="col-lg-6">
                  <?php FLASHER::flash(); ?>
               </div>
            </div>

        <!--TOMBOL TAMBAH NOMOR PO-->
        <div class="row">
          <div class="col-md-6">
          <div class="border border-dark rounded-3 bg-gradient p-3 m-2">
            <h3>FORM INPUT SR</h3>
              <hr>
            <form action="<?php echo BASEURL; ?>/surat_request/tambah" method="post">
                <!--INPUT NOMOR PO-->
                    <div class="mb-3">
                      <label for="noSr">No SR :</label>
                      <?php foreach($data['counter'] as $cnt) : ?>
                        <input type="text" class="form-control" name="noSr" id="noSr" value="<?php echo sprintf('%03d', $cnt['sr']+1) . "/" . $_SESSION['login']['Initial'] ."/" . date("m/y"); ?>" readonly>
                    <?php endforeach; ?>
                    </div>
                <!--INPUT PEMESAN-->
                    <div class="mb-3">
                      <label for="peminta">Peminta :</label>
                      <input type="text" name="peminta" id="peminta" value="<?php echo $_SESSION['login']['USERNAME'] ?>" class="form-control" readonly>
                    </div>
                <!--TANGGAL INPUT-->
                    <div class="mb-3">
                      <?php $date = date("Y/m/d");
                      $newDate = date("Y-m-d", strtotime($date)); ?>
                        <label for="tanggal_sr" class="form-label">Tanggal SR :</label>
                        <input type="date" class="form-control" id="tanggal_sr" name="tanggal_sr" value="<?php echo $newDate; ?>">
                    </div>
                <!--INPUT SUPPLIER-->
                    <div class="mb-3">
                        <label for="sp" class="form-label">Supplier :</label>
                        <select id="sp" name="sp" class="form-select">
                          <option value="" selected readonly disabled>Choose...</option>
                        <?php foreach ( $data['sp'] as $brg) : ?>
                          <option value="<?php echo $brg['KODE_SP'] ?>"><?php echo $brg['NAMA_SP'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                      <h5>Input Barang</h5>
                        <div class="row">
                          <div class="col-7">
                            <select class="form-select inptBrgSr" name="inptBrgSr" id="inptBrgSr" onchange="">
                              <option selected readonly disabled>Choose...</option>
                              <?php foreach( $data['brg'] as $brg) : ?>
                                <option value="<?php echo $brg['KODE_BRG'] ?>"><?php echo $brg['NAMA_BRG'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-2">
                            <button type="button" name="button" class="btn btn-danger remove"><i class="fas fa-minus"></i></button>
                          </div>
                        </div>
                    </div>
                    <div id="add_row" class="row mb-3"></div>
                    <input type="hidden" value="0" id="num_row">
                    <div class="row">
                      <hr>
                      <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                </form>
              </div>
            </div>
        <!---END TOMBOL TAMBAH NOMOR PO-->

            <div class="col-md-6">
              <div class="border border-dark rounded-3 bg-gradient p-3 m-2">
              <div class="overflow-auto">
                <h3>SURAT REQUEST</h3>
                  <div class="d-flex mt-2 mb-2">
                      <input type="text" name="srchSrtxt" placeholder="Nomor PO...." id="srchSrtxt" class="form-control" style="width:50%">
                      <button type="button" name="srchSr" id="srchSr" class="btn btn-success" onclick="" style="width:15%"><i class="fas fa-search"></i></button>
                  </div>
                  <table class="table table-striped tblSr">
                    <?php foreach( $data['tmp'] as $mhs ) : ?>
                          <tr>
                            <th class="col">No. SR</th>
                            <td><input type="text" style="width:55%" id="Sr" class="form-control" name="" value="<?php print $mhs['NO_SR']; ?>" readonly></td>
                          </tr>
                          <tr>
                            <th class="col">Tanggal SR</th>
                            <td id="tglSr"><?php print $mhs['TGL_SR'];?></td>
                          </tr>
                          <tr>
                            <th class="col">Nama</th>
                            <td id="pmnt"><?php print $mhs['PEMINTA']; ?></td>
                          </tr>
                          <tr>
                            <th class="col">Supplier</th>
                            <td id="nmSp"><?php print $mhs['NAMA_SP']; ?></td>
                          </tr>
                          <tr>
                            <th style="display:none">Kode Supplier</th>
                            <td id="kdSpSr" style="display:none"><?php print $mhs['KODE_SP']; ?></td>
                          </tr>
                            <th class="col">Fitur</th>
                            <!--TOMBOL CETAK PO-->
                                      <td>
                                        <a href="<?php echo BASEURL; ?>/surat_request/detail/<?php echo $mhs['NO_SR'] ?>" class="btn btn-success newDtlPo" data-id="<?php echo $mhs['NO_SR']; ?>"><i class="fa fa-print"></i></a>
                            <!--TOMBOL UPDATE NOMOR PO-->
                                        <a href="<?php echo BASEURL; ?>/surat_request/Update/<?php echo $mhs['NO_SR']; ?>" class="btn btn-primary editSr" data-bs-toggle="modal" data-bs-target="#modalPo"
                                      data-id="<?php echo $mhs['NO_SR']; ?>"><i class="fa fa-pen"></i></a>
                            <!--TOMBOL HAPUS NOMOR PO-->
                                        <button type="button" class="btn btn-danger hpsSr" id="hpsSr" name="button" data-id="<?php echo $mhs['NO_SR']; ?>" onclick="return confirm('apa anda yakin?');"><i class="fas fa-trash"></i></button>
                                    </td>
                          </tr>
                        <?php endforeach; ?>
                  </table>
              </div>
          </div>
        </div>
      </div>

        <!--TABLE VIEW PURCHASED ORDER-->
        <div class="border border-dark rounded-3 bg-white mt-4 mb-3 p-3">
          <div class="overflow-auto">
            <table class="table table-bordered table-responsive table-striped table-hover text-center" id="tbPo">
                <h3>LIST SURAT REQUEST</h3>
                  <thead class="table-warning">
                    <tr>
                      <th scope="col">No. SR</th>
                      <th scope="col">Tanggal SR</th>
                      <th scope="col">Supplier</th>
                      <th scope="col">Barang</th>
                      <th scope="col">Jenis</th>
                      <th scope="col">Stock</th>
                      <th scope="col">Minta</th>
                      <th scope="col">Terima</th>
                      <th scope="col">Satuan</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Total</th>
                      <th scope="col">Fitur</th>
                    </tr>
                  </thead>

                  <tbody>
                <?php foreach( $data['po'] as $mhs ) : ?>
                  <tr>
                  <td id="npDtl"><?php print $mhs['NO_SR']; ?></td>
                  <td><?php print $mhs['TGL_SR'];?></td>
                  <td><?php print $mhs['NAMA_SP']; ?></td>
                  <td><?php print $mhs['NAMA_BRG']; ?></td>
                  <td><?php print $mhs['Jenis_brg']; ?></td>
                  <td><?php print $mhs['Stock_brg']; ?></td>
                  <td><?php print $mhs['QTY_MINTA']; ?></td>
                  <td><?php print $mhs['QTY_TERIMA']; ?></td>
                  <td><?php print $mhs['Satuan']; ?></td>
                  <td><?php print $mhs['HARGA_SR']; ?></td>
                  <td><?php print $mhs['TOT_HARGA']; ?></td>
                  <td style="width:10%">
                    <div class="d-flex justify-content-evenly">
                      <!--TOMBOL UPDATE-->
                        <div class="col">
                          <a href="<?php echo BASEURL; ?>/surat_request/update/<?php echo $mhs['NO_SR']; ?>"
                        class="btn btn-primary editDtlSr" data-bs-toggle="modal" data-bs-target="#detailModal"
                        data-id="<?php echo $mhs['NO_SR']; ?>" data-kd="<?php echo $mhs['KODE_BRG']; ?>"><i class="fa fa-pen"></i></a>
                        </div>
                      <!--TOMBOL HAPUS-->
                        <div class="col">
                          <a class="btn btn-danger hps" onclick="return confirm('apa anda yakin?');" data-id="<?php echo $mhs['NO_SR']; ?>" data-kd="<?php echo $mhs['KODE_BRG']; ?>"><i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
        </div>
      </div>

          <!--END TABLE VIEW PURCHASED ORDER-->


          <!---MODAL PURCHASED ORDER-->
              <div class="modal fade" id="modalPo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="labelPo" class="formLabel" >Tambah Data Purchased Order</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo BASEURL; ?>/Surat_request/tambah" method="post">
                          <!--HIDDEN INPUT NOMOR PO-->
                              <input type="text" name="No_sr" id="No_sr" value="">
                          <!--INPUT NOMOR PO-->
                              <div class="mb-3">
                                <label for="noSr2">No SR :</label>
                                <input type="text" class="form-control" name="noSr2" id="noSr2" value="" maxlength="17" readonly>
                              </div>
                          <!--INPUT PEMESAN-->
                              <div class="mb-3">
                                <label for="peminta2">Pemesan :</label>
                                <input type="text" name="peminta2" id="peminta2" value="" class="form-control" required>
                              </div>
                          <!--TANGGAL INPUT-->
                              <div class="mb-3">
                                <?php $date = date("Y/m/d");
                                $newDate = date("Y-m-d", strtotime($date)); ?>
                                  <label for="tanggal_sr2" class="form-label">Tanggal SR :</label>
                                  <input type="date" class="form-control" id="tanggal_sr2" name="tanggal_sr2" value="<?php echo $newDate; ?>">
                              </div>
                          <!--INPUT SUPPLIER-->
                              <div class="mb-3">
                                  <label for="sp2" class="form-label">Supplier :</label>
                                  <select id="sp2" name="sp2" class="form-select">
                                  <?php foreach ( $data['sp'] as $brg) : ?>
                                    <option value="<?php echo $brg['KODE_SP'] ?>"><?php echo $brg['NAMA_SP'] ?></option>
                                  <?php endforeach; ?>
                                  </select>
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

              <!---MODAL DETAIL PURCHASED ORDER-->
                  <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="labelDetailPo" class="formLabel" >Input Barang Purchased Order</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="<?php echo BASEURL; ?>/purchased_order/tambahDetail" method="post">
                              <!--HIDDEN INPUT-->
                                  <input type="text" name="detailNoSr" id="detailNoSr" value="">
                                  <input type="text" name="detailBarang" id="detailBarang" value="">
                              <!--PEMESAN INPUT-->
                                  <div class="mb-3">
                                      <label for="brg" class="form-label">Barang :</label>
                                      <input type="text" id="brg" class="form-control" name="brg" value="" readonly>
                                  </div>
                                  <div class="mb-3">
                                      <label for="qty" class="form-label">Quantity Order :</label>
                                      <input type="number" class="form-control" id="qty" name="qty" required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="harga">Harga :</label>
                                    <input type="number" name="harga" id="harga" value="" class="form-control" required>
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
