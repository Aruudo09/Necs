<div class="container-fluid px-4">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row my-2">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>

    <!--BUTTON BACK-->
    <a href="<?php echo BASEURL; ?>/barang_masuk/1/">
      <button type="button" class="btn btn-success" name="button"><i class="fa fa-arrow-left"></i> KEMBALI</button>
    </a>

    <!--TABLE VIEW LIST PURCHASED ORDER-->
      <div class="border border-dark rounded-3 bg-white mt-4 p-3">
        <div class="">
          <h3>PURCHASED ORDER</h3>
            <form class="" action="<?php echo BASEURL; ?>/barang_masuk/detail/1" method="post">
              <div class="d-flex mb-3">
                <input type="text" class="form-control" style="width:20%" name="keyword" value="">
                <button type="submit" class="btn btn-success" style="width:5%" name="srchbtn"><i class="fa fa-search"></i></button>
              </div>
            </form>
          <div class="overflow-auto">
              <table class="table table-bordered table-striped table-responsive text-center table-hover tbPo2">
                    <thead>
                      <tr class="table-warning">
                        <th class="col">No. PO</th>
                        <th class="col">Supplier</th>
                        <th class="col">Pemesan</th>
                        <th class="col">Departemen</th>
                        <th class="col">Tanggal Input</th>
                        <th class="col">Fitur</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php foreach( $data['po']['data'] as $mhs ) : ?>
                    <tr>
                    <td><?php print $mhs['NO_PO']; ?></td>
                    <td><?php print $mhs['NAMA_SP']; ?></td>
                    <td><?php print $mhs['PEMESAN']; ?></td>
                    <td><?php print $mhs['NMDEF']; ?></td>
                    <td><?php print $mhs['TGL_PO']; ?></td>
                    <td>
                      <!--DETAIL-->
                        <button type="button" class="btn btn-success dtl" name="button" data-bs-toggle="modal" data-bs-target="#DtlPo" data-id="<?php echo $mhs['NO_PO'] ?>"><i class="fa fa-file"></i> DETAIL</button>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
              </table>
              <nav>
                <ul class="pagination justify-content-center">
                  <!--TOMBOL PREV-->
                    <?php if ( $data['po']['halamanAktif'] <= 1 ) { ?>
                      <li class="page-item disabled">
                        <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['po']['halamanAktif'] - 1 ?>" class="page-link">Prev</a>
                      </li>
                    <?php } else { ?>
                      <li class="page-item">
                        <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['po']['halamanAktif'] - 1 ?>" class="page-link">Prev</a>
                      </li>
                    <?php } ?>
                  <!--TOMBOL PAGE-->
                    <?php for ($i=1; $i <= $data['po']['banyakHal'] ; $i++) { ?>
                      <?php if ( $i == $data['po']['halamanAktif'] ) { ?>
                        <li class="page-item active">
                          <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $i ?>" class="page-link pgNum"><?php echo $i ?></a>
                        </li>
                      <?php } else { ?>
                        <li class="page-item">
                          <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $i ?>" class="page-link pgNum"><?php echo $i ?></a>
                        </li>
                      <?php } ?>
                    <?php } ?>
                  <!--TOMBOL NEXT-->
                    <?php if ( $data['po']['halamanAktif'] == $data['po']['banyakHal'] ) { ?>
                      <li class="page-item disabled">
                        <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['po']['halamanAktif'] + 1 ?>" class="page-link">Next</a>
                      </li>
                    <?php } else { ?>
                      <li class="page-item">
                        <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['po']['halamanAktif'] + 1 ?>" class="page-link">Next</a>
                      </li>
                    <?php } ?>
                </ul>
              </nav>
          </div>
        </div>
    </div>

    <!--MODAL VIEW DETAL PO-->
      <div class="modal fade" id="DtlPo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View Detail Purchased Order</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <tr>
                  <th class="table-warning col-2">Nomor PO</th>
                  <td class="table-info" id="Po"></td>
                  <td style="display:none"><input type="hidden" name="Po" id="hdnPo" value=""></td>
                </tr>
                <tr>
                  <th class="table-warning col-2">Pemesan</th>
                  <td class="table-info" id="tbPmsn"></td>
                </tr>
                <tr>
                  <th class="table-warning col-2">Departement</th>
                  <td class="table-info" id="tbDept"></td>
                </tr>
                <tr>
                  <th class="table-warning col-2">Supplier</th>
                  <td class="table-info" id="tbSpr"></td>
                </tr>
                <tr>
                  <th class="table-warning" col-2>Tanggal PO</th>
                  <td class="table-info" id="tbTgl"></td>
                </tr>
              </table>
              <h4>DETAIL PURCHASED ORDER</h4>
              <div class="overflow-auto">
              <table class="table table-bordered text-center" id="myTabs">
                <thead class="table-info">
                  <tr>
                    <th class="col">Nama Barang</th>
                    <th class="col-2">Quantity</th>
                    <th class="col">Terima</th>
                    <th class="col">Satuan</th>
                    <th class="col">Harga</th>
                    <th class="col">Total</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

</div>
