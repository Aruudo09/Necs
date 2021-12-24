<div class="container-fluid px-4">

  <!--BUTTON KEMBALI-->
    <button type="button" class="btn btn-success mt-3" id="back" name="button"><i class="fa fa-arrow-left"></i> <b>Kembali</b></button>

    <!--MENAMPILKAN FLASH MESSAGE-->
      <div class="row my-2">
         <div class="col-lg-6">
            <?php FLASHER::flash(); ?>
         </div>
      </div>


  <!--TABLE VIEW PURCHASED REQUEST-->
    <div class="border border-dark rounded-3 bg-gradient p-3 mx-auto m-3">
      <h3>DAFTAR PURCHASED REQUISITION</h3>
      <hr>
      <div class="row mb-3">
        <form class="" action="<?php echo BASEURL; ?>/purchased_requisition/detail/1" method="post">
          <div class="d-flex">
            <input type="text" class="form-control" style="width:30%" placeholder="Type Number Of PR....." name="keyword" value="">
            <button type="submit" class="btn btn-success" style="width:6%" name="srchbtn"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
      <div class="overflow-auto">
        <table class="table table-bordered table-striped table-hover text-center">
          <thead class="table-warning">
            <tr>
              <th class="col">Nomor PR</th>
              <th class="col">User</th>
              <th class="col">Departement</th>
              <th class="col">Tanggal PR</th>
              <th class="col-2">Fitur</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach( $data['pr']['data'] as $pr ) : ?>
              <tr>
                <td><?php print $pr['NO_PR'] ?></td>
                <td><?php print $pr['USER'] ?></td>
                <td><?php print $pr['NMDEF'] ?></td>
                <td><?php print $pr['TGL_PR'] ?></td>
                <td class="d-flex justify-content-evenly">
                  <!--TOMBOL DETAIL-->
                    <button type="button" class="btn btn-success detail" data-id="<?php echo $pr['NO_PR'] ?>" data-bs-toggle="modal" data-bs-target="#detailPr" name="button"><i class="fa fa-file"></i></button>
                  <!--TOMBOL EDIT-->
                    <button type="button" class="btn btn-primary edit" data-id="<?php echo $pr['NO_PR'] ?>" data-bs-toggle="modal" data-bs-target="#modalpr" name="button"><i class="fa fa-pen"></i></button>
                  <!--TOMBOL HAPUS-->
                    <a href="<?php echo BASEURL; ?>/purchased_requisition/hapus/<?php echo str_replace('/', '-F', $pr['NO_PR']) ?>" class="btn btn-danger" onclick="return confirm('Apa anda yakin?')"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <nav>
          <ul class="pagination justify-content-center">
            <!--TOMBOL PREVIOUS-->
              <?php if ( $data['pr']['halamanAktif'] <= 1 ) { ?>
                  <li class="page-item disabled"><a href="<?php echo BASEURL; ?>/purchased_requisition/detail/<?php echo $data['pr']['halamanAktif'] - 1; ?>" class="page-link">Prev</a></li>
              <?php } else { ?>
                  <li class="page-item"><a href="<?php echo BASEURL; ?>/purchased_requisition/detail/<?php echo $data['pr']['halamanAktif'] - 1; ?>" class="page-link">Prev</a></li>
              <?php } ?>
            <!--TOMBOL PAGE-->
              <?php for ($i=1; $i <= $data['pr']['banyakHal']; $i++) { ?>
                <?php if ( $data['pr']['halamanAktif'] == $i ) { ?>
                  <li class="page-item active"><a href="<?php echo BASEURL; ?>/purchased_requisition/detail/<?php echo $i; ?>" class="page-link pgNum"><?php echo $i; ?></a></li>
                <?php } else { ?>
                  <li class="page-item"><a href="<?php echo BASEURL; ?>/purchased_requisition/detail/<?php echo $i; ?>" class="page-link pgNum"><?php echo $i; ?></a></li>
                <?php } ?>
              <?php } ?>
            <!--TOMBOL NEXT-->
              <?php if ( $data['pr']['halamanAktif'] >= $data['pr']['banyakHal'] ) { ?>
                <li class="page-item disabled"><a href="<?php echo BASEURL; ?>/purchased_requisition/detail/<?php echo $data['pr']['halamanAktif'] + 1; ?>" class="page-link">Next</a></li>
              <?php } else { ?>
                <li class="page-item"><a href="<?php echo BASEURL; ?>/purchased_requisition/detail/<?php echo $data['pr']['halamanAktif'] + 1; ?>" class="page-link">Next</a></li>
              <?php } ?>
          </ul>
        </nav>
      </div>
    </div>

  <!--MODAL VIEW DETAIL PR-->
  <div class="modal fade" id="detailPr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">VIEW DETAIL PR</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>
              <th class="table-warning col-2">Nomor PR</th>
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
          <h3>INFO DETAIL PR</h3>
          <div class="overflow-auto">
            <table class="table table-bordered text-center" id="myTabs">
              <thead class="table-info">
                <tr>
                  <th class="col">Nama Barang</th>
                  <th class="col">Quantity</th>
                  <th class="col">Satuan</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!--MODAL EDIT PR-->
  <div class="modal fade" id="modalpr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">EDIT PURCHASED REQUISITION</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="" action="<?php echo BASEURL; ?>/purchased_requisition/ubah" method="post">
            <div class="row mb-2">
              <div class="col">
                <label for="nmPr">Nomor PR :</label>
                <input type="text" class="form-control" id="nmPr" name="nmPr" value="" readonly>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <label for="usr">User :</label>
                <input type="text" class="form-control" id="usr" name="usr" value="">
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <label for="tgl_pr">Tanggal PR :</label>
                <input type="date" class="form-control" id="tgl_pr" name="tgl_pr" value="">
              </div>
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
