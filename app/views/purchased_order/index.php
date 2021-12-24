<div class="container-fluid px-4">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row my-2">
       <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
       </div>
    </div>

    <!--FORM INPUT PURCHASED ORDER-->
      <div class="border border-dark rounded-3 p-3 m-3">
        <div class="d-flex justify-content-around">
          <h3>FORM INPUT PURCHASED ORDER</h3>
          <a href="<?php echo BASEURL; ?>/purchased_order/detail/1/" type="button" class="btn btn-warning" name="button">Table View</a>
        </div>
        <hr>
        <form action="<?php echo BASEURL; ?>/Purchased_order/tambah" method="post">
          <div class="row mb-3">
            <div class="col">
              <label for="noPr">Nomor PR :</label>
              <select class="form-select" name="noPr" id="noPr" onchange="">
                <option value="" selected disabled>Choose...</option>
                <?php foreach( $data['pr'] as $pr ) : ?>
                  <option value="<?php echo $pr['NO_PR'] ?>"><?php echo $pr['NO_PR'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col">
              <label for="noPo">Nomor PO :</label>
              <?php foreach( $data['counter'] as $cnt ) : ?>
                <input type="text" class="form-control" name="noPo" value="<?php echo sprintf('%03d', $cnt['po']+1) . "/" . "PROC-U" . "/" . date("m/y"); ?>" readonly>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="pmsn">Pemesan :</label>
              <input type="text" class="form-control" name="pmsn" value="<?php echo $_SESSION['login']['USERNAME'] ?>">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="dept">Departement :</label>
              <input type="text" class="form-control" name="dept" value="<?php echo $_SESSION['login']['NMDEF'] ?>" readonly>
              <input type="hidden" name="hdnDept" value="">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <label for="sp">Supplier</label>
              <select class="form-select" name="Sp" required>
                <option value="" selected disabled>Choose...</option>
                <?php foreach ( $data['sp'] as $sp ) : ?>
                  <option value="<?php echo $sp['KODE_SP'] ?>"><?php echo $sp['NAMA_SP'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col">
              <?php $date = date("Y/m/d");
              $newDate = date("Y-m-d", strtotime($date)); ?>
              <label for="tgl_po">Tanggal PO :</label>
              <input type="date" class="form-control" name="tgl_po" value="<?php echo $newDate; ?>">
            </div>
          </div>
          <div class="row">
            <h3>DAFTAR BARANG</h3>
            <table class="table" id="tbPr">
              <thead class="table-info">
                <tr>
                  <th class="col">Nama Barang</th>
                  <th style="display:none">Kode Barang</th>
                  <th class="col-3">Quantity</th>
                  <th class="col-3">Satuan</th>
                  <th class="col-3">Harga</th>
                  <th class="col">Fitur</th>
                </tr>
              </thead>
              <tbody>
                <!--GENERATE DAFTAR BARANG-->
              </tbody>
            </table>
          </div>
          <hr>
          <div class="text-end">
            <button type="submit" class="btn btn-primary" name="button">Simpan</button>
          </div>
        </form>
      </div>

</div>
