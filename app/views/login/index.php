<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title></title>
  </head>

<div class="container px-4">

  <body>

    <!--MENAMPILKAN FLASH MESSAGE-->
      <div class="row d-flex justify-content-center mx-auto">
         <div class="col-lg-6">
            <?php FLASHER::flash(); ?>
         </div>
      </div>

    <!--FORM LOGIN-->
        <div class="border border-dark rounded-3 bg-secondary px-4 mt-5 mx-auto text-white" style="width:50%">
          <h3 class="d-flex justify-content-center mt-4 ml-4">LOGIN</h3>
          <hr>
          <form class="" action="<?php echo BASEURL; ?>/login/cek" method="post">
            <div class="row d-flex justify-content-center mb-3">
              <div class="col-7">
                <label for="usrName">Username :</label>
                <input type="text" name="usrName" class="form-control" value="" autocomplete="off">
              </div>
            </div>
            <div class="row d-flex justify-content-center mb-3">
              <div class="col-7">
                <label for="password">Password :</label>
                <input type="password" name="password" class="form-control" value="">
              </div>
            </div>
            <hr>
            <div class="text-end mb-4">
              <button type="submit" class="btn btn-primary" name="button">Login</button>
            </div>
          </form>
        </div>
    <!--END FORM LOGIN-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  </body>

</div>

</html>
