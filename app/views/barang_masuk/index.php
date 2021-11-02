<div class="container-fluid px-4">

  <!--MENAMPILKAN FLASH MESSAGE-->
    <div class="row">
        <div class="col-lg-6">
          <?php FLASHER::flash(); ?>
        </div>
    </div>

  <!--TABLE VIEW NOMOR BERITA ACARA-->
  <div class="border border-dark rounded-3 bg-gradient p-3 mt-3">

    <!--TOMBOL TAMBAH NOMOR BA-->
        <!-- <div class="row mb-3">
          <div class="col-lg-6">
            <button type="button" class="btn btn-primary" id="tambahBa" data-bs-toggle="modal" data-bs-target="#modalBrgMsk">
                Tambah Data
            </button>
          </div>
        </div> -->
    <!---END TOMBOL TAMBAH NOMOR BA-->

  <!--TABLE VIEW BERITA ACARA-->
    <div class="row">
      <div class="overflow-auto">
        <h3>BERITA ACARA</h3>
          <table class="table text-center table-hover">
                <thead>
                  <tr class="table-warning ">
                    <th scope="col">No. PO</th>
                    <th scope="col">Nomor</th>
                    <th scope="col">Surat Jalan</th>
                    <th scope="col">Supplier</th>
                    <th scope="col" style="display:none">Kode Supplier</th>
                    <th scope="col">Tanggal Terima</th>
                    <th scope="col">Penerima</th>
                    <th scope="col">Fitur</th>
                  </tr>
                </thead>
                <tbody>
              <?php foreach( $data['bcraTmp'] as $mhs ) : ?>
                <tr class="tableViewDtlBcra">
                <td class="poBcraTmp"><?php print $mhs['NO_PO']; ?></td>
                <td class="noBcraTmp"><?php print $mhs['NO_BCRA']; ?></td>
                <td class="srjBcraTmp"><?php print $mhs['NO_SRJLN']; ?></td>
                <td><?php print $mhs['NAMA_SP'];?></td>
                <td class="spBcraTmp" style="display:none"><?php print $mhs['KODE_SP'];?></td>
                <td class="tglBcraTmp"><?php print $mhs['TGL_BCRA']; ?></td>
                <td class="pnmBcraTmp"><?php print $mhs['PENERIMA']; ?></td>
                <td>
      <!--TOMBOL UPDATE-->
                  <a href="<?php echo BASEURL; ?>/Barang_masuk/ubah/<?php echo $mhs['NO_PO']; ?>"
                class="btn btn-primary bcraTmpUpdate" data-bs-toggle="modal" data-bs-target="#modalBrgMsk"
                data-id="<?php echo $mhs['NO_BCRA']; ?>"><i class="fa fa-pen"></i></a>
      <!--TOMBOL HAPUS-->
                  <a href="<?php echo BASEURL; ?>/Barang_masuk/hapus/<?php echo $mhs['NO_BCRA']; ?>"
                class="btn btn-danger" onclick="return confirm('apa anda yakin?');"><i class="fa fa-trash"></i></a>
              </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
      </div>
  </div>
<!--END TABLE VIEW BERITA ACARA-->

  <!--FORM INPUT BERITA ACARA-->
  <div class="border border-dark rounded-3 bg-gradient p-3 mt-3">
    <h3>FORM INPUT BERITA ACARA</h3>
    <form class="" action="<?php echo BASEURL; ?>/barang_masuk/tambah" method="post">
     <!--HIDDEN INPUT NOMOR BCRA-->
      <input type="hidden" name="No_msk" id="No_msk" value="">
      <!--INPUT NOMOR PO-->
        <div class="row mb-3">
            <div class="col-4">
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
            <div class="col-4">
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
                <input type="text" name="penerima" id="penerima" class="form-control">
            </div>
        </div>

    <!--INPUT FIELD BARANG-->
      <table class="mb-2">
        <tr>
          <td><label for="optBrg">Barang :</label></td>
          <td><label for="hrgBl">Harga :</label></td>
          <td><label for="qty">Quantity</label></td>
        </tr>

        <tr>
          <td><select class="form-select" name="brg[]" id="optBrg">
            <option value="" selected>choose.......</option>
          </select></td>
          <td><input type="number" name="hrgBl[]" id="hrgBl" class="form-control" value=""></td>
          <td><input type="number" name="qty[]" class="form-control" id="qty" value=""></td>
          <td><button type="button" name="add[]" class="btn btn-success add"><i class="fas fa-plus"></i></button></td>
          <td><button type="button" name="remove" class="btn btn-danger remove"><i class="fas fa-minus"></i></button></td>
        </tr>
      </table>
      <div id="new_row"class="mb-3"></div>
      <input type="hidden" value="1" id="num_row">
    <!--END INPUT FIELD BARANG-->
    <button type="submit" class="btn btn-primary">Save changes</button>
  </form>
<!--END FORM INPUT BERITA ACARA-->
</div>
</div>


<!--TABLE VIEW LIST PURCHASED ORDER-->
  <div class="border border-dark rounded-3 bg-gradient mt-4 p-3">
    <div class="row">
      <div class="">
        <h3>LIST PURCHASED ORDER</h3>
      <!--SEARCH BAR-->
        <div class="row mb-2">
          <div class="col-lg-6">
              <form class="" action="<?php echo BASEURL; ?>/barang_masuk/cari" method="post">
                <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="cari data.." name="keyword" id="keyword" autocomplete="off" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="tombolCari">Cari</button>
                </div>
              </form>
            </div>
          </div>
      <!---SEARCH BAR-->
          <table class="table table-bordered table-responsive text-center table-hover">
                <thead>
                  <tr class="table-warning ">
                    <th scope="col">No. PO</th>
                    <th scope="col">Supplier</th>
                    <th scope="col" style="display:none">Kode Supplier</th>
                    <th scope="col">Barang</th>
                    <th scope="col" style="display:none">Kode Barang</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Order</th>
                    <th scope="col">Terima</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Harga Order</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
              <?php foreach( $data['po'] as $mhs ) : ?>
                <tr class="tableViewPo">
                <td class="kdPo"><?php print $mhs['NO_PO']; ?></td>
                <td><?php print $mhs['NAMA_SP']; ?></td>
                <td class="kdSp" style="display:none"><?php print $mhs['KODE_SP']; ?></td>
                <td class="nmBrg"><?php print $mhs['NAMA_BRG']; ?></td>
                <td class="kdBrg" style="display:none"><?php print $mhs['KODE_BRG']; ?></td>
                <td><?php print $mhs['Jenis_brg']; ?></td>
                <td><?php print $mhs['Stock_brg']; ?></td>
                <td><?php print $mhs['QTY_ORDER']; ?></td>
                <td class="kdTrm"><?php print $mhs['QTY_TERIMA']; ?></td>
                <td><?php print $mhs['Satuan']; ?></td>
                <td class="kdHrg"><?php print $mhs['HARGA_PO']; ?></td>
                <td><?php print $mhs['TOT_HARGA']; ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
          </table>
      </div>
    </div>
</div>

<!--VIEW TABLE DETAIL BERITA ACARA-->
<div class="border border-dark rounded-3 bg-gradient mt-4 p-3">
  <h3 class="fs-4 mb-2">DAFTAR BARANG MASUK</h3>
  <!--SEARCH BAR-->
  <div class="row mb-2">
    <div class="col-lg-6">
        <form class="" action="<?php echo BASEURL; ?>/barang_masuk/cari" method="post">
          <div class="input-group mb-2">
          <input type="text" class="form-control" placeholder="cari data.." name="keyword" id="keyword" autocomplete="off" aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn btn-outline-secondary" type="submit" id="tombolCari">Cari</button>
          </div>
        </form>
      </div>
    </div>
    <!--END SEARCH BAR-->
      <table class="table table-hover text-center">
        <thead class="table-info">
          <tr>
            <th scope="col">No Masuk</th>
            <th scope="col">Tanggal Diterima</th>
            <th scope="col">Penerima</th>
            <th scope="col">No PO</th>
            <th scope="col">Supplier</th>
            <th scope="col">Barang</th>
            <th scope="col">Quantity</th>
            <th scope="col">No. Surat Jalan</th>
            <th scope="col">Fitur</th>
          </tr>
       </thead>

       <tbody>
         <?php foreach ( $data['barangMsk'] as $brgM) : ?>
            <tr>
              <td><?php echo $brgM['NO_BCRA']; ?></td>
              <td><?php echo $brgM['TGL_BCRA']; ?></td>
              <td><?php echo $brgM['PENERIMA']; ?></td>
              <td><?php echo $brgM['NO_PO']; ?></td>
              <td><?php echo $brgM['NAMA_SP']; ?></td>
              <td><?php echo $brgM['NAMA_BRG']; ?></td>
              <td><?php echo $brgM['QTY_TERIMA']; ?></td>
              <td><?php echo $brgM['NO_SRJLN']; ?></td>
              <td class="d-flex justify-content-center">
              <!--CETAK DETAIL BARANG MASUK-->
                  <a href="<?php echo BASEURL; ?>/barang_masuk/detail/<?php echo $brgM['PENERIMA']; ?>" class="btn btn-success"><i class="fa fa-print"></i></a>
              <!--HAPUS DETAIL BARANG MASUK-->
                  <a href="<?php echo BASEURL; ?>/barang_masuk/hapusDtl/<?php echo $brgM['NO_BCRA']; ?>" class="btn btn-danger" onclick="return confirm('apa anda yakin?')"><i class="fa fa-trash"></i></a>
              <!--EDIT DETAIL BARANG MASUK-->
                  <a href="#" class="btn btn-primary updDtlBrgMsk" data-bs-toggle="modal" data-bs-target="#detailBcra" data-date-id="<?php echo $brgM['TGL_BCRA'] ?>" data-po-id="<?php echo $brgM['NO_PO'] ?>" data-brg-id="<?php echo $brgM['KODE_BRG'] ?>" data-id="<?php echo $brgM['NO_BCRA']; ?>"><i class="fa fa-pen"></i></a>
              </td>
            </tr>
         <?php endforeach; ?>
       </tbody>
      </table>
      </div>
<!--END VIEW TABLE BERITA ACARA-->


      <!-- MODAL NOMOR BERITA ACARA -->
             <div class="modal fade" id="modalBrgMsk" tabindex="-1" role="dialog" aria-labelledby="modalBrgMsk" aria-hidden="true">
             <div class="modal-dialog" >
               <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="labelBcra">Input Barang Masuk</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                   <form class="" action="<?php echo BASEURL; ?>/barang_masuk/tambahTmp" method="post">
                    <!--HIDDEN INPUT NOMOR BCRA-->
                     <input type="hidden" name="No_msk" id="No_msk" value="">
                     <!--INPUT NOMOR PO-->
                       <div class="row mb-3">
                           <div class="form-group">
                               <label for="poBa2">No. PO :</label>
                                 <input type="text" name="poBa2" id="poBa2" value="" class="form-control" readonly>
                           </div>
                       </div>
                      <!--INPUT NOMOR BCRA-->
                       <div class="row mb-3">
                           <div class="form-group">
                               <label for="inputNoMsk2">No Masuk :</label>
                               <input type="text" name="inputNoMsk2" id="inputNoMsk2" class="form-control" value="" readonly>
                           </div>
                       </div>
                      <!--INPUT NOMOR SURAT JALAN-->
                       <div class="row mb-3">
                           <div class="form-group">
                               <label for="noSRJLN2">No. Surat Jalan :</label>
                               <input type="text" name="noSRJLN2" id="noSRJLN2" class="form-control">
                           </div>
                       </div>
                      <!--INPUT PENERIMA-->
                       <div class="row mb-3">
                           <div class="form-group">
                               <label for="penerima2">Penerima :</label>
                               <input type="text" name="penerima2" id="penerima2" class="form-control">
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

             <!-- MODAL DETAIL BERITA ACARA -->
                    <div class="modal fade" id="detailBcra" tabindex="-1" role="dialog" aria-labelledby="detailBcra" aria-hidden="true">
                    <div class="modal-dialog" >
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="labelDtlBcra">Input List Barang Masuk</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form class="" action="<?php echo BASEURL; ?>/barang_masuk/tambah" method="post">
                          <!--HIDEEN INPUT NOMOR BARANG-->
                            <input type="text" name="NoBcra" id="NoBcra" value="">
                          <!--HIDEEN INPUT NOMOR PO-->
                            <input type="text" name="nopo" id="nopo" value="">
                          <!--HIDEEN INPUT KODE BARANG-->
                            <input type="text" name="brg" id="brg" value="">
                            <!--INPUT QUANTITY DITERIMA-->
                              <div class="row mb-3">
                                <div class="form-group col">
                                  <label for="qtyTerima">Diterima</label>
                                  <input type="text" class="form-control" name="qtyTerima" id="qtyTerima" value="">
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
          <!---END MODAL DETAIL BERITA ACARA-->

</div>
