<div class="container-fluid px-4">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row my-2">
       <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
       </div>
    </div>


<div class="row">

      <!--FORM PURCHASED REQUISITION-->
      <div class="col-md">
        <div class="border border-dark rounded-3 bg-gradient p-3 m-3">
          <div class="d-flex justify-content-around">
            <h3>FORM PURCHASED REQUISITION</h3>
            <div class="text-end">
              <a href="<?php echo BASEURL; ?>/purchased_requisition/detail/1/" class="btn btn-warning">View Table</a>
            </div>
          </div>
          <hr>
          <form class="" action="<?php echo BASEURL; ?>/Purchased_requisition/tambah" method="post">
            <div class="row mb-3">
              <div class="col">
                <label for="noSr">Nomor Sr :</label>
                <select class="form-select" name="noSr" id="noSr" onchange="">
                  <option value="" selected disabled>Choose...</option>
                  <?php foreach( $data['selectSr'] as $sr) : ?>
                    <option value="<?php echo $sr['NO_SR'] ?>"><?php echo $sr['NO_SR'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col">
                <label for="noPr">Nomor PR :</label>
                <input type="text" class="form-control" id="noPr" name="noPr" value="" readonly>
                <input type="hidden" name="" id="hdnPr" value="<?php echo $_SESSION['login']['Initial']; ?>">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="user">Nama :</label>
                <input type="text" class="form-control" name="user" value="<?php echo $_SESSION['login']['USERNAME']; ?>">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="dept">Departement</label>
                <input type="text" class="form-control" name="dept" value="<?php echo $_SESSION['login']['NMDEF']; ?>" readonly>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="sp">Supplier :</label>
                <input type="text" class="form-control" id="sp" name="sp" value="" readonly>
                <input type="hidden" id="hdnSp" name="hdnSp" value="">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <?php $date = date("Y/m/d");
                $newDate = date("Y-m-d", strtotime($date)); ?>
                <label for="tgl_pr">Tanggal PR :</label>
                <input type="date" class="form-control" name="tgl_pr" value="<?php echo $newDate; ?>">
              </div>
            </div>
            <hr>
            <div class="text-end">
              <button type="submit" class="btn btn-primary" name="button">Simpan</button>
            </div>
          </form>
        </div>
      </div>


        <div class="border border-dark rounded-3 bg-gradient p-3 mx-auto m-3">
          <h3>DATA SR</h3>
          <hr>
          <div class="overflow-auto">
            <table class="table table-striped table-hover text-center" id="tabSr">
              <div class="row mb-3">
                <form class="" action="<?php echo BASEURL; ?>/purchased_requisition/1" method="post">
                  <div class="d-flex">
                    <input type="text" class="form-control" name="keyword" style="width:30%" placeholder="Type Number Of SR....." value="" autocomplete="off">
                    <button type="submit" class="btn btn-success" style="width:6%" name="srchBtn"><i class="fa fa-search"></i></button>
                  </div>
                </form>
              </div>
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
                <?php foreach( $data['sr']['data'] as $sr ) : ?>
                  <tr>
                    <td><?php print $sr['NO_SR'] ?></td>
                    <td><?php print $sr['PEMINTA'] ?></td>
                    <td><?php print $sr['NMDEF'] ?></td>
                    <td><?php print $sr['NAMA_SP'] ?></td>
                    <td><?php print $sr['TGL_SR'] ?></td>
                    <td>
                      <button type="button" class="btn btn-primary detail" data-id="<?php echo $sr['NO_SR'] ?>" data-bs-toggle="modal" data-bs-target="#modalSr" name="button">Detail</button>
                    </td>
                  </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
            <nav>
              <ul class="pagination justify-content-center">
                <!--TOMBOL PREVIOUS-->
                  <?php if ( $data['sr']['halamanAktif'] <= 1 ) { ?>
                      <li class="page-item disabled"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $data['sr']['halamanAktif'] - 1; ?>" class="page-link">Prev</a></li>
                  <?php } else { ?>
                      <li class="page-item"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $data['sr']['halamanAktif'] - 1; ?>" class="page-link">Prev</a></li>
                  <?php } ?>
                <!--TOMBOL PAGE-->
                  <?php for ($i=1; $i < $data['sr']['banyakHal']; $i++) { ?>
                    <?php if ( $data['sr']['halamanAktif'] == $i ) { ?>
                      <li class="page-item active"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $i; ?>" class="page-link pgNum"><?php echo $i; ?></a></li>
                    <?php } else { ?>
                      <li class="page-item"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $i; ?>" class="page-link pgNum"><?php echo $i; ?></a></li>
                    <?php } ?>
                  <?php } ?>
                <!--TOMBOL NEXT-->
                  <?php if ( $data['sr']['halamanAktif'] >= $data['sr']['banyakHal'] ) { ?>
                    <li class="page-item disabled"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $data['sr']['halamanAktif'] + 1; ?>" class="page-link">Next</a></li>
                  <?php } else { ?>
                    <li class="page-item"><a href="<?php echo BASEURL; ?>/purchased_requisition/<?php echo $data['sr']['halamanAktif'] + 1; ?>" class="page-link">Next</a></li>
                  <?php } ?>
              </ul>
            </nav>
          </div>
        </div>

      <!--MODAL VIEW DETAIL SR-->
        <div class="modal fade" id="modalSr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content p-3">
                <div class="modal-header">
                  <h5 class="modal-title">VIEW DETAIL SR</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <table class="table table-borderless">
                    <tr>
                      <th class="table-warning col-2">Nomor SR</th>
                      <td class="table-info" id="tbSr"></td>
                    </tr>
                    <tr>
                      <th class="table-warning col-2">Peminta</th>
                      <td class="table-info" id="tbPmnt"></td>
                    </tr>
                    <tr>
                      <th class="table-warning col-2">Departement</th>
                      <td class="table-info" id="tbDept"></td>
                    </tr>
                    <tr>
                      <th class="table-warning col-2">Supplier</th>
                      <td class="table-info" id="tbSpr"></td>
                    </tr>
                  </table>
                  <div class="overflow-auto">
                  <h4>DETAIL PERMINTAAN</h4>
                  <table class="table table-bordered text-center" id="myTabs">
                    <thead class="table-info">
                      <tr>
                        <th class="col">Nama Barang</th>
                        <th class="col">Quantity</th>
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
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>



  </div>

</div>
