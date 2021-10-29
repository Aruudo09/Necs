  <div id="page-content-wrapper">
      <div class="container-fluid px-4">

          <!--FLASH MESSAGE-->
            <div class="row">
               <div class="col-lg-6">
                  <?php FLASHER::flash(); ?>
               </div>
            </div>

        <!--TOMBOL TAMBAH NOMOR PO-->
          <div class="border border-dark rounded-3 bg-gradient p-3">
            <div class="row mb-3">
              <div class="col-lg-6">
                <button type="button" class="btn btn-primary" id="tambahData" data-bs-toggle="modal" data-bs-target="#modalPo">
                    Tambah Data
                </button>
              </div>
            </div>
        <!---END TOMBOL TAMBAH NOMOR PO-->

            <div class="row">
              <div class="overflow-auto">
                <h3>INPUT PURCHASE ORDER</h3>
                  <table class="table text-center table-hover">
                        <thead>
                          <tr class="table-warning ">
                            <th scope="col">No. PO</th>
                            <th scope="col">Tanggal PO</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Fitur</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php foreach( $data['tmp'] as $mhs ) : ?>
                        <tr>
                        <td><?php print $mhs['NO_PO']; ?></td>
                        <td><?php print $mhs['TGL_PO'];?></td>
                        <td><?php print $mhs['PEMESAN']; ?></td>
                        <td><?php print $mhs['NAMA_SP']; ?></td>
              <!--TOMBOL INPUT DETAIL PO-->
                        <td class="d-flex justify-content-center p-2">
                          <a href="#" class="btn btn-success newDtlPo" data-bs-toggle="modal" data-bs-target="#detailModal" data-id="<?php echo $mhs['NO_PO']; ?>"><i class="fa fa-file"></i></a>
              <!--TOMBOL UPDATE NOMOR PO-->
                          <a href="<?php echo BASEURL; ?>/purchased_order/Update/<?php echo $mhs['NO_PO']; ?>"
                        class="btn btn-primary editPo" data-bs-toggle="modal" data-bs-target="#modalPo"
                        data-id="<?php echo $mhs['NO_PO']; ?>"><i class="fa fa-pen"></i></a>
              <!--TOMBOL HAPUS NOMOR PO-->
                          <a href="<?php echo BASEURL; ?>/purchased_order/hapusPo/<?php echo $mhs['NO_PO']; ?>"
                        class="btn btn-danger" onclick="return confirm('apa anda yakin?');"><i class="fa fa-trash"></i></a>
                      </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
              </div>
          </div>
        </div>


        <div class="border border-dark rounded-3 bg-gradient mt-4 p-3">

            <div class="row">
              <div class="">
                <h3>LIST PURCHASED ORDER</h3>
                <!---SEARCH-->
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
                <!---END SEARCH-->
                <!--TABLE DETAIL PO-->
                  <table class="table table-bordered table-responsive text-center table-hover">
                        <thead>
                          <tr class="table-warning ">
                            <th scope="col">No. PO</th>
                            <th scope="col">Tanggal PO</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Barang</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Order</th>
                            <th scope="col">Terima</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Harga Order</th>
                            <th scope="col">Total</th>
                            <th scope="col">Fitur</th>
                          </tr>
                        </thead>
                        <tbody>
                      <?php foreach( $data['po'] as $mhs ) : ?>
                        <tr>
                        <td><?php print $mhs['NO_PO']; ?></td>
                        <td><?php print $mhs['TGL_PO'];?></td>
                        <td><?php print $mhs['PEMESAN']; ?></td>
                        <td><?php print $mhs['NAMA_SP']; ?></td>
                        <td><?php print $mhs['NAMA_BRG']; ?></td>
                        <td><?php print $mhs['Jenis_brg']; ?></td>
                        <td><?php print $mhs['Stock_brg']; ?></td>
                        <td><?php print $mhs['QTY_ORDER']; ?></td>
                        <td><?php print $mhs['QTY_TERIMA']; ?></td>
                        <td><?php print $mhs['Satuan']; ?></td>
                        <td><?php print $mhs['HARGA_PO']; ?></td>
                        <td><?php print $mhs['TOT_HARGA']; ?></td>
                        <td class="d-flex justify-content-center p-2">
              <!--TOMBOL UPDATE-->
                          <a href="<?php echo BASEURL; ?>/purchased_order/update/<?php echo $mhs['NO_PO']; ?>"
                        class="btn btn-primary editDtlPo" data-bs-toggle="modal" data-bs-target="#detailModal"
                        data-id="<?php echo $mhs['NO_PO']; ?>"><i class="fa fa-pen"></i></a>
              <!--TOMBOL HAPUS-->
                          <a href="<?php echo BASEURL; ?>/purchased_order/hapusDetail/<?php echo $mhs['NO_PO']; ?>"
                        class="btn btn-danger" onclick="return confirm('apa anda yakin?');"><i class="fa fa-trash"></i></a>
                      </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
                  <!--END TABLE DETAIL PO-->
              </div>
          </div>
        </div>


          <!---MODAL PURCHASED ORDER-->
              <div class="modal fade" id="modalPo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="labelPo" class="formLabel" >Tambah Data Purchased Order</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo BASEURL; ?>/purchased_order/tambah" method="post">
                          <!--HIDDEN INPUT NOMOR PO-->
                              <input type="hidden" name="No_po" id="No_po" value="">
                          <!--INPUT NOMOR PO-->
                              <div class="mb-3">
                                <label for="noPo">No PO :</label>
                                <?php foreach($data['counter'] as $cnt) : ?>
                                <select class="form-select" name="noPo" id="noPo">
                                  <option value="<?php echo sprintf('%04d', $cnt['po']+1) . "/PROC-P/" . date("m/y"); ?>"
                                    ><?php echo sprintf('%04d', $cnt['po']+1) . "/PROC-P/" . date("m/y"); ?> - Produksi</option>
                                  <option value="<?php echo sprintf('%04d', $cnt['po']+1) . "/PROC-U/" . date("m/y"); ?>"
                                    ><?php echo sprintf('%04d', $cnt['po']+1) . "/PROC-U/" . date("m/y"); ?> - Umum</option>
                                </select>
                              <?php endforeach; ?>
                              </div>
                          <!--INPUT PEMESAN-->
                              <div class="mb-3">
                                <label for="pemesan">Pemesan :</label>
                                <input type="text" name="pemesan" id="pemesan" value="" class="form-control" required>
                              </div>
                          <!--TANGGAL INPUT-->
                              <div class="mb-3">
                                <?php $date = date("Y/m/d");
                                $newDate = date("Y-m-d", strtotime($date)); ?>
                                  <label for="tanggal_po" class="form-label">Tanggal PO :</label>
                                  <input type="date" class="form-control" id="tanggal_po" name="tanggal_po" value="<?php echo $newDate; ?>">
                              </div>
                          <!--INPUT SUPPLIER-->
                              <div class="mb-3">
                                  <label for="sp" class="form-label">Supplier :</label>
                                  <select id="sp" name="sp" class="form-select">
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
                                  <input type="hidden" name="detailNoPo" id="detailNoPo" value="">
                                  <input type="hidden" name="detailPemesan" id="detailPemesan" value="">
                                  <input type="hidden" name="detailTglPo" id="detailTglPo" value="">
                                  <input type="hidden" name="detailSp" id="detailSp" value="">
                              <!--PEMESAN INPUT-->
                                  <div class="mb-3">
                                      <label for="brg" class="form-label">Barang :</label>
                                      <select id="brg" name="brg" class="form-select">
                                      <?php foreach ( $data['brg'] as $brg) : ?>
                                        <option value="<?php echo $brg['KODE_BRG'] ?>"><?php echo $brg['NAMA_BRG'] ?></option>
                                      <?php endforeach; ?>
                                      </select>
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
      </div>
  </div>
</div>
