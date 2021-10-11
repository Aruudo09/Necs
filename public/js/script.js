
$(function() {


  $('#tambahData').on('click', function() {

      $('#exampleModalLabel1').html('Tambah Data Purchased Order');
      $('#Tanggal_update').toggle();
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
            if ($('#Tanggal_update').is(':hidden')) {
              $('#Tanggal_update').show();
            };
            $('#Tanggal_keluar').val(data.Tanggal_keluar);
            $('#Pemesan').val(data.Pemesan);
            $('#No_po').val(data.No_po);
        }
      });
  });

});
