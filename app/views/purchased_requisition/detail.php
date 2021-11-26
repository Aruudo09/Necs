<div class="container-fluid px-4">


  <!--TABLE VIEW PURCHASED REQUEST-->
    <div class="border border-dark rounded-3 bg-gradient p-3 mx-auto m-3">
      <h3>DAFTAR PURCHASED REQUISITION</h3>
      <hr>
      <div class="overflow-auto">
        <table class="table table-striped table-hover text-center">
          <thead class="table-warning">
            <tr>
              <th>Nomor PR</th>
              <th>User</th>
              <th>Departement</th>
              <th>Supplier</th>
              <th>Tanggal PR</th>
              <th>Fitur</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach( $data['pr'] as $pr ) : ?>
              <tr>
                <td><?php print $pr['NO_PR'] ?></td>
                <td><?php print $pr['USER'] ?></td>
                <td><?php print $pr['NMDEF'] ?></td>
                <td><?php print $pr['NAMA_SP'] ?></td>
                <td><?php print $pr['TGL_PR'] ?></td>
                <td>
                  <button type="button" class="btn btn-primary edit" data-id="<?php echo $pr['NO_PR'] ?>" data-bs-toggle="modal" data-bs-target="#modalpr" name="button"><i class="fa fa-pen"></i></button>
                  <button type="button" class="btn btn-danger hps" data-id="<?php echo $pr['NO_PR']; ?>"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  <!--MODAL EDIT PR-->
  <div class="modal fade" id="modalpr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">EDIT PURCHASED REQUISITION</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="" action="index.html" method="post">
            <div class="row mb-2">
              <div class="col">
                <label for="nmPr">Nomor PR :</label>
                <input type="text" class="form-control" id="nmPr" name="nmPr" value="">
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <label for="usr">User :</label>
                <input type="text" class="form-control" id="usr" name="usr" value="">
              </div>
            </div>
            <div class="row mb-2">
              <div class="col">
                <label for="tgl_pr">Tanggal PR :</label>
                <input type="date" class="form-control" id="tgl_pr" name="tgl_pr" value="">
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

</div>
