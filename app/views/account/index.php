<div class="container-fluid px-4">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row mx-auto mt-3">
       <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
       </div>
    </div>

  <!--REGISTRASI FORM-->
    <div class="border border-dark rounded-3 bg-gradient mx-auto mt-3 p-4" style="width:50%">
      <div class="d-flex justify-content-around">
        <h3>REGISTRASI</h3>
        <a href="<?php echo BASEURL; ?>/account/detail/1" class="btn btn-warning">View Table</a>
      </div>
      <hr>
      <form action="<?php echo BASEURL; ?>/account/tambah" method="post">
        <div class="row mb-2 d-flex justify-content-center">
          <div class="col-8">
            <label for="usrName">Username :</label>
            <input type="text"class="form-control" name="usrName" value="" maxlength="6" autocomplete="off">
          </div>
        </div>
        <div class="row mb-2 d-flex justify-content-center">
          <div class="col-8">
            <label for="password">Password :</label>
            <input type="password" class="form-control" name="password" value="" maxlength="6">
          </div>
        </div>
        <div class="row mb-2 d-flex justify-content-center">
          <div class="col-8">
            <label for="dprt">Departement :</label>
            <select class="form-select" name="dprt">
              <option value="" selected disabled>Choose...</option>
              <?php foreach ( $data['dept'] as $dpt ) : ?>
              <option value="<?php print $dpt['KODEF'] ?>"><?php print $dpt['NMDEF'] . " - " . $dpt['Initial'] ?></option>
            <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="row mb-2 d-flex justify-content-center">
          <div class="col-8">
            <label for="level">Level :</label>
            <select class="form-select" name="level">
              <option value="" selected disabled>Choose...</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
        </div>
        <div class="row mb-2 d-flex justify-content-center">
          <div class="col-8">
            <?php $date = date("Y/m/d");
            $newDate = date("Y-m-d", strtotime($date)); ?>
            <label for="tanggal">Date :</label>
            <input type="date" name="tanggal" class="form-control" value="<?php echo $newDate; ?>">
          </div>
        </div>
        <hr>
        <div class="text-end">
          <button type="submit" class="btn btn-primary" name="button">Simpan</button>
        </div>
      </form>
    </div>
    <!--END OF REGISTRASI FORM-->


</div>
