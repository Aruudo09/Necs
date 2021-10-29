<div class="container-fluid px-4">

    <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>

<div class="border border-dark rounded-3 bg-gradient mt-4 p-3">
    <!--DATA KELUAR BARANG-->

    <!-- INPUT BARANG KELUAR  -->
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="data-barang">
      <div class="row mb-3 mt-4">
        <div class="col-lg-6">
          <button type="button" class="btn btn-primary" id="tambahBrgKlr" data-bs-toggle="modal" data-bs-target="#modalBrgKlr">
              Input Data Barang Keluar
          </button>
        </div>
      </div>


      <!--VIEW TABLE MASUK BARANG-->
        <h3 class="fs-4 mb-3">Daftar Barang Keluar</h3>
      <!--SEARCH BAR-->
        <div class="row mb-2">
          <div class="col-lg-6">
            <form class="" action="<?php echo BASEURL; ?>/barang_keluar/cari" method="post">
              <div class="input-group mb-2">
              <input type="text" class="form-control" placeholder="cari data.." name="keyword" id="keyword" autocomplete="off" aria-label="Recipient's username" aria-describedby="button-addon2">
              <button class="btn btn-outline-secondary" type="submit" id="tombolCari">Cari</button>
            </div>
            </form>
          </div>
      <!--END SEARCH BAR-->
        </div>
            <table class="table table-hover text-center">
              <thead class="table-info">
                <tr>
                  <th scope="col">No Pemakaian</th>
                  <th scope="col">Nama</th>
                  <th scope="col">No. Ref</th>
                  <th scope="col">Barang</th>
                  <th scope="col">Shift</th>
                  <th scope="col">Posting</th>
                  <th scope="col">Keterangan</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Jumlah pemakaian</th>
                  <th scope="col">Tanggal pemakaian</th>
                  <th scope="col">Fitur</th>
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
                  <td><?php echo $brgK['KETERANGAN']; ?></td>
                  <td><?php echo $brgK['Stock_brg']; ?></td>
                  <td><?php echo $brgK['QUANTITY_MINTA']; ?></td>
                  <td><?php echo $brgK['TANGGAL_OUT']; ?></td>
                  <td scope="row">
                      <a href="#" class="btn btn-success"><i class="fa fa-print"></i></a>
                      <a href="<?php echo BASEURL; ?>/Barang_keluar/hapus/<?php echo $brgK['NOMOR_SLIP']; ?>" class="btn btn-danger" onclick="return confirm('apa anda yakin?')"><i class="fa fa-trash"></i></a>
                      <a href="<?php echo BASEURL; ?>/Barang_keluar/ubah" class="btn btn-primary editBrgKlr" data-bs-toggle="modal" data-bs-target="#modalBrgKlr" data-id="<?php echo $brgK['NOMOR_SLIP']; ?>"><i class="fa fa-pen"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
             </tbody>
            </table>
      <!--VIEW TABLE MASUK BARANG-->

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
             <form class="" action="<?php echo BASEURL; ?>/Barang_keluar/tambah" method="post">
              <!--HIDDEN INPUT NOMOR SLIP-->
               <input type="hidden" name="No_pk" id="No_pk" value="">
              <!--INPUT NOMOR SLIP-->
                 <div class="row mb-3">
                     <div class="form-group">
                         <label for="inputNoPk">No Pemakaian :</label>
                         <?php foreach( $data['counter'] as $cnt) : ?>
                         <input type="text" name="inputNoPk" id="inputNoPk" class="form-control" value="<?php echo $cnt['klr'] . "-" . "K/" . date("y"); ?>">
                       <?php endforeach; ?>
                     </div>
                 </div>
                <!--INPUT BARANG-->
                 <div class="row mb-3">
                     <div class="form-group">
                         <label for="namaBrg">Barang :</label>
                         <select id="namaBrg" class="form-select" name="namaBrg">
                           <?php foreach ( $data['optionBrg'] as $item) : ?>
                           <option value="<?php echo $item['KODE_BRG']; ?>"><?php echo $item['NAMA_BRG']; ?></option>
                         <?php endforeach; ?>
                         </select>
                     </div>
                 </div>
                <!--INPUT SHIFT-->
                 <div class="row mb-3">
                     <div class="form-group">
                         <label for="shift">Shift :</label>
                         <input type="text" name="shift" id="shift" class="form-control">
                     </div>
                 </div>
                <!--INPUT POSTING-->
                 <div class="row mb-3">
                     <div class="form-group">
                         <label for="posting">Posting :</label>
                         <input type="text" name="posting" id="posting" class="form-control" maxlength="1">
                     </div>
                 </div>
                <!--INPUT TANGGAL KELUAR-->
                <?php $date = date("Y/m/d");
                $newDate = date("Y-m-d", strtotime($date)); ?>
                 <div class="row mb-3">
                     <div class="form-group col">
                         <label for="tanggalKeluar">Tanggal Keluar :</label>
                         <input type="date" name="tanggalKeluar" id="tanggalKeluar" class="form-control" value="<?php echo $newDate; ?>">
                     </div>
                 </div>
                <!--INPUT KETERANGAN-->
                 <div class="row mb-3">
                     <div class="form-group">
                         <label for="keterangan">Keterangan :</label>
                         <input type="text" name="keterangan" id="keterangan" class="form-control">
                     </div>
                 </div>
                <!--INPUT NAMA USER-->
                 <div class="row mb-3">
                     <div class="form-group">
                         <label for="nama">Nama :</label>
                         <input type="text" name="nama" id="nama" class="form-control">
                     </div>
                 </div>
                <!--INPUT NOMOR REF-->
                 <div class="row mb-3">
                     <div class="form-group">
                         <label for="noRef">No. Ref :</label>
                         <input type="text" name="noRef" id="noRef" class="form-control">
                     </div>
                 </div>
                <!--INPUT JUMLAH AMBIL-->
                 <div class="row mb-3">
                     <div class="form-group">
                         <label for="qtyMinta">Jumlah Minta :</label>
                         <input type="text" name="qtyMinta" id="qtyMinta" class="form-control">
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
