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
                    <input type="text" name="inputNoPk" id="inputNoPk" class="form-control" value="<?php echo $cnt['klr'] . "-" . "K/" . date("y"); ?>" readonly>
                  <?php endforeach; ?>
                </div>
            </div>
            <!--INPUT NAMA USER-->
             <div class="row mb-3">
                 <div class="col-4">
                     <label for="nama">Nama :</label>
                     <input type="text" name="nama" id="nama" class="form-control">
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
          <div class="border border-dark rounded-3 bg-gradient p-3 mt-3">
            <h6>FIELD INPUT BARANG</h6>
            <div class="row mb-2">
              <div class="col-5">
                <select id="selectBrg" class="form-select selectBrg" name="namaBrg[]" style="width: 80%">
                  <option value="" selected>choose....</option>
                  <?php foreach ( $data['optionBrg'] as $item) : ?>
                  <option value="<?php echo $item['KODE_BRG']; ?>"><?php echo $item['NAMA_BRG']; ?></option>
                <?php endforeach; ?>
                </select>
              </div>
              <div class="col-1">
                <button type="button" name="remove" class="btn btn-danger remove"><i class="fas fa-minus"></i></button>
              </div>
            </div>
             <div id="add_row" class="row mb-4"></div>
             <input type="hidden" value="0" id="num_row">
           </div>
          <!--FIELD INPUT BARANG-->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>

<div class="border border-dark rounded-3 bg-white mt-4 mb-4 p-3">
  <div class="overflow-auto">
      <!--VIEW TABLE MASUK BARANG-->
            <table class="table table-responsive table-bordered table-striped table-hover text-center tblBon">
              <h3 class="fs-4 mb-3">Daftar Barang Keluar</h3>
              <thead class="table-warning">
                <tr>
                  <th class="col-7">No Pemakaian</th>
                  <th class="col-7">Nama</th>
                  <th class="col-7">No. Ref</th>
                  <th class="col-7">Barang</th>
                  <th class="col-7">Shift</th>
                  <th class="col-7">Posting</th>
                  <th class="col-7">Stock</th>
                  <th class="col-7">Jumlah pemakaian</th>
                  <th class="col-7">Tanggal pemakaian</th>
                  <th class="col-7">Keterangan</th>
                  <th class="col-7">Fitur</th>
                </tr>
             </thead>
             <tbody>
                <?php foreach ($data['barangKlr'] as $brgK) : ?>
                <tr>
                  <td><?php echo $brgK['NOMOR_SLIP']; ?></td>
                  <td><?php echo $brgK['NAMA_USER']; ?></td>
                  <td><?php echo $brgK['NO_REF']; ?></td>
                  <td><?php echo $brgK['NAMA_BRG']; ?></td>
                  <td><?php echo $brgK['SHIFT']; ?></td>
                  <td><?php echo $brgK['POSTING']; ?></td>
                  <td><?php echo $brgK['Stock_brg']; ?></td>
                  <td><?php echo $brgK['QUANTITY_MINTA']; ?></td>
                  <td><?php echo $brgK['TANGGAL_OUT']; ?></td>
                  <td><?php echo $brgK['KETERANGAN']; ?></td>
                  <td style="width:14%">
                    <div class="d-flex justify-content-evenly">
                    <!--PRINT-->
                      <div class="col ">
                        <a href="#" class="btn btn-success"><i class="fa fa-print"></i></a>
                      </div>
                    <!--HAPUS-->
                    <div class="col">
                      <a class="btn btn-danger hps" onclick="return confirm('apa anda yakin?')" data-id="<?php echo $brgK['NOMOR_SLIP']; ?>" data-brg="<?php echo $brgK['KODE_BRG']; ?>"><i class="fa fa-trash"></i></a>
                    </div>
                    <!--EDIT-->
                    <div class="col">
                      <a class="btn btn-primary editBrgKlr" data-bs-toggle="modal" data-bs-target="#modalBrgKlr" data-id="<?php echo $brgK['NOMOR_SLIP']; ?>" data-kd="<?php echo $brgK['KODE_BRG']; ?>"><i class="fa fa-pen"></i></a>
                    </div>
                  </div>
                  </td>
                </tr>
                <?php endforeach; ?>
             </tbody>
            </table>
          </div>
      <!--VIEW TABLE MASUK BARANG-->

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
             <form class="" action="<?php echo BASEURL; ?>/Barang_keluar/tambah" method="post">
              <!--HIDDEN INPUT NOMOR SLIP-->
               <input type="hidden" name="kd_brg" id="kd_brg" value="">
              <!--INPUT NOMOR SLIP-->
                 <div class="row mb-3">
                     <div class="form-group">
                         <label for="inputNoPk2">No Pemakaian :</label>
                         <?php foreach( $data['counter'] as $cnt) : ?>
                         <input type="text" name="inputNoPk2" id="inputNoPk2" class="form-control" value="<?php echo $cnt['klr'] . "-" . "K/" . date("y"); ?>">
                       <?php endforeach; ?>
                     </div>
                 </div>
                 <!--INPUT NAMA USER-->
                  <div class="row mb-3">
                      <div class="form-group">
                          <label for="nama2">Nama :</label>
                          <input type="text" name="nama2" id="nama2" class="form-control">
                      </div>
                  </div>
                <!--INPUT SHIFT-->
                 <div class="row mb-3">
                     <div class="col-6">
                         <label for="shift2">Shift :</label>
                         <input type="text" name="shift2" id="shift2" class="form-control">
                     </div>
                <!--INPUT POSTING-->
                     <div class="col-6">
                         <label for="posting2">Posting :</label>
                         <input type="text" name="posting2" id="posting2" class="form-control" maxlength="1">
                     </div>
                 </div>
                <!--INPUT TANGGAL KELUAR-->
                <?php $date = date("Y/m/d");
                $newDate = date("Y-m-d", strtotime($date)); ?>
                 <div class="row mb-3">
                     <div class="col-6">
                         <label for="tanggalkeluar2">Tanggal Keluar :</label>
                         <input type="date" name="tanggalkeluar2" id="tanggalkeluar2" class="form-control" value="<?php echo $newDate; ?>">
                     </div>
                <!--INPUT NOMOR REF-->
                     <div class="col-6">
                         <label for="noRef2">No. Ref :</label>
                         <input type="text" name="noRef2" id="noRef2" class="form-control">
                     </div>
                 </div>
                 <!--INPUT BARANG-->
                  <div class="row mb-3">
                      <div class="col-5">
                          <label for="namaBrg2">Barang :</label>
                          <select id="namaBrg2" class="form-select" name="namaBrg2">
                            <?php foreach ( $data['optionBrg'] as $item) : ?>
                            <option value="<?php echo $item['KODE_BRG']; ?>"><?php echo $item['NAMA_BRG']; ?></option>
                          <?php endforeach; ?>
                          </select>
                      </div>
                <!--INPUT JUMLAH AMBIL-->
                     <div class="col-5">
                         <label for="qtyMinta2">Jumlah Minta :</label>
                         <input type="text" name="qtyMinta2" id="qtyMinta2" class="form-control">
                     </div>
                 <!--INPUT KETERANGAN-->
                      <div class="col-6">
                          <label for="keterangan2">Keterangan :</label>
                          <input type="text" name="keterangan2" id="keterangan2" class="form-control">
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

</div>
