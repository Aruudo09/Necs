
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
    <div class="container">
      <header>
          <div class="d-flex justify-content-center">
              <img src="<?php echo BASEURL; ?>/BMC/bmc.jpg" alt="" width="100" height="100">

              <h2 class="text-center">BERITA ACARA<br>PENERIMAAN BARANG</h2>
          </div>
      </header>
      <hr>



          <div class="left">
            <?php foreach ( $data['detail'] as $bm ) : ?>
            <p>Ref. PO BMC. No                    : <?php echo $bm['NO_PO']; ?></p>
            <p>Pada hari ini tanggal              : <?php echo $bm['TGL_BCRA']; ?></p>
            <p>Nama Supplier                      : <?php echo $bm['NAMA_SP']; ?></p>
            <p>Delivery Order No.                 : <?php echo $bm['NO_SRJLN']; break; ?></p>
            <p>Jatuh Tempo Pembayaran             : <?php  ?></p>
          <?php endforeach; ?>
          </div>

          <br>

          <div class="right"
            <p>Nomor    : <?php  ?></p>
            <p>No PR    : <?php  ?></p>
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
                <?php $i=1; foreach( $data['detail'] as $bm) : ?>
                <tr>
                  <td><?php echo $i++ ?></td>
                  <td><?php echo $bm['NAMA_BRG']; ?></td>
                  <td><?php echo $bm['QTY_TERIMA']; ?></td>
                  <td><?php echo $bm['Satuan']; ?></td>
                </tr>
              <?php endforeach; ?>
              </tbody>

              <tfoot>
                <tr>
                  <td colspan="2">Total</td>
                  <td><?php  ?></td>
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
