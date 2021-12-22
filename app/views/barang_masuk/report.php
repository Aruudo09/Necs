
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <title>Berita Acara</title>
  </head>
  <body>
    <div class="container-fluid">
      <header>
          <div class="d-flex justify-content-evenly">
              <img src="<?php echo BASEURL; ?>/BMC/bmc.jpg" alt="" width="100" height="100">
              <h2 class="text-center">BERITA ACARA<br>PENERIMAAN BARANG</h2>
              <p></p>
          </div>
      </header>
      <hr>


        <div class="row">
          <div class="col-10">
            <?php foreach ( $data['rptBa'] as $bm ) : ?>
            <p>Ref. PO BMC. No                    : <?php echo $bm['NO_PO']; ?></p>
            <p>Pada hari ini tanggal              : <?php echo $bm['TGL_BCRA']; ?></p>
            <br>
            <p>Nama Supplier                      : <?php echo $bm['NAMA_SP']; ?></p>
            <p>Delivery Order No.                 : <?php echo $bm['NO_SRJLN']; ?></p>
            <p>Jatuh Tempo Pembayaran             : </p>
          <?php endforeach; ?>
          </div>

          <br>

          <div class="col">
            <?php foreach( $data['rptBa'] as $bm) : ?>
              <p>Nomor    : <?php echo $bm['NO_BCRA']; ?></p>
              <p>No PR    : <?php echo $bm['NO_PR']; ?></p>
            <?php endforeach; ?>
          </div>
        </div>
          <br>

          <table class="table table-bordered text-center">
            <form class="" action="index.html" method="post">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Quantity</th>
                  <th>Satuan</th>
                </tr>
              </thead>

              <tbody>
                <?php $total = 0; ?>
                <?php $i=1; foreach( $data['rptDtlBa'] as $bm) : ?>
                <tr>
                  <td style="width:5%"><?php echo $i++ ?></td>
                  <td style="width:40%"><?php echo $bm['NAMA_BRG']; ?></td>
                  <td style="width:20%"><?php echo $bm['QTY_TERIMA']; ?></td>
                  <td style="width:15%"><?php echo $bm['Satuan']; ?></td>
                  <?php $total += $bm['QTY_TERIMA']; ?>
                </tr>
              <?php endforeach; ?>
              </tbody>

              <tfoot>
                <tr>
                  <td colspan="2">Total</td>
                  <td><?php print $total; ?></td>
                  <td><?php  ?></td>
                </tr>
              </tfoot>
            </form>
          </table>

          <label for="catatan">Catatan :</label>
          <textarea name="catatan" rows="5" cols="50"></textarea>

      <footer>

      </footer>

    </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
