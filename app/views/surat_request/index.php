      <div class="container-fluid px-4">

          <!--FLASH MESSAGE-->
            <div class="row mx-auto my-2">
               <div class="col-lg-6">
                  <?php FLASHER::flash(); ?>
               </div>
            </div>

        <!--TOMBOL TAMBAH NOMOR PO-->
        <div class="row mx-auto">
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


            <div class="row mx-auto">
              <div class="border border-dark rounded-3 bg-gradient p-3 m-2">
              <div class="overflow-auto">
                <h3>LIST SURAT REQUEST</h3>
                  <form class="" action="<?php echo BASEURL; ?>/surat_request/cari/1" method="post">
                    <div class="d-flex mt-2 mb-2">
                        <input type="text" name="keyword" placeholder="Nomor PO...." class="form-control" style="width:30%">
                        <button type="submit" name="srchSr" class="btn btn-success" onclick="" style="width:6%"><i class="fas fa-search"></i></button>
                    </div>
                  </form>
                  <table class="table table-striped text-center" id="tbSr">
                    <thead class="table-warning">
                      <tr>
                        <th class="col">Nomor SR</th>
                        <th class="col">Peminta</th>
                        <th class="col">Departement</th>
                        <th class="col">Supplier</th>
                        <th class="col">Tanggal SR</th>
                        <th class="col">Fitur</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach( $data['tmp']['data'] as $tmp ) : ?>
                        <tr>
                          <td><?php print $tmp['NO_SR'] ?></td>
                          <td><?php print $tmp['PEMINTA'] ?></td>
                          <td><?php print $tmp['NMDEF'] ?></td>
                          <td><?php print $tmp['NAMA_SP'] ?></td>
                          <td><?php print $tmp['TGL_SR'] ?></td>
                          <td class="d-flex justify-content-evenly">
                            <!--BUTTON DETAIL-->
                              <button type="button" class="btn btn-success detail" data-bs-toggle="modal" data-bs-target="#modalDtlSr" data-id="<?php echo $tmp['NO_SR'] ?>" name="button"><i class="fa fa-file"></i></button>
                            <!--BUTTON EDIT-->
                              <button type="button" class="btn btn-primary edtSr" data-id="<?php echo $tmp['NO_SR'] ?>" data-bs-toggle="modal" data-bs-target="#modalEdtSr" name="button"><i class="fa fa-pen"></i></button>
                            <!--BUTTON HAPUS-->
                              <a href="<?php echo BASEURL; ?>/Surat_request/hapus/<?php echo str_replace('/', '-f' ,($tmp['NO_SR'])) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  <nav>
                    <ul class="pagination justify-content-center">
                      <!--TOMBOL PREV-->
                        <?php if ( $data['tmp']['halamanAktif'] <= 1 ) { ?>
                          <li class="page-item disabled">
                            <a href="<?php echo BASEURL; ?>/surat_request/<?php $data['tmp']['halamanAktif'] - 1  ?>" class="page-link">Prev</a>
                          </li>
                        <?php } else { ?>
                          <li class="page-item">
                            <a href="<?php echo BASEURL; ?>/surat_request/<?php $data['tmp']['halamanAktif'] - 1  ?>" class="page-link">Prev</a>
                          </li>
                        <?php } ?>
                      <!--TOMBOL PAGE-->
                      <?php
                        $count = 4;
                        $startPage = max(1, $data['tmp']['banyakHal'] - $count);
                        $endPage = min( $data['tmp']['banyakHal'], $data['tmp']['banyakHal'] + $count);
                       ?>
                        <?php for ($i=$startPage; $i <= $endPage; $i++) { ?>
                          <?php if ( $data['tmp']['halamanAktif'] == $i ) { ?>
                            <li class="page-item active">
                              <a href="<?php echo BASEURL; ?>/surat_request/<?php echo $i; ?>" class="page-link pgNum"><?php echo $i ?></a>
                            </li>
                          <?php } else { ?>
                            <li class="page-item">
                              <a href="<?php echo BASEURL; ?>/surat_request/<?php echo $i; ?>" class="page-link pgNum"><?php echo $i ?></a>
                            </li>
                          <?php } ?>
                        <?php } ?>
                      <!--TOMBOL NEXT-->
                        <?php if ( $data['tmp']['halamanAktif'] == $data['tmp']['banyakHal'] ) { ?>
                          <li class="page-item disabled">
                            <a href="<?php echo BASEURL; ?>/surat_request/<?php $data['tmp']['halamanAktif'] + 1 ?>" class="page-link">Next</a>
                          </li>
                        <?php } else { ?>
                          <li class="page-item">
                            <a href="<?php echo BASEURL; ?>/surat_request/<?php $data['tmp']['halamanAktif'] + 1 ?>" class="page-link">Next</a>
                          </li>
                        <?php } ?>
                    </ul>
                  </nav>
              </div>
          </div>
        </div>

          <!--END TABLE VIEW PURCHASED ORDER-->

          <!--MODAL VIEW DETAIL SURAT REQUEST-->
              <div class="modal fade" id="modalDtlSr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">View Detail Surat Request</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <form class="" action="<?php echo BASEURL; ?>/Surat_request/ubah" method="post">
                      <table class="table table-borderless">
                        <tr>
                          <th class="table-warning col-2">Nomor SR</th>
                          <td class="table-info"><input type="text" class="form-control" id="Sr" name="Sr" value="" readonly></td>
                        </tr>
                        <tr>
                          <th class="table-warning col-2">Peminta</th>
                          <td class="table-info"><input type="text" class="form-control" id="tbPmnt" name="pmnt" value="" readonly></td>
                        </tr>
                        <tr>
                          <th class="table-warning col-2">Departement</th>
                          <td class="table-info"><input type="text" class="form-control" id="tbDept" name="Dept" value="" readonly></td>
                        </tr>
                        <tr>
                          <th class="table-warning col-2">Supplier</th>
                          <td class="table-info"><input type="text" class="form-control" id="tbSpr" name="Sp" value="" readonly></td>
                        </tr>
                        <tr>
                          <th class="table-warning" col-2>Tanggal SR</th>
                          <td class="table-info"><input type="text" class="form-control" id="tbTgl" name="tgl" value="" readonly></td>
                        </tr>
                      </table>
                        <h4>DAFTAR BARANG</h4>
                        <div class="overflow-auto">
                            <table class="table table-bordered text-center" id="myTabs">
                              <thead class="table-info">
                                <tr>
                                  <th class="col">Nama Barang</th>
                                  <th class="col">Quantity</th>
                                  <th class="col">Satuan</th>
                                  <th class="col">Harga</th>
                                  <th class="col">Total</th>
                                  <th class="col">Fitur</th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="editDtl"><i class="fa fa-pen"> <b>Edit</b></i></button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
          <!--END MODAL VIEW DETAIL SURAT REQUEST-->


          <!---MODAL EDIT SURAT REQUEST-->
              <div class="modal fade" id="modalEdtSr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="labelPo" class="formLabel" >Tambah Data Purchased Order</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo BASEURL; ?>/Surat_request/Update" method="post">
                          <!--INPUT NOMOR PO-->
                              <div class="mb-3">
                                <label for="noSr2">No SR :</label>
                                <input type="text" class="form-control" name="noSr2" id="noSr2" value="" maxlength="17" readonly>
                              </div>
                          <!--INPUT PEMESAN-->
                              <div class="mb-3">
                                <label for="peminta2">Pemesan :</label>
                                <input type="text" name="peminta2" id="peminta2" value="" class="form-control" readonly>
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

          </div>
