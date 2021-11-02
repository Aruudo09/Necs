
$(function() {

//PURCHASE ORDER

  //----membuat NOMOR PO baru-------//
  $('#tambahData').on('click', function() {

      $('#labelPo').html('Tambah Nomor Purchased Order');
      $('#Tanggal_update').hide();
      $('.modal-footer button[type=submit]').html('Simpan');

      $('#noPo').val();
      $('#noPo2').hide();
      $('#pemesan').val('');
      $('#sp').val('');

  });

  //----membuat Detail PO baru-------//
  $('.newDtlPo').on('click', function() {
    $('#labelDetailPo').html('Input Detail PO');
    $('.modal-footer button[type=submit]').html('Simpan Data');

    const id = $(this).data('id');
    // console.log(id);
    $.ajax({
      url: 'http://localhost/Necs/public/purchased_order/getubah',
      data: {id : id},
      method: 'post',
      dataType: 'json',
      success: function(data) {
        // console.log(data);
        $('#brg').val('');
        $('#qty').val('');
        $('#harga').val('');
        $('#detailNoPo').val(data.NO_PO);
        $('#detailSp').val(data.KODE_SP);
        $('#detailTglPo').val(data.TGL_PO);
        $('#detailPemesan').val(data.PEMESAN);
      }

        });
      });

  //----mengupdate atau edit NOMOR PO-------//
  $('.editPo').on('click', function() {

      $('#labelPo').html('Edit Nomor Purchased Order');
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('.modal-body form').attr('action', 'http://localhost/Necs/public/purchased_order/update');
      $('#noPo').hide();


      const id = $(this).data('id');
      console.log(id);
      $.ajax({
        url: 'http://localhost/Necs/public/purchased_order/getubah',
        data: {id : id},
        method: 'post',
        dataType: 'json',
        success: function(data) {
          // console.log(data);
            $('#noPo2').val(data.NO_PO);
            $('#No_po').val(data.NO_PO);
            $('#tanggal_po').val(data.TGL_PO);
            $('#pemesan').val(data.PEMESAN);
            $('#sp').val(data.KODE_SP);
              }
            });
        });

    //---------EDIT DETAIL PO---------------//
    $('#editDtlPo').on('click', function() {

      $('#labelDetailPo').html('Edit Detail PO');
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('.modal-body form').attr('action', 'http://localhost/Necs/public/purchased_order/ubah');

      const id = $(this).data('id');
      // console.log(id);
      $.ajax({
        url: 'http://localhost/Necs/public/purchased_order/getubah',
        data: {id : id},
        method: 'post',
        dataType: 'json',
        success: function(data) {
          // console.log(data);
          $('#brg').val(data.KODE_BRG);
          $('#qty').val(data.QTY_ORDER);
          $('#harga').val(data.HARGA_PO);
          $('#detailNoPo').val(data.NO_PO);
          $('#detailSp').val(data.KODE_SP);
          $('#detailTglPo').val(data.TGL_PO);
          $('#detailPemesan').val(data.PEMESAN);
        }

          });

    });

//BARANG

  //-----------TAMBAH BARANG BARU-----------//
  $('#tambahBarang').on('click', function() {

      $('#modalLabelBrg').html('Tambah Data Barang');
      $('.modal-footer button[type=submit]').html('Simpan');
      $('#tanggalInput').show();

      $('#Kode_brg').val('');
      $('#inputSpl').val('');
      $('#inputNamaBrg').val('');
      $('#inputJnsBrg').val('');
      $('#stockBrg').val('');
      $('#satuan').val('');
      $('#tanggalInput').val('');
      $('#harga').val('');
  });

  //-----------EDIT BARANG-----------//
  $('.btnUpdateBrg').on('click', function() {

      $('#modalLabelBrg').html('Update Data Barang');
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('.modal-body form').attr('action', 'http://localhost/Necs/public/Barang/ubah');
      $('#Kode_brg').hide();
      $('#tanggalInput').hide();

      const id = $(this).data('id');
      // console.log(id);
      $.ajax({
          url: 'http://localhost/Necs/public/Barang/getUbah',
          data: {Kode_brg : id},
          method: 'post',
          dataType: 'json',
          success: function(data) {
            // console.log(data);
              $('#kodeBrg').val(data.KODE_BRG);
              $('#inputSpl').val(data.KODE_SP);
              $('#inputNamaBrg').val(data.NAMA_BRG);
              $('#inputJnsBrg').val(data.Jenis_brg);
              $('#stockBrg').val(data.Stock_brg);
              $('#satuan').val(data.Satuan);
              $('#harga').val(data.Harga);
              $('#Kode_brg').hide();
          }
      });
  });

//BARANG MASUK

  //---------CLICK UNTUK MEN-GENERATE NOMOR BA-------------//

  $('#poBa').change(function() {
      // console.log(document.getElementById('poBa').value);
      var cmbVl = document.getElementById('poBa').value;
      // console.log(cmbVl.substring(5, 11));
     if (cmbVl.substring(5, 11) == 'PROC-P'){
         var kode3 = 'ST';
     }
     else {
         var kode3 = 'GA';
     }
     $('#inputNoMsk').val(kode3 + '-' + kod + '/' + kod1);

     $.ajax({
       type: 'POST',
       url: 'http://localhost/Necs/public/Barang_masuk/optBrg',
       data: {opt : cmbVl},
       dataType: 'json',
       success: function(data) {
         console.log(data);
         var appenddata1 = "";
                   for (var i = 0; i < data.length; i++) {
                       appenddata1 += "<option value = '" + data[i].KODE_BRG + " '>" + data[i].NAMA_BRG + " </option>";
                   }
                   $("#optBrg").append(appenddata1);
       }
     });
  });

  $('#tambahBa').click(function() {
    $('#poBa2').hide();
    $('#poBa').show();
  });

  //-----TAMBAH FILED INPUT BARANG------//
  $('.add').click(function() {
    var new_row = parseInt($('#num_row').val()) + 1;
    console.log(new_row);
    var new_input = "<td><input type='number' placeholder='Harga...' name='hrgBl[]' id='hrgBl" + new_row + "' class='form-control'><td>";
    var new_input1 = "<tr><td><input type='text' placeholder='Barang...' name='brg[]' id='brg" + new_row + "' class='form-control'></td>";
    var new_input2 = "<td><input type='number' placeholder='Quantity...' name='qty[]' id='qty" + new_row + "' class='form-control'></td>";


     $('#new_row').append(new_input1 + new_input + new_input2);

     $('#num_row').val(new_row);
  });

  //-----MENGURANGI FIELD BARANG-----//
  $('.remove').click(function() {
    var old_row = $('#num_row').val();
    console.log(old_row);

     if (old_row > 1) {
       $('#hrgBl' + old_row).remove();
       $('#brg' + old_row).remove();
       $('#qty' + old_row).remove();
       $('#remove' + old_row).remove();
       $('#num_row').val(old_row - 1);
     }
  });

  //-----SET VALUE EDIT BERITA ACARA TMP------//
  $('.tableViewDtlBcra').click(function() {

    var set = $(this).find('.poBcraTmp').text();
    var set1 = $(this).find('.noBcraTmp').text();
    var set2 = $(this).find('.srjBcraTmp').text();
    var set3 = $(this).find('.spBcraTmp').text();
    var set4 = $(this).find('.tglBcraTmp').text();
    var set5 = $(this).find('.pnmBcraTmp').text();


    // console.log(set + ' ' + set1 + ' ' + set2 + ' ' + set3 + ' ' + set4 + ' ' +set5);
    $('#penerimadt').val(set5);
    $('#tanggalbcra').val(set4);
    $('#nopo').val(set);
    $('#nomorsp').val(set3);
    $('#srjln').val(set2);
    $('#qtyTerima').val('');
    $('#NoBcra').val(set1);

    $('#poBa2').val(set);
    $('#inputNoMsk2').val(set1);
    $('#noSRJLN2').val(set2);
    $('#penerima2').val(set5);
    $('#tanggalTerima2').val(set4);
  });

  //---------EDIT HEADER BERITA ACARA----------//
  $('.bcraTmpUpdate').on('click', function() {

    $('#labelBcra').html('Edit Berita Acara');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.modal-body form').attr('action', 'http://localhost/Necs/public/Barang/ubahTmp');
    const id = $(this).data('id');
    console.log(id);
  });


  //---------INPUT DETAIL BERITA ACARA----------//
  $('.inptDtl').click(function() {
    const id = $(this).data('id');
    console.log(id);
  });

  //-----CLICK SET BARANG-----//
  $('.tableViewPo').click(function() {
    //SET VALUE DETAIL BERITA ACARA
    var kdPo = $(this).find('.kdPo').text();
    var harga = $(this).find('.kdHrg').text();
    var qtyTrm = $(this).find('.kdTglBa').text();
    var kdTrm = $(this).find('.kdTrm').text();
    var kdSp = $(this).find('.kdSp').text();
    var kdBrg = $(this).find('.kdBrg').text();
    var nmBrg = $(this).find('.nmBrg').text();
    console.log(kdBrg);
    console.log(harga);

    $('#nopo').val(kdPo);
    $('#nomorsp').val(kdSp);
    $('#brg').val(kdBrg);
    $('#optBrg').append("<option value = '" + kdBrg + " ' selected>" + nmBrg + " </option>");
    $('#hrg').val(harga);
    $('#hrgBl').val(harga);
    $('#qtyTerima').val('');
  });


  //----------EDIT DETAIL BARANG MASUK----------//
  $('.updDtlBrgMsk').on('click', function() {

    $('#labelDtlBcra').html('Edit Detail Berita Acara');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.modal-body form').attr('action', 'http://localhost/Necs/public/Barang_masuk/ubahDtl');
    $('#opsiBrg').hide();
    const id = $(this).data('id');
    const id2 = $(this).data('brg-id');
    const id3 = $(this).data('po-id');
    $('#brg').val(id2);
    $('#NoBcra').val(id);
    $('#nopo').val(id3);

  });

//BARANG KELUAR

  //--------TAMBAH BARANG KELUAR-----------//
  $('#tambahBrgKlr').on('click', function() {

    $('#modalLabelBrgKlr').html('Tambah Data Keluar Barang');
    $('.modal-footer button[type=submit]').html('Simpan Data');


    $('#namaBrg').val('');
    $('#inputPk').val('');
    $('#userId').val('');

    $('#keterangan').val('');

  });

  //----------EDIT BARANG KELUAR-----------//
  $('.editBrgKlr').on('click', function() {

    $('#modalLabelBrgKlr').html('Edit Data Keluar Barang');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.modal-body form').attr('action', 'http://localhost/Necs/public/Barang_keluar/ubah');

    const id = $(this).data('id');
    console.log(id);

    $.ajax({
        url: 'http://localhost/Necs/public/Barang_keluar/getUbah',
        data: {No_pakai : id},
        method: 'post',
        dataType: 'json',
        success: function(data) {
          console.log(data);
            $('#inputNoPk').hide();
            $('#namaBrg').val(data.KODE_BRG);
            $('#shift').val(data.SHIFT);
            $('#posting').val(data.POSTING);
            $('#tanggalKeluar').val(data.TANGGAL_OUT);
            $('#keterangan').val(data.KETERANGAN);
            $('#nama').val(data.NAMA_USER);
            $('#noRef').val(data.NO_REF);
            $('#qtyMinta').val(data.QUANTITY_MINTA);
            $('#tanggalInput').val(data.tanggal_input);
            $('#No_pk').val(data.NOMOR_SLIP);
        }
    });

  });

  //SUPPLIER

  //--------TAMBAH SUPPLIER BARU----------//
  $('#tambahSpl').on('click', function() {

    $('#modalLabelSpl').html('Tambah Data Supplier');
    $('.modal-footer button[type=submit]').html('Simpan Data');

    $('#inputNoSpl').val('');
    $('#inputNmSpl').val('');
    $('#alamatSpl').val('');
    $('#tanggalInput').val('');
    $('#keterangan').val('');
    $('#tanggalUpdate').hide();

  });

  //--------MENGEDIT DATA SUPPLIER---------//
  $('.editSpl').on('click', function() {

    $('#modalLabelSpl').html('Edit Data Supplier');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.modal-body form').attr('action', 'http://localhost/Necs/public/Supplier/ubah');

    const id = $(this).data('id');
    console.log(id);

    $.ajax({
        url: 'http://localhost/Necs/public/Supplier/getUbah',
        data: {KODE_SP : id},
        method: 'post',
        dataType: 'json',
        success: function(data) {
          console.log(data);
          $('#tanggalUpdate').show();
          $('#tanggalInput').hide();
          $('#inputNoSpl').hide();
          $('#inputNmSpl').val(data.NAMA_SP);
          $('#alamatSpl').val(data.ALAMAT_SP);
          $('#telepon').val(data.TELEPON);
          $('#email').val(data.email);
          $('#hubungan').val(data.HUBUNGAN);
          $('#npwp').val(data.npwp);
          $('#qtyBln').val(data.quantity_perbulan);
          $('#No_spl').val(data.KODE_SP);
        }
    });

  });

});
