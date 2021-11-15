<div class="container-fluid px-4">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row">
       <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
       </div>
    </div>

  <!--REGISTRASI FORM-->
    <div class="border border-dark rounded-3 bg-gradient p-4" style="width:50%">
      <h3 class="mb-2 d-flex justify-content-center">REGISTRASI</h3>
      <hr>
      <form action="<?php echo BASEURL; ?>/account/tambah" method="post">
        <div class="row mb-2 d-flex justify-content-center">
          <div class="col-8">
            <label for="usrName">Username :</label>
            <input type="text"class="form-control" name="usrName" value="" maxlength="6">
          </div>
        </div>
        <div class="row mb-2 d-flex justify-content-center">
          <div class="col-8">
            <label for="password">Password :</label>
            <input type="password" class="form-control" name="password" value="" maxlength="6">
          </div>
        </div>
        <div class="row mb-3 d-flex justify-content-center">
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
