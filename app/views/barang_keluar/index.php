<div class="container-fluid px-4">

    <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row my-2">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>

    <!--DATA KELUAR BARANG-->


      <div class="border border-dark rounded-3 bg-gradient p-3 mt-3">
        <h3>FORM INPUT PENGEBONAN BARANG</h3>
        <hr>
        <form class="" action="<?php echo BASEURL; ?>/Barang_keluar/tambah" method="post">
         <!--HIDDEN INPUT NOMOR SLIP-->
          <input type="hidden" name="No_pk" id="No_pk" value="">
         <!--INPUT NOMOR SLIP-->
            <div class="row mb-3">
                <div class="col-4">
                    <label for="inputNoPk">No Pemakaian :</label>
                    <?php foreach( $data['counter'] as $cnt) : ?>
                    <input type="text" name="inputNoPk" id="inputNoPk" class="form-control" value="<?php echo $cnt['klr'] + 1 . "-" . "K/" . date("y"); ?>" readonly>
                  <?php endforeach; ?>
                </div>
            </div>
            <!--INPUT NAMA USER-->
             <div class="row mb-3">
                 <div class="col-4">
                     <label for="nama">Nama :</label>
                     <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $_SESSION['login']['USERNAME'] ?>">
                 </div>
             </div>
           <!--INPUT SHIFT-->
            <div class="row mb-3">
                <div class="col-3">
                    <label for="shift">Shift :</label>
                    <input type="text" name="shift" id="shift" class="form-control">
                </div>
           <!--INPUT POSTING-->
                <div class="col-3">
                    <label for="posting">Posting :</label>
                    <input type="text" name="posting" id="posting" class="form-control" maxlength="1">
                </div>
            </div>
           <!--INPUT TANGGAL KELUAR-->
           <?php $date = date("Y/m/d");
           $newDate = date("Y-m-d", strtotime($date)); ?>
            <div class="row mb-4">
                <div class="col-3">
                    <label for="tanggalKeluar">Tanggal Keluar :</label>
                    <input type="date" name="tanggalKeluar" id="tanggalKeluar" class="form-control" value="<?php echo $newDate; ?>">
                </div>
           <!--INPUT NOMOR REF-->
                <div class="col-3">
                    <label for="noRef">No. Ref :</label>
                    <input type="text" name="noRef" id="noRef" class="form-control">
                </div>
            </div>
          <!--FIELD INPUT BARANG-->
           <h4>FIELD INPUT BARANG</h4>
              <div class="row mb-3">
                <select id="selectBrg" class="selectBrg" name="namaBrg[]" style="width:30%">
                  <option value="" selected>choose....</option>
                  <?php foreach ( $data['optionBrg'] as $item) : ?>
                  <option value="<?php echo $item['KODE_BRG']; ?>"><?php echo $item['NAMA_BRG']; ?></option>
                <?php endforeach; ?>
                </select>
              </div>
                <table class="table table-bordered text-center m-1 mb-4" id="tabKlr">
                  <thead class="table-info">
                    <tr>
                      <th>Nama Barang</th>
                      <th>Quantity</th>
                      <th>Keterangan</th>
                      <th>Fitur</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!--GENERATE ROW TABLE DATA-->
                  </tbody>
                </table>
             <input type="hidden" value="0" id="num_row">
          <!--FIELD INPUT BARANG-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>

<div class="border border-dark rounded-3 bg-white mt-4 mb-4 p-3">
  <h3 class="fs-4 mb-3">Daftar Barang Keluar</h3>
  <form class="" action="<?php echo BASEURL; ?>/barang_keluar/cari/1" method="post">
    <div class="d-flex mt-2 mb-2">
      <input type="text" class="form-control" name="keyword" style="width:30%" value="">
      <button type="submit" class="btn btn-success" name="srchbtn" style="width:6%"><i class="fa fa-search"></i></button>
    </div>
  </form>
  <div class="overflow-auto">
      <!--VIEW TABLE MASUK BARANG-->
            <table class="table table-responsive table-bordered table-striped table-hover text-center tblBon">
              <thead class="table-warning">
                <tr>
                  <th class="col">No Pemakaian</th>
                  <th class="col">Nama</th>
                  <th class="col">Departement</th>
                  <th class="col">No. Ref</th>
                  <th class="col">Shift</th>
                  <th class="col">Posting</th>
                  <th class="col">Tanggal pemakaian</th>
                  <th class="col" style="width:14%">Fitur</th>
                </tr>
             </thead>
             <tbody>
                <?php foreach ($data['barangKlr']['data'] as $brgK) : ?>
                <tr>
                  <td><?php print $brgK['NOMOR_SLIP']; ?></td>
                  <td><?php print $brgK['NAMA_USER']; ?></td>
                  <td><?php print $brgK['NMDEF']; ?></td>
                  <td><?php print $brgK['NO_REF']; ?></td>
                  <td><?php print $brgK['SHIFT']; ?></td>
                  <td><?php print $brgK['POSTING']; ?></td>
                  <td><?php print $brgK['TANGGAL_OUT']; ?></td>
                  <td class="d-flex justify-content-evenly">
                    <!--Detail-->
                        <button type="button" class="btn btn-success detail" data-id="<?php echo $brgK['NOMOR_SLIP'] ?>" data-bs-toggle="modal" data-bs-target="#detailKlr" name="button"><i class="fa fa-file"></i></button>
                    <!--EDIT-->
                      <a class="btn btn-primary editBrgKlr" data-bs-toggle="modal" data-bs-target="#modalBrgKlr" data-id="<?php echo $brgK['NOMOR_SLIP']; ?>"><i class="fa fa-pen"></i></a>
                    <!--HAPUS-->
                      <a href="<?php echo BASEURL; ?>/barang_keluar/hapus/<?php echo str_replace('/', '-F', $brgK['NOMOR_SLIP']); ?>" class="btn btn-danger hps" onclick="return confirm('apa anda yakin?')"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
             </tbody>
            </table>
            <nav>
              <ul class="pagination justify-content-center page">
                <!--TOMBOL PREV-->
                  <?php if ( $data['barangKlr']['halamanAktif'] <= 1 ) { ?>
                    <li class="page-item disabled">
                      <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['barangKlr']['halamanAktif'] - 1 ?>" class="page-link pgPrev">Prev</a>
                    </li>
                  <?php } else { ?>
                    <li class="page-item">
                      <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['barangKlr']['halamanAktif'] - 1 ?>" class="page-link pgPrev">Prev</a>
                    </li>
                  <?php } ?>
                <!--TOMBOL PAGE-->
                  <?php for ($i=1; $i <= $data['barangKlr']['banyakHal'] ; $i++) { ?>
                    <?php if ( $i == $data['barangKlr']['halamanAktif'] ) { ?>
                      <li class="page-item active">
                        <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $i ?>" class="page-link pgNum"><?php echo $i; ?></a>
                      </li>
                    <?php } else { ?>
                      <li class="page-item">
                        <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $i ?>" class="page-link pgNum"><?php echo $i; ?></a>
                      </li>
                    <?php } ?>
                  <?php } ?>
                <!--TOMBOL NEXT-->
                  <?php if ( $data['barangKlr']['halamanAktif'] == $data['barangKlr']['banyakHal'] ) { ?>
                    <li class="page-item disabled">
                      <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['barangKlr']['halamanAktif'] + 1 ?>" class="page-link pgNext">Next</a>
                    </li>
                  <?php } else { ?>
                    <li class="page-item">
                      <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['barangKlr']['halamanAktif'] + 1 ?>" class="page-link pgNext">Next</a>
                    </li>
                  <?php } ?>
              </ul>
            </nav>
          </div>
  </div>


<!-- Modal -->
       <div class="modal fade" id="modalBrgKlr" tabindex="-1" role="dialog" aria-labelledby="modalBrgKlr" aria-hidden="true">
       <div class="modal-dialog" >
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="modalLabelBrgKlr">Input Barang Keluar</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
             <form class="" action="<?php echo BASEURL; ?>/Barang_keluar/ubahTmp" method="post">
               <!--INPUT NOMOR SLIP-->
                <div class="row mb-2">
                  <label for="inputNoKlr">Nomor Slip :</label>
                  <input type="text" class="form-control" name="inputNoKlr" id="inputNoKlr" value="" readonly>
                </div>
               <!--INPUT TANGGAL-->
                <div class="row mb-2">
                  <label for="tglKlr">Tanggal :</label>
                  <input type="date" class="form-control" name="tglKlr" id="tglKlr" value="">
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

      <!--VIEW DETAIL BARANG KELUAR-->
      <div class="modal fade" id="detailKlr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail Pengebonan Barang</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="" action="<?php echo BASEURL; ?>/barang_keluar/ubah" method="post">
                <table class="table table-bordered mb-3">
                  <tr>
                    <th class="table-warning col-3">Nomor Slip</th>
                    <td class="table-info" id="noslip"></td>
                    <td style="display:none">
                      <input type="hidden" name="noslip" id="hdnnoslip" value="">
                    </td>
                  </tr>
                  <tr>
                    <th class="table-warning">Nama</th>
                    <td class="table-info" id="namaDtl"></td>
                  </tr>
                  <tr>
                    <th class="table-warning">Departemen</th>
                    <td class="table-info" id="dept"></td>
                  </tr>
                  <tr>
                    <th class="table-warning">Shift</th>
                    <td class="table-info" id="shiftDtl"></td>
                  </tr>
                  <tr>
                    <th class="table-warning">Posting</th>
                    <td class="table-info" id="post"></td>
                  </tr>
                  <tr>
                    <th class="table-warning">No Ref</th>
                    <td class="table-info" id="noref"></td>
                  </tr>
                  <tr>
                    <th class="table-warning">Tanggal</th>
                    <td class="table-info" id="tgl"></td>
                  </tr>
                </table>
                <h3>Daftar Barang</h3>
                <table class="table text-center" id="tabDtl">
                  <thead class="table-info">
                    <tr>
                      <th class="col">Nama Barang</th>
                      <th class="col-2">Quantity</th>
                      <th class="col">Satuan</th>
                      <th class="col">fitur</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="editDtl"><i class="fa fa-pen"> Edit</i></button>
                <button type="button" class="btn btn-success" name="button"><i class="fa fa-print"> Cetak</i></button>
              </div>
            </form>
          </div>
        </div>
      </div>

</div>
