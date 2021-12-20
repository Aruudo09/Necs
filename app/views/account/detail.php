<div class="container-fluid">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row mx-auto mt-3">
       <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
       </div>
    </div>

    <!--VIEW TABLE-->
    <div class="border border-dark rounded-3 mx-auto p-4">
      <h3>DAFTAR USER</h3>
      <hr>
      <form class="" action="<?php echo BASEURL; ?>/account/detail/1" method="post">
        <div class="d-flex mb-2">
          <input type="text" class="form-control" name="keyword" style="width:30%" value="">
          <button type="submit" class="btn btn-success" style="width:6%" name="srchbtn"><i class="fa fa-search"></i></button>
        </div>
      </form>
      <div class="auto-overflow">
        <table class="table table-bordered table-striped table-hover text-center">
          <thead class="table-warning">
            <th>User Name</th>
            <th>Departement</th>
            <th>Level</th>
            <th>Tanggal Buat</th>
            <th>Fitur</th>
          </thead>
          <tbody>
            <?php foreach( $data['usr']['data'] as $dt ) : ?>
              <tr>
                <td><?php print $dt['USERNAME'] ?></td>
                <td><?php print $dt['NMDEF'] ?></td>
                <td><?php print $dt['level'] ?></td>
                <td><?php print $dt['CREATE_DATE'] ?></td>
                <td class="d-flex justify-content-evenly">
                  <!--EDIT BUTTON-->
                    <button type="button" class="btn btn-primary edt" data-id="<?php echo $dt['USER_ID'] ?>" data-bs-toggle="modal" data-bs-target="#edtUsr" name="button"><i class="fa fa-pen"></i></button>
                  <!--HAPUS BUTTON-->
                    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <nav>
        <ul class="pagination justify-content-center">
          <!--TOMBOL PREV-->
            <?php if ( $data['usr']['halamanAktif'] <= 1 ) { ?>
              <li class="page-item disabled">
                <a href="<?php echo BASEURL; ?>/account/<?php echo $data['usr']['halamanAktif'] - 1 ?>" class="page-link pgPrev">Prev</a>
              </li>
            <?php } else { ?>
              <li class="page-item">
                <a href="<?php echo BASEURL; ?>/account/<?php echo $data['usr']['halamanAktif'] - 1 ?>" class="page-link pgPrev">Prev</a>
              </li>
            <?php } ?>
          <!--TOMBOL PAGE-->
            <?php for ($i=1; $i <= $data['usr']['banyakHal'] ; $i++) { ?>
              <?php if ( $i == $data['usr']['halamanAktif'] ) { ?>
                <li class="page-item active">
                  <a href="<?php echo BASEURL; ?>/account/<?php echo $i ?>" class="page-link pgNum"><?php echo $i ?></a>
                </li>
              <?php } else { ?>
                <li class="page-item">
                  <a href="<?php echo BASEURL; ?>/account/<?php echo $i ?>" class="page-link pgNum"><?php echo $i ?></a>
                </li>
              <?php } ?>
            <?php } ?>
          <!--TOMBOL NEXT-->
            <?php if ( $data['usr']['halamanAktif'] == $data['usr']['banyakHal'] ) { ?>
              <li class="page-item disabled">
                <a href="<?php echo BASEURL; ?>/account/<?php echo $data['usr']['halamanAktif'] + 1 ?>" class="page-link pgNext">Next</a>
              </li>
            <?php } else { ?>
              <li class="page-item">
                <a href="<?php echo BASEURL; ?>/account/<?php echo $data['usr']['halamanAktif'] + 1 ?>" class="page-link pgNext">Next</a>
              </li>
            <?php } ?>
        </ul>
      </nav>
    </div>

    <!--MODAL EDIT AKUN-->
    <div class="modal fade" id="edtUsr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="px-2" action="<?php echo BASEURL; ?>/account/edit" method="post">
              <!--HIDDEN INPUT-->
                <input type="hidden" name="hdnID" id="hdnID" value="">
              <!---->
              <div class="row mb-2">
                <label for="usr">User Name :</label>
                <input type="text" class="form-control" id="usr" name="usr" value="">
              </div>
              <div class="row mb-2">
                <label for="password">Password :</label>
                <input type="password" class="form-control" name="password" value="">
              </div>
              <div class="row mb-2">
                <label for="dept">Departement :</label>
                <select class="form-select" name="dept" id="dept">
                  <option value="" selected disabled>Choose...</option>
                <?php foreach ( $data['dept'] as $dpt ) : ?>
                  <option value="<?php print $dpt['KODEF'] ?>"><?php print $dpt['NMDEF'] . " - " . $dpt['Initial'] ?></option>
                <?php endforeach; ?>
                </select>
              </div>
              <div class="row mb-2">
                <label for="level">Level :</label>
                <select class="form-select" name="level">
                  <option value="" selected disabled>Choose...</option>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
         </form>
        </div>
      </div>
    </div>

</div>
