
$(function() {

//   $(document).ready(function() {
//     var url = 'http://localhost/Necs/public/barang';
//     console.log(url);
//     jQuery('ul.nav a').each(function() {
//         if($(this).attr('href') == url)
//             $(this).parent().addClass('active');
//     });
// });

//PURCHASE ORDER
  $('#tambahData').on('click', function() {

      $('#exampleModalLabel1').html('Tambah Data Purchased Order');
      $('#Tanggal_update').hide();
      $('.modal-footer button[type=submit]').html('Simpan');
  });

  $('.tampilModalUpdate').on('click', function() {

      $('#exampleModalLabel1').html('Update Data Purchased Order');
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('.modal-body form').attr('action', 'http://localhost/Necs/public/mahasiswa/ubah');

      const id = $(this).data('id');
      // console.log(id);
      $.ajax({
        url: 'http://localhost/phpmvc/public/mahasiswa/getubah',
        data: {id : id},
        method: 'post',
        dataType: 'json',
        success: function(data) {
          console.log(data);
            $('#Tanggal_keluar').val(data.Tanggal_keluar);
            $('#Pemesan').val(data.Pemesan);
            $('#No_po').val(data.No_po);
        }
      });
  });

//BARANG

  $('#tambahBarang').on('click', function() {

      $('#modalLabelBrg').html('Tambah Data Barang');
      $('.modal-footer button[type=submit]').html('Simpan');

      $('#Kode_brg').val('');
      $('#inputSpl').val('');
      $('#inputNamaBrg').val('');
      $('#inputJnsBrg').val('');
      $('#stockBrg').val('');
      $('#satuan').val('');
      $('#tanggalInput').val('');
      $('#harga').val('');
  });

  $('.btnUpdateBrg').on('click', function() {

      $('#modalLabelBrg').html('Update Data Barang');
      $('.modal-footer button[type=submit]').html('Ubah Data');

      const id = $(this).data('id');
      // console.log(id);

      $.ajax({
          url: 'http://localhost/Necs/public/Barang/getUbah',
          data: {Kode_brg : id},
          method: 'post',
          dataType: 'json',
          success: function(data) {
              $('#Kode_brg').val(data.Kode_brg);
              $('#inputSpl').val(data.Nama_spl);
              $('#inputNamaBrg').val(data.Nama_brg);
              $('#inputJnsBrg').val(data.Jenis_brg);
              $('#stockBrg').val(data.Stock_brg);
              $('#satuan').val(data.Satuan);
              $('#tanggalInput').val(data.Tanggal_input);
              $('#harga').val(data.Harga_beli);
          }
      });
  });

  //BARANG MASUK
  $('#tambahBrgMsk').on('click', function() {

      $('#modalLabelBrgMsk').html('Tambah Data Barang Masuk');
      $('.modal-footer button[type=submit]').html('Simpan Data');

      $('#inputNoMsk').val('');
      $('#inputPnr').val('');
      $('#inputPng').val('');
      $('#totHrg').val('');
      $('#tanggalMasuk').val('');
      $('#keterangan').val('');

  });

  $('.btnUpdateBrgMsk').on('click', function() {

    $('#modalLabelBrgMsk').html('Ubah Data Barang Masuk');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.modal-body form').attr('action', 'http://localhost/Necs/public/Barang_masuk/ubah');

    const id = $(this).data('id');
    console.log(id);
    $.ajax({
        url: 'http://localhost/Necs/public/Barang_masuk/getUbah',
        data: {No_msk : id},
        method: 'post',
        dataType: 'json',
        success: function(data) {
            $('#inputNoMsk').hide();
            $('#No_msk').val(data.No_msk);
            $('#inputPnr').val(data.Pihak_satu);
            $('#inputPng').val(data.Pihak_dua);
            $('#totHrg').val(data.Total_harga);
            $('#tanggalMasuk').val(data.Tanggal_msk);
            $('#keterangan').val(data.Keterangan);
        }
    });

  });

});
