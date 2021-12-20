<div class="container-fluid px-4">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row my-2">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>


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
    <div class="border border-dark rounded-3 bg-white mx-auto mb-3 p-3">
     <h3 class="fs-4 mb-2">Daftar Supplier</h3>
      <form class="" action="<?php echo BASEURL; ?>/supplier/index/1" method="post">
        <div class="d-flex mb-2">
          <input type="text" class="form-control" style="width:30%" name="keyword" value="">
          <button type="submit" class="btn btn-success" style="width:6%" name="srchBtn"><i class="fa fa-search"></i></button>
        </div>
      </form>
      <div class="overflow-auto">
          <table class="table table-hover table-bordered table-striped text-center" id="tbSp">
              <thead class="table-warning">
                <tr>
                  <th class="col">Supplier</th>
                  <th class="col">No Telp</th>
                  <th class="col">Email</th>
                  <th class="col-2">Fitur</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ( $data['supplier']['data'] as $spl) : ?>
                <tr>
                  <td><?php echo $spl['NAMA_SP']; ?></td>
                  <td><?php echo $spl['TELEPON']; ?></td>
                  <td><?php echo $spl['email']; ?></td>
                  <td class="d-flex justify-content-evenly">
                        <!--DETAIL SUPPLIER-->
                          <button type="button" class="btn btn-success dtlSp" name="button" data-bs-toggle="modal" data-bs-target="#DtlSp" data-id="<?php echo $spl['KODE_SP'] ?>"><i class="fa fa-file"></i></button>
                        <!--EDIT SUPPLIER-->
                          <a href="<?php echo BASEURL; ?>/Supplier/ubah" class="btn btn-primary editSpl" data-bs-toggle="modal" data-bs-target="#modalSpl" data-id="<?php echo $spl['KODE_SP']; ?>"><i class="fa fa-pen"></i></a>
                        <!--HAPUS SUPPLIER-->
                          <a href="<?php echo BASEURL; ?>/Supplier/hapus/<?php echo $spl['KODE_SP']; ?>" class="btn btn-danger" onclick="return confirm('apa anda yakin?')"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
      </div>
      <nav>
        <ul class="pagination justify-content-center">
          <!--TOMBOL PREVIOUS-->
            <?php if ( $data['supplier']['halamanAktif'] <= 1 ) { ?>
                <li class="page-item disabled"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $data['supplier']['halamanAktif'] - 1; ?>" class="page-link">Prev</a></li>
            <?php } else { ?>
                <li class="page-item"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $data['supplier']['halamanAktif'] - 1; ?>" class="page-link">Prev</a></li>
            <?php } ?>
          <!--TOMBOL PAGE-->
            <?php for ($i=1; $i < $data['supplier']['banyakHal']; $i++) { ?>
              <?php if ( $data['supplier']['halamanAktif'] == $i ) { ?>
                <li class="page-item active"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $i; ?>" class="page-link pgNum"><?php echo $i; ?></a></li>
              <?php } else { ?>
                <li class="page-item"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $i; ?>" class="page-link pgNum"><?php echo $i; ?></a></li>
              <?php } ?>
            <?php } ?>
          <!--TOMBOL NEXT-->
            <?php if ( $data['supplier']['halamanAktif'] >= $data['supplier']['banyakHal'] ) { ?>
              <li class="page-item disabled"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $data['supplier']['halamanAktif'] + 1; ?>" class="page-link">Next</a></li>
            <?php } else { ?>
              <li class="page-item"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $data['supplier']['halamanAktif'] + 1; ?>" class="page-link">Next</a></li>
            <?php } ?>
        </ul>
      </nav>
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
                        <?php $date = date("Y/m/d");
                        $newDate = date("Y-m-d", strtotime($date)); ?>
                          <div class="form-group col">
                              <label for="tanggalInput">Tanggal Input :</label>
                              <input type="date" name="tanggalInput" id="tanggalInput" class="form-control" value="<?php echo $newDate; ?>">
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

      <!--MODAL VIEW DETAIL SUPPLIER-->
      <div class="modal fade" id="DtlSp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View Detail Supplier</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <tr>
                  <th class="table-warning col-2">NPWP</th>
                  <td class="table-info" id="npwpInfo"></td>
                </tr>
                <tr>
                  <th class="table-warning">Contact Person</th>
                  <td class="table-info" id="cp"></td>
                </tr>
                <tr>
                  <th class="table-warning">Tanggal Input</th>
                  <td class="table-info" id="tgl_inpt"></td>
                </tr>
                <tr>
                  <th class="table-warning">Qty/Perbulan</th>
                  <td class="table-info" id="qty"></td>
                </tr>
                <tr>
                  <th class="table-warning">Alamat</th>
                  <td class="table-info" id="alamat"></td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

</div>
