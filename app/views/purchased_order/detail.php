<div class="container mt-5">

    <p><a href="<?php echo BASEURL; ?>/purchased_order">KEMBALI</p>

  <table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">No_po</th>
    <th scope="col">Kode Barang</th>
    <th scope="col">Kuantitas</th>
    <th scope="col">Harga Beli</th>
    <th scope="col">Total Harga</th>
  </tr>
</thead>
<tbody>
  <?php foreach( $data['detail'] as $mhs ) : ?>
  <tr>
    <th scope="row">1</th>
    <td><?php echo $mhs['No_po']; ?></td>
    <td><?php echo $mhs['Kode_brg']; ?></td>
    <td><?php echo $mhs['Kuantitas']; ?></td>
    <td><?php echo $mhs['Harga_beli']; ?></td>
    <td><?php echo $mhs['Total_harga_bl']; ?></td>
  </tr>
    <?php endforeach; ?>
</tbody>
</table>

</div>
