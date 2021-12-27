<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASEURL; ?>/fontawesome-6.0.0-web/css/all.css">
    <title>Berita Acara</title>
  </head>
  <body>
    <div class="container-fluid">
      <hr>

      <div class="d-flex justify-content-around">
        <div class="col">
        <div class="p-3">
          <?php foreach( $data['report'] as $dt) : ?>
           <table>
            <tr>
              <th class="text-center" style="border:1px solid black"><b>OFFICE/FACTORY</b></th>
            </tr>
            <tr>
              <td style="font-size: 15px">PT BRAJA MUKTI CAKRA<br>
              Jln Desa Harapan Kita No 4 Bekasi Utara<br>
              Kota Bekasi Jawa Barat<br>
              PO. BOX. 210 BKS <br>
              Telp : (021) 8871836 <br>
              Fax  : (021) 8878 949, (021) 8871835</td>
            </tr>
          </table>
              </div>
            </div>
      <!---END TOMBOL TAMBAH NOMOR PO-->

      <div class="col text-center">
          <img src="<?php echo BASEURL; ?>/BMC/bmc_bg2.jpg" alt="" width="100" height="100">
          <h5>PT BRAJA MUKTI CAKRA</h5>
            <h6>THE PRECISION VALUE</h6>
            <br>
          <h5>PURCHASE ORDER<br></h5>
      </div>

          <div class="col">
            <div class="p-3">
              <table class=" table-bordered text-center" style="font-size: 13px">
                <tr>
                  <th class="col-3">DATE</th>
                  <td class="col-3"><?php print $dt['TGL_PO']; ?></td>
                </tr>
                <tr>
                  <th class="">PO</th>
                  <td><?php print $dt['NO_PO']; ?></td>
                </tr>
              </table>
              <?php endforeach; ?>
            </div>
          </div>
    </div>

      <div class="mt-3 p-3">
        <div class="row">
          <table class="table table-bordered text-center">
            <thead class="table-info text-center">
              <tr>
                <th>Req Cust</th>
                <th>SHIP VIA</th>
                <th colspan="2">F.O.B</th>
                <th colspan="2">SHIPPING TERMS</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>lala</td>
                <td>lala</td>
                <td colspan="2">lala</td>
                <td colspan="2">lala</td>
              </tr>
              <tr>

                    <thead class="table-info">
                      <tr>
                        <th>ITEM</th>
                        <th>DESCRIPTION</th>
                        <th>QTY</th>
                        <th>UNIT PRICE</th>
                        <th>TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $total = 0; foreach( $data['dtlReport'] as $bm) : ?>
                      <tr>
                        <td><?php echo $bm['NAMA_BRG']; ?></td>
                        <td></td>
                        <td><?php echo $bm['QTY_TERIMA'] . " " . $bm['Satuan']; ?></td>
                        <td><?php echo $bm['HARGA_PO']; ?></td>
                        <td><?php echo $bm['TOT_HARGA']; ?></td>
                        <?php $total += $bm['TOT_HARGA']; ?>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4">SUB TOTAL</td>
                        <td colspan="1"><?php echo $total; ?></td>
                      </tr>
                      <tr>
                        <td colspan="4">TAX</td>
                        <td colspan="1">lalaland</td>
                      </tr>
                      <tr>
                        <td colspan="4">SHIPPING</td>
                        <td colspan="1">lalaland</td>
                      </tr>
                      <tr>
                        <td colspan="4">OTHER</td>
                        <td colspan="1">lalaland</td>
                      </tr>
                      <tr>
                        <td colspan="4" style="border: 1px solid black">TOTAL</td>
                        <td colspan="1" style="border: 1px solid black">lalaland</td>
                      </tr>
                    </tfoot>

              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="border border-dark rounded-3 bg-gradient mt-3 p-3">
          <label for="catatan">Catatan :</label>
          <textarea name="catatan" rows="5" cols="50"></textarea>
      <div>
      <footer>

      </footer>

    </div>

    <script src="<?php echo BASEURL; ?>/js/bootstrap.js" charset="utf-8"></script>
  </body>
</html>
