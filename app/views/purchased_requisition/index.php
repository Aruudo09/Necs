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
        <div class="border border-dark rounded-3 bg-gradient p-3 m-3" style="width:70%">
          <div class="d-flex justify-content-around">
            <h3>FORM PURCHASED REQUISITION</h3>
            <div class="text-end">
              <a href="<?php echo BASEURL; ?>/purchased_requisition/detail" class="btn btn-warning">View Table</a>
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
          <div class="overflow-auto">
            <table class="table table-striped table-hover text-center" id="tabSr">
              <h3>DATA SR</h3>
              <hr>
              <thead class="table-warning">
                <tr>
                  <th>Nomor SR</th>
                  <th>Peminta</th>
                  <th>Departement</th>
                  <th>Supplier</th>
                  <th>Tanggal SR</th>
                  <th>Fitur</th>
                </tr>
              </thead>

              <tbody>
                  <?php foreach( $data['sr'] as $sr ) : ?>
                    <tr>
                      <td><?php print $sr['NO_SR'] ?></td>
                      <td><?php print $sr['PEMINTA'] ?></td>
                      <td><?php print $sr['NMDEF'] ?></td>
                      <td><?php print $sr['NAMA_SP'] ?></td>
                      <td><?php print $sr['TGL_SR'] ?></td>
                      <td>
                        <button type="button" class="btn btn-info btn" data-bs-toggle="modal" data-bs-target="#modalSr" data-id="<?php echo $sr['NO_SR'] ?>">Detail</button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>
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
