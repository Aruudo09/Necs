<div class="container-fluid px-4">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row my-2">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>

  <!--TABLE VIEW NOMOR BERITA ACARA-->
  <div class="row">

  <!--FORM INPUT BERITA ACARA-->
        <div class="col">
          <div class="border border-dark rounded-3 bg-gradient p-3 m-2">
            <div class="d-flex justify-content-around">
              <h3>FORM INPUT BERITA ACARA</h3>
              <a href="<?php echo BASEURL; ?>/barang_masuk/detail/1/">
                <button type="button" class="btn btn-warning" id="detail" name="button">View Purchased Order</button>
              </a>
            </div>
            <hr>
            <form class="" action="<?php echo BASEURL; ?>/barang_masuk/tambah" method="post">
             <!--HIDDEN INPUT NOMOR BCRA-->
              <input type="hidden" name="No_msk" id="No_msk" value="">
              <!--INPUT NOMOR PO-->
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="poBa">No. PO :</label>
                          <select class="form-select  " name="poBa" id="poBa" onchange="">
                            <option value="" selected>choose...</option>
                            <?php foreach ( $data['po1'] as $opt) : ?>
                            <option value="<?php print $opt['NO_PO']; ?>"
                              ><?php print $opt['NO_PO']; ?></option>
                           <?php endforeach; ?>
                          </select>
                    </div>
               <!--INPUT NOMOR BCRA-->
                    <div class="col-6">
                        <label for="inputNoMsk">No Masuk :</label>
                        <?php foreach( $data['counter'] as $ct) : ?>
                        <script>
                            var kod = <?php echo json_encode($ct['ba'], JSON_HEX_TAG); ?>;
                            var kod1 = <?php echo json_encode(date("y"), JSON_HEX_TAG); ?>;
                        </script>
                        <?php endforeach; ?>
                        <input type="text" name="inputNoMsk" id="inputNoMsk" class="form-control " value="" readonly>
                    </div>
                </div>
               <!--INPUT NOMOR SURAT JALAN-->
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="noSRJLN">No. Surat Jalan :</label>
                        <input type="text" name="noSRJLN" id="noSRJLN" class="form-control">
                    </div>
                    <!--INPUT TANGGAL TERIMA-->
                     <?php $date = date("Y/m/d");
                     $newDate = date("Y-m-d", strtotime($date)); ?>
                     <div class="col-4">
                         <label for="tanggalTerima">Tanggal Terima :</label>
                         <input type="date" name="tanggalTerima" id="tanggalTerima" class="form-control" value="<?php echo $newDate; ?>">
                     </div>
                </div>
               <!--INPUT PENERIMA-->
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="penerima">Penerima :</label>
                        <input type="text" name="penerima" id="penerima" class="form-control" value="<?php echo $_SESSION['login']['USERNAME'] ?>">
                    </div>
                </div>
                <h3>DAFTAR BARANG</h3>
                  <div class="overflow-auto">
                      <table class="table table-bordered text-center" id="tbBa">
                        <thead class="table-info">
                          <tr>
                            <th class="col-4">Barang</th>
                            <th class="col-4">Harga</th>
                            <th class="col-4">Quantity</th>
                            <th class="col-2">Hapus</th>
                            <th style="display:none">Kode Barang</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!--GENERATE DAFTAR BARANG-->
                        </tbody>
                      </table>
                  </div>
              <hr>
              <div class="row">
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary btnSmpn">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

<!--VIEW TABLE DETAIL BERITA ACARA-->
    <div class="border border-dark rounded-3 bg-white mt-4 mb-3 p-3">
      <h3 class="fs-4 mb-3">DAFTAR BARANG MASUK</h3>
      <form class="" action="<?php echo BASEURL; ?>/barang_masuk/1" method="post">
        <div class="d-flex mb-3">
          <input type="text" class="form-control" style="width:20%" name="keyword" value="">
          <button type="submit" class="btn btn-success" style="width:5%" name="srchbtn"><i class="fa fa-search"></i></button>
        </div>
      </form>
      <div class="overflow-auto">
      <table class="table table-bordered table-responsive table-striped table-hover text-center" id="tbDtlBa">
        <thead class="table-warning">
          <tr>
            <th scope="col">No Masuk</th>
            <th scope="col">No PO</th>
            <th scope="col">No. Surat Jalan</th>
            <th scope="col">Penerima</th>
            <th scope="col">Supplier</th>
            <th scope="col">Tanggal Diterima</th>
            <th scope="col">Fitur</th>
          </tr>
       </thead>

       <tbody>
         <?php foreach ( $data['barangMsk']['data'] as $brgM) : ?>
            <tr>
              <td><?php print $brgM['NO_BCRA']; ?></td>
              <td><?php print $brgM['NO_PO']; ?></td>
              <td><?php print $brgM['NO_SRJLN']; ?></td>
              <td><?php print $brgM['PENERIMA']; ?></td>
              <td><?php print $brgM['NAMA_SP']; ?></td>
              <td><?php print $brgM['TGL_BCRA']; ?></td>
              <td>
                <div class="d-flex justify-content-evenly">
                  <!--DETAIL BARANG MASUK-->
                      <button type="button" class="btn btn-success dtlBa" data-id="<?php echo $brgM['NO_BCRA'] ?>" data-bs-toggle="modal" data-bs-target="#dtlBa" name="button"><i class="fa fa-file"></i></button>
                  <!--EDIT DETAIL BARANG MASUK-->
                      <a class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#modalBrgMsk" data-id="<?php echo $brgM['NO_BCRA'] ?>"><i class="fa fa-pen"></i></a>
                    <!--HAPUS DETAIL BARANG MASUK-->
                      <a href="<?php echo BASEURL; ?>/barang_masuk/hapus/<?php echo str_replace('/', 'F', $brgM['NO_BCRA']) ?>" class="btn btn-danger" onclick="return confirm('apa anda yakin?')"><i class="fa fa-trash"></i></a>
                </div>
              </td>
            </tr>
         <?php endforeach; ?>
       </tbody>
      </table>
      <nav>
        <ul class="pagination justify-content-center">
          <!--TOMBOL PREV-->
            <?php if ( $data['barangMsk']['halamanAktif'] <= 1 ) { ?>
              <li class="page-item disabled">
                <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['barangMsk']['halamanAktif'] - 1 ?>" class="page-link">Prev</a>
              </li>
            <?php } else { ?>
              <li class="page-item">
                <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['barangMsk']['halamanAktif'] - 1 ?>" class="page-link">Prev</a>
              </li>
            <?php } ?>
          <!--TOMBOL PAGE-->
            <?php for ($i=1; $i <= $data['barangMsk']['banyakHal'] ; $i++) { ?>
              <?php if ( $i == $data['barangMsk']['halamanAktif'] ) { ?>
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
            <?php if ( $data['barangMsk']['halamanAktif'] == $data['barangMsk']['banyakHal'] ) { ?>
              <li class="page-item disabled">
                <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['barangMsk']['halamanAktif'] + 1 ?>" class="page-link">Next</a>
              </li>
            <?php } else { ?>
              <li class="page-item">
                <a href="<?php echo BASEURL; ?>/barang_masuk/<?php echo $data['barangMsk']['halamanAktif'] + 1 ?>" class="page-link">Next</a>
              </li>
            <?php } ?>
        </ul>
      </nav>
    </div>
  </div>
<!--END VIEW TABLE BERITA ACARA-->

      <!--MODAL VIEW DETAIL BERITA ACARA-->
      <div class="modal fade" id="dtlBa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">View Detail Berita Acara</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="" action="<?php echo BASEURL; ?>/barang_masuk/ubahDtl" method="post">
                <table class="table table-bordered">
                  <tr>
                    <th class="table-warning col-3">No Masuk</th>
                    <td class="table-info" id="nomsk"></td>
                    <td style="display:none">
                      <input type="hidden" id="no_msk" name="no_msk" value="">
                    </td>
                  </tr>
                  <tr>
                    <th class="table-warning">No Po</th>
                    <td class="table-info" id="nopo"></td>
                  </tr>
                  <tr>
                    <th class="table-warning">No Surat Jalan</th>
                    <td class="table-info" id="nosrjln"></td>
                  </tr>
                  <tr>
                    <th class="table-warning">Penerima</th>
                    <td class="table-info" id="pnrm"></td>
                  </tr>
                  <tr>
                    <th class="table-warning">Supplier</th>
                    <td class="table-info" id="sp"></td>
                  </tr>
                  <tr>
                    <th class="table-warning">Tanggal Terima</th>
                    <td class="table-info" id="tgltrm"></td>
                  </tr>
                </table>
                <h3>Daftar Barang</h3>
                <table class="table table-bordered table-striped text-center" id="tabBa">
                  <thead class="table-info">
                    <tr>
                      <th>Nama Barang</th>
                      <th style="display:none">Kode Barang</th>
                      <th class="col-2">Quantity</th>
                      <th>Satuan</th>
                      <th>Harga</th>
                      <th>Fitur</th>
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
      <!--END MODAL VIEW DETAIL BERITA ACARA-->


      <!-- MODAL NOMOR BERITA ACARA -->
             <div class="modal fade" id="modalBrgMsk" tabindex="-1" role="dialog" aria-labelledby="modalBrgMsk" aria-hidden="true">
             <div class="modal-dialog" >
               <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="labelBcra">Input Barang Masuk</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                   <form class="" action="<?php echo BASEURL; ?>/barang_masuk/ubahTmp" method="post">
                    <!--HIDDEN INPUT NOMOR BCRA-->
                     <input type="hidden" name="nobcra" id="nobcra" value="">
                      <!--INPUT NOMOR SURAT JALAN-->
                       <div class="row mb-3">
                           <div class="form-group">
                               <label for="noSRJLN2">No. Surat Jalan :</label>
                               <input type="text" name="noSRJLN2" id="noSRJLN2" class="form-control">
                           </div>
                       </div>
                      <!--INPUT TANGGAL TERIMA-->
                       <div class="row mb-3">
                         <?php $date = date("Y/m/d");
                         $newDate = date("Y-m-d", strtotime($date)); ?>
                           <div class="form-group">
                               <label for="tanggalTerima2">Tanggal Terima :</label>
                               <input type="date" name="tanggalTerima2" id="tanggalTerima2" class="form-control" value="<?php echo $newDate; ?>">
                           </div>
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
        <!--END MODAL NOMOR BERITA ACARA-->


</div>
