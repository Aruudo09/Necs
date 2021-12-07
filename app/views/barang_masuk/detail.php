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
          <div class="overflow-auto">
              <table class="table table-bordered table-striped table-responsive text-center table-hover tbPo2">
                <h3 class="mb-3">LIST PURCHASED ORDER</h3>
                    <thead>
                      <tr class="table-warning ">
                        <th scope="col">No. PO</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Barang</th>
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
                    <td class="nmBrg"><?php print $mhs['NAMA_BRG']; ?></td>
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

</div>
