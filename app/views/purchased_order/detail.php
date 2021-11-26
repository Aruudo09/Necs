<div class="container-fluid px-4">

  <!--TABLE VIEW PURCHASED ORDER-->
    <div class="border border-dark rounded-3 p-3 mx-auto mt-3">
      <h3>PURCHASED ORDER</h3>
      <hr>
      <div class="overflow-auto">
        <table class="table table-bordered text-center">
          <thead class="table-warning">
            <tr>
              <td class="col">Nomor PO</td>
              <td class="col">Pemesan</td>
              <td class="col">Departement</td>
              <td class="col">Supplier</td>
              <td class="col">Tanggal PO</td>
              <td class="col" style="width:15%">Fitur</td>
            </tr>
          </thead>
          <tbody>
            <?php foreach( $data['po'] as $po) : ?>
              <tr>
                <td><?php print $po['NO_PO'] ?></td>
                <td><?php print $po['PEMESAN'] ?></td>
                <td><?php print $po['NMDEF'] ?></td>
                <td><?php print $po['NAMA_SP'] ?></td>
                <td><?php print $po['TGL_PO'] ?></td>
                <td class="d-flex justify-content-evenly">
                  <!--BUTTON DETAIL-->
                    <button type="button" class="btn btn-success dtl" data-id="<?php echo rawurlencode($po['NO_PO']); ?>" data-bs-toggle="modal" data-bs-target="#modalPo" name="button"><i class="fa fa-file"></i></button>
                  <!--BUTTON EDIT-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPo" name="button"><i class="fa fa-pen"></i></button>
                  <!--BUTTON HAPUS-->
                    <button type="button" class="btn btn-danger hps" data-id="<?php echo rawurlencode($po['NO_PO']); ?>" name="button"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!--MODAL EDIT PURCHASED ORDER-->
    <div class="modal fade" id="editPo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">EDIT PURCHASE ORDER</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="" action="index.html" method="post">
              <div class="row">
                <div class="col">
                  <label for="noPo">Nomor PO</label>
                  <input type="text" name="noPo" class="form-control" value="" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label for="tgl_po">Tanggal PO</label>
                  <input type="date" name="tgl_po" class="form-control" value="">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    <!--MODAL TABEL DETAIL-->
    <div class="modal fade" id="modalPo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content p-3">
            <div class="modal-header">
              <h5 class="modal-title">VIEW DETAIL PO</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <table class="table table-borderless">
                <tr>
                  <th class="table-warning col-2">Nomor PO</th>
                  <td class="table-info" id="Po"></td>
                </tr>
                <tr>
                  <th class="table-warning col-2">Pemesan</th>
                  <td class="table-info" id="tbPmsn"></td>
                </tr>
                <tr>
                  <th class="table-warning col-2">Departement</th>
                  <td class="table-info" id="tbDept"></td>
                </tr>
                <tr>
                  <th class="table-warning col-2">Supplier</th>
                  <td class="table-info" id="tbSpr"></td>
                </tr>
                <tr>
                  <th class="table-warning" col-2>Tanggal PO</th>
                  <td class="table-info" id="tbTgl"></td>
                </tr>
              </table>
              <h4>DETAIL PURCHASED ORDER</h4>
              <div class="overflow-auto">
              <table class="table table-bordered text-center" id="myTabs">
                <thead class="table-info">
                  <tr>
                    <th class="col">Nama Barang</th>
                    <th class="col-3">Quantity</th>
                    <th class="col">Terima</th>
                    <th class="col">Satuan</th>
                    <th class="col">Harga</th>
                    <th class="col">Total</th>
                  </tr>
                </thead>
              </table>
              <!-- <div class="numRow"></div> -->
            </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="edt" name="button" disabled><i class="fa fa-pen">Edit</i></button>
              <button type="button" class="btn btn-success" name="button"><i class="fa fa-print">Cetak</i></button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

</div>
