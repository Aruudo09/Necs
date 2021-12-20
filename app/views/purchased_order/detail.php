<div class="container-fluid px-4">

  <!--TOMBOL KEMBALI-->
    <button type="button" class="btn btn-success mt-3" id="back" name="button"><i class="fa fa-arrow-left"></i> <b>Kembali</b></button>

    <!--MENAMPILKAN FLASH MESSAGE-->
      <div class="row my-2">
         <div class="col-lg-6">
            <?php FLASHER::flash(); ?>
         </div>
      </div>

  <!--TABLE VIEW PURCHASED ORDER-->
    <div class="border border-dark rounded-3 p-3 mx-auto mt-3">
      <h3>PURCHASED ORDER</h3>
      <hr>
      <div class="row mb-3">
        <form class="" action="<?php echo BASEURL; ?>/purchased_order/detail/1" method="post">
          <div class="d-flex">
            <input type="text" class="form-control" style="width:30%" name="keyword" value="">
            <button type="submit" class="btn btn-success" style="width:6%" name="srchbtn"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
      <div class="overflow-auto">
        <table class="table table-bordered text-center">
          <thead class="table-warning">
            <tr>
              <td class="col">Nomor PO</td>
              <td class="col">Pemesan</td>
              <td class="col">Departement</td>
              <td class="col">Tanggal PO</td>
              <td class="col" style="width:15%">Fitur</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach( $data['po']['data'] as $po) : ?>
              <tr>
                <td><?php print $po['NO_PO'] ?></td>
                <td><?php print $po['PEMESAN'] ?></td>
                <td><?php print $po['NMDEF'] ?></td>
                <td><?php print $po['TGL_PO'] ?></td>
                <td class="d-flex justify-content-evenly">
                  <!--BUTTON DETAIL-->
                    <button type="button" class="btn btn-success dtl" data-id="<?php echo rawurlencode($po['NO_PO']); ?>" data-bs-toggle="modal" data-bs-target="#modalPo" name="button"><i class="fa fa-file"></i></button>
                  <!--BUTTON EDIT-->
                    <button type="button" class="btn btn-primary edt" data-id="<?php echo $po['NO_PO'] ?>" data-bs-toggle="modal" data-bs-target="#editPo" name="button"><i class="fa fa-pen"></i></button>
                  <!--BUTTON HAPUS-->
                    <a href="<?php echo BASEURL; ?>/purchased_order/hapus/<?php echo str_replace('/', '-F', $po['NO_PO']) ?>" class="btn btn-danger" onclick="return confirm('Apa anda yakin?')"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <nav>
          <ul class="pagination justify-content-center">
            <!--TOMBOL PREVIOUS-->
              <?php if ( $data['po']['halamanAktif'] <= 1 ) { ?>
                <li class="page-item disabled">
                  <a href="<?php echo BASEURL; ?>/purchased_order/detail/<?php echo $data['po']['halamanAktif'] - 1 ?>" class="page-link">Prev</a>
                </li>
              <?php } else { ?>
                <li class="page-item">
                  <a href="<?php echo BASEURL; ?>/purchased_order/detail/<?php echo $data['po']['halamanAktif'] - 1 ?>" class="page-link">Prev</a>
                </li>
              <?php } ?>
            <!--TOMBOL NUMBER-->
              <?php for ($i=1; $i <= $data['po']['banyakHal']; $i++) { ?>
                <?php if ( $data['po']['halamanAktif'] = $i ) { ?>
                  <li class="page-item active">
                    <a href="<?php echo BASEURL; ?>/purchased_order/detail/<?php echo $i; ?>" class="page-link"><?php echo $i ?></a>
                  </li>
                <?php } else { ?>
                  <li class="page-item">
                    <a href="<?php echo BASEURL; ?>/purchased_order/detail/<?php echo $i; ?>" class="page-link"><?php echo $i ?></a>
                  </li>
                <?php } ?>
              <?php } ?>
            <!--TOMBOL NEXT-->
              <?php if ( $data['po']['halamanAktif'] == $data['po']['banyakHal']) { ?>
                <li class="page-item disabled">
                  <a href="<?php echo BASEURL; ?>/purchased_order/detail/<?php echo $data['po']['halamanAktif'] + 1 ?>" class="page-link">Next</a>
                </li>
              <?php } else { ?>
                <li class="page-item">
                  <a href="<?php echo BASEURL; ?>/purchased_order/detail/<?php echo $data['po']['halamanAktif'] + 1 ?>" class="page-link">Next</a>
                </li>
              <?php } ?>
          </ul>
        </nav>
      </div>
    </div>

    <!--MODAL EDIT PURCHASED ORDER-->
    <div class="modal fade" id="editPo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">EDIT PURCHASE ORDER</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="" action="<?php echo BASEURL; ?>/purchased_order/ubah" method="post">
              <div class="row">
                <div class="col">
                  <label for="noPo">Nomor PO</label>
                  <input type="text" name="noPo" id="noPo" class="form-control" value="" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label for="tgl_po">Tanggal PO</label>
                  <input type="date" name="tgl_po" id="tgl_po" class="form-control" value="">
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


    <!--MODAL TABEL DETAIL-->
    <div class="modal fade" id="modalPo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content p-3">
            <div class="modal-header">
              <h5 class="modal-title">VIEW DETAIL PO</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="" action="<?php echo BASEURL; ?>/purchased_order/ubahDtl" method="post">
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
                      <th class="col-3">Quantity</th>
                      <th class="col">Terima</th>
                      <th class="col">Satuan</th>
                      <th class="col">Harga</th>
                      <th class="col">Total</th>
                    </tr>
                  </thead>
                </table>
                <!-- <div class="numRow"></div> -->
              </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="edt" name="button" disabled><i class="fa fa-pen"></i> EDIT</button>
                <button type="button" class="btn btn-success" name="button"><i class="fa fa-print"></i> CETAK</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>

</div>
