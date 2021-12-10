<div class="container-fluid px-4">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row my-2">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>

    <!--BUTTON BACK-->
    <a href="<?php echo BASEURL; ?>/barang_masuk/1">
      <button type="button" class="btn btn-success" name="button"><i class="fa fa-arrow-left"> <b>Kembali</b></i></button>
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
                <h3 class="mb-3">LIST PURCHASED ORDER</h3>
                    <thead>
                      <tr class="table-warning ">
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
                    <td><?php print $mhs['TGL_BCRA']; ?></td>
                    <td>
                      <!--DETAIL-->
                        <button type="button" class="btn btn-success" name="button"><i class="fa fa-file"></i></button>
                      <!--EDIT-->
                        <button type="button" class="btn btn-primary" name="button"><i class="fa fa-pen"></i></button>
                      <!--HAPUS-->
                        <button type="button" class="btn btn-danger" name="button"><i class="fa fa-trash"></i></button>
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

</div>
