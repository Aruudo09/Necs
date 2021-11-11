// PLUGIN FOR JAVASCRIPT --> select2(), DataTables

//----DATA TABLES-----//
$(document).ready(function() {
  $('#tbBrg').DataTable();
  $('#tbSp').DataTable();
  $('#tbDtlBa').DataTable();
  $('#tbPo').DataTable();
  $('.tbPo2').DataTable();
  $('.tblBon').DataTable();
});

$(function() {

//PURCHASE ORDER

if (window.location.pathname=='/Necs/public/purchased_order') {

  //-----SET PURCHASED ORDER------//
  $('.tblPo').ready(function(){
    var np = document.getElementById('Np').value;
    var tglPo = $(this).find('#tglPo').text();
    var pmsn = $(this).find('#pmsn').text();
    var nmSp = $(this).find('#nmSp').text();
    var kdSpPo = $(this).find('#kdSpPo').text();
    console.log(kdSpPo);

    $('#noPo2').val(np);
    $('#tanggal_po2').val(tglPo);
    $('#pemesan2').val(pmsn);
    $('#sp2').val(kdSpPo);

  });

  //-----SET DETAIL PURCHASED ORDER----//
  $('#tbPo').ready(function(){
    var dtl = $(this).find('#npDtl').text();
    console.log(dtl);
    var kd = $(this).find('#kdBrgDtl').text();
    $('#detailNoPo').val(dtl);
    $('#detailBarang').val(kd);
  });

  //-----SEARCH PURCHASED ORDER-----//
  $('#srchPo').click(function() {
    var srchPo = document.getElementById('srchPotxt').value;
    console.log(srchPo);

    $.ajax({
      type: 'post',
      url: 'http://localhost/Necs/public/purchased_order/cari',
      data: {srchPo : srchPo},
      dataType: 'json',
      success: function(data) {
        console.log(data);
        console.log(data.NO_PO);
        $('#Np').val(data.NO_PO);
        $('#tglPo').text(data.TGL_PO);
        $('#pmsn').text(data.PEMESAN);
        $('#nmSp').text(data.NAMA_SP);
        $('#kdSpPo').text(data.KODE_SP);
        $('#noPo2').val(data.NO_PO);
        $('#tanggal_po2').val(data.TGL_PO);
        $('#pemesan2').val(data.PEMESAN);
        $('#sp2').val(data.KODE_SP);
      }
    });
  })

  //-----SELECT2() OPTION BARANG------//
  $(document).ready(function () {
    $('#inptBrgPo').select2();
  });

  //-----GENERATE FIELD INPUT BARANG DI PO-----//
  $('.inptBrgPo').on('change', function() {
    var value = document.getElementById('inptBrgPo').value;
    var nama = $(".inptBrgPo option:selected").text();
    // console.log(value);
    // console.log(nama);

    var new_row = parseInt($('#num_row').val()) + 1;
    console.log(new_row);
    var new_input = "<div class='row'><div class='col-5'><label for='nmBrg' id='lblNamaBrg" + new_row + "'>Barang :</label><input type='text' name='nmBrg[]' id='nmBrg" + new_row + "' class='form-control' value='" + nama +"'></div>";

    var new_input1 = "<div class='col-3'><label for='qty' id='lblQtyOrder" + new_row + "'>Order :</label><input type='number' placeholder='Quantity...' name='qty[]' id='qty" + new_row + "' class='form-control'></div>";

    var new_input2 = "<div class='col-4'><label for='harga' id='lblHarga" + new_row + "'>Harga :</label><input type='number' placeholder='Harga...' name='harga[]' id='harga" + new_row + "' class='form-control'></div>";

    var new_input3 = "<div class='col-3'><input type='hidden' placeholder='Kode Barang...' name='kdBrg[]' id='kdBrg" + new_row + "' class='form-control' value='" + value +"'></div></div>";


     $('#add_row').append(new_input + new_input1 + new_input2 + new_input3);

     $('#num_row').val(new_row);
  });

  //-----MENGURANGI FIELD BARANG DI PO-----//
  $('.remove').click(function() {
    var old_row = $('#num_row').val();
    console.log(old_row);

     if (old_row > 0) {
       $('#nmBrg' + old_row).remove();
       $('#qty' + old_row).remove();
       $('#harga' + old_row).remove();
       $('#kdBrg' + old_row).remove();
       $('#lblNamaBrg' + old_row).remove();
       $('#lblQtyOrder' + old_row).remove();
       $('#lblHarga' + old_row).remove();
       $('#num_row').val(old_row - 1);
     }
  });


  //----mengupdate atau edit NOMOR PO-------//
  $('.editPo').on('click', function() {

      $('#labelPo').html('Edit Nomor Purchased Order');
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('.modal-body form').attr('action', 'http://localhost/Necs/public/purchased_order/update');
        });

    //-------HAPUS PO--------//
    $('.hpsPo').click(function(){
      var hps = document.getElementById('Np').value;
      console.log(hps);

      $.ajax({
        type: 'post',
        url: 'http://localhost/Necs/public/purchased_order/hapusPo',
        data: {hps : hps},
        // success: function(data) {
        //   // alert("Berhasil Menghapus Data");
        //   console.log(data);
        // }
      });
    });

    //-------EDIT DETAIL PO-------//
    $('.editDtlPo').click(function(){
      $('#labelDetailPo').html('Edit Purchased Order');
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('.modal-body form').attr('action', 'http://localhost/Necs/public/purchased_order/ubah');
    });
}

//BARANG

if (window.location.pathname=='/Necs/public/barang') {

  //-----------CEK STOCK BARANG-----------//
  $('#cek').click(function() {
    $.ajax({
      url: 'http://localhost/Necs/public/barang/cek',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        var tableData = "";
        for (var i = 0; i < data.length; i++) {
          tableData = data[i];
        }
        console.log(tableData);
      }
    });
  });
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
      $('#harga').val('');
  });

  //-----------EDIT BARANG-----------//
  $('.btnUpdateBrg').on('click', function() {

      $('#modalLabelBrg').html('Update Data Barang');
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('.modal-body form').attr('action', 'http://localhost/Necs/public/Barang/ubah');
      $('#Kode_brg').hide();

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
              $('#stckMin').val(data.STOCK_MIN);
              $('#stckMax').val(data.STOCK_MAX);
              $('#satuan').val(data.Satuan);
              $('#harga').val(data.Harga);
              $('#Kode_brg').hide();
          }
      });
  });
}

//BARANG MASUK

if (window.location.pathname=='/Necs/public/barang_masuk') {

  //------SELECT2() TAMBAH BARANG------//
  $(document).ready(function(){
    $('#poBa').select2();
  });

  $('#poBa').change(function(){
    document.getElementById('poBa').disabled = true;
  });
  $('.btnSmpn').click(function(){
    document.getElementById('poBa').disabled = false;
  });

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
               appenddata1 = data[i].NAMA_BRG;
               var new_input = "<div class='row'><div class='col-3'><label for='optBrg' id='lblOptBrg" + i + "'>Barang :</label><input type='text' placeholder='Barang...' name='optBrg[]' id='optBrg" + i + "' class='form-control' value='" + data[i].NAMA_BRG + "'></div>";

               var new_input1 = "<div class='col-3'><label for='hrgBl' id='lblHrgBl" + i + "'>Harga :</label><input type='number' placeholder='Harga...' name='hrgBl[]' id='hrgBl" + i + "' class='form-control' value='" + data[i].HARGA_PO + "'></div>";

               var new_input2 = "<div class='col-3'><label for='qty' id='lblQty" + i + "'>Quantity :</label><input type='number' placeholder='Quantity...' name='qty[]' id='qty" + i + "' class='form-control'></div>";

               var new_input3 = "<div class='col-1'><button type='button' id='remove' class='btn btn-danger mt-4' onclick=''><i class='fas fa-minus'></i></div>";

               var new_input4 = "<div class='col-3'><input type='hidden' name='kdBrg[]' id='kdBrg" + i + "' class='form-control' value='" + data[i].KODE_BRG + "'></div></div>";

              $('#new_row').append(new_input + new_input1 + new_input2 + new_input3 + new_input4);

              $('#num_row').val(i);
              var appenddata2 = i;
              $('#new_row').on('click', '#remove', function(e){
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
              });
             }
               $("#optBrg").val(appenddata1);

       }
     });
  });

  //-----SEARCH BERITA ACARA-----//
  $('.srchBa').click(function() {
    var srchBa = document.getElementById('srchBatxt').value;

    $.ajax({
      type: 'post',
      url: 'http://localhost/Necs/public/Barang_masuk/cari',
      data: {srchBa : srchBa},
      dataType: 'json',
      success: function(data) {
        console.log(data);
        console.log(data.NO_BCRA);
        $('.poBcraTmp').val(data.NO_PO);
        $('#poBa2').val(data.NO_PO);
        $('.noBcraTmp').val(data.NO_BCRA);
        $('#inputNoMsk2').val(data.NO_BCRA);
        $('.srjBcraTmp').text(data.NO_SRJLN);
        $('.spNmBcraTmp').text(data.NAMA_SP);
        $('.tglBcraTmp').text(data.TGL_BCRA);
        $('.pnmBcraTmp').text(data.PENERIMA);
        $('.spBcraTmp').text(data.KODE_SP);
      }
    });
  })

  //-----SET VALUE EDIT BERITA ACARA TMP------//
  $('.tableViewDtlBcra').click(function() {

    var set = $(this).find('.poBcraTmp').val();
    var set1 = $(this).find('.noBcraTmp').val();
    var set2 = $(this).find('.srjBcraTmp').text();
    var set3 = $(this).find('.spBcraTmp').text();
    var set4 = $(this).find('.tglBcraTmp').text();
    var set5 = $(this).find('.pnmBcraTmp').text();

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
    $('.modal-body form').attr('action', 'http://localhost/Necs/public/Barang_masuk/ubahTmp');
    const id = $(this).data('id');
    console.log(id);
  });


  //---------INPUT DETAIL BERITA ACARA----------//
  $('.inptDtl').click(function() {
    const id = $(this).data('id');
    console.log(id);
  });

  //-----CLICK SET BARANG-----//
// $('.tableViewPo').click(function() {
//     //SET VALUE DETAIL BERITA ACARA
//     var kdPo = $(this).find('.kdPo').text();
//     var harga = $(this).find('.kdHrg').text();
//     var qtyTrm = $(this).find('.kdTglBa').text();
//     var kdTrm = $(this).find('.kdTrm').text();
//     var kdSp = $(this).find('.kdSp').text();
//     var kdBrg = $(this).find('.kdBrg').text();
//     var nmBrg = $(this).find('.nmBrg').text();
//     console.log(kdBrg);
//     console.log(harga);
//
//     $('#nopo').val(kdPo);
//     $('#nomorsp').val(kdSp);
//     $('#brg').val(kdBrg);
//     $('#optBrg').append("<option value = '" + kdBrg + " ' selected>" + nmBrg + " </option>");
//     $('#hrg').val(harga);
//     $('#hrgBl').val(harga);
//     $('#qtyTerima').val('');
//   });


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

  //-------HAPUS BARANG MASUK--------//
  $('.hpsBa').click(function(){
    var hps = document.getElementById('poBcraTmp').value;
    console.log(hps);

    $.ajax({
      type: 'post',
      url: 'http://localhost/Necs/public/Barang_masuk/hapus',
      data: {hps : hps},
      // success: function(data) {
      //   // alert("Berhasil Menghapus Data");
      //   console.log(data);
      // }
    });
  });

  //-----CETAK BERITA ACARA------//
  $('.ctkBa').click(function(){
    alert("Berhasil Click");
    var id = document.getElementById('noBcraTmp').value;
    console.log(id);

    window.location = "http://localhost/Necs/public/barang_masuk/detail/"+id;
  });
}

//BARANG KELUAR

if (window.location.pathname=='/Necs/public/barang_keluar') {
  //--------TAMBAH BARANG KELUAR-----------//
  $('#tambahBrgKlr').on('click', function() {

    $('#modalLabelBrgKlr').html('Tambah Data Keluar Barang');
    $('.modal-footer button[type=submit]').html('Simpan Data');


    $('#namaBrg').val('');
    $('#inputPk').val('');
    $('#userId').val('');

    $('#keterangan').val('');

  });


  //------COMBOBOX BARANG-------//
  $(document).ready(function() {
    $('.selectBrg').select2();
  });

  //-----ADD FIELD TAMBAH BARANG----//
  $('.selectBrg').on('change', function() {
      var value = document.getElementById('selectBrg').value;
      var nama = $(".selectBrg option:selected").text();
      console.log(value);
      console.log(nama);

      var new_row = parseInt($('#num_row').val()) + 1;
      // console.log(new_row);
      var new_input1 = "<div class='row'><div class='col-3'><label for='namaBrg' id='lblNamaBrg" + new_row + "'>Barang :</label><input type='text' placeholder='Barang...' name='nmBrg[]' id='nmBrg" + new_row + "' class='form-control' value='" + nama +"'></div>";

      var new_input2 = "<div class='col-4'><label for='qtyMinta' id='lblQtyMinta" + new_row + "'>Jumlah Minta :</label><input type='number' placeholder='Quantity...' name='qtyMinta[]' id='qtyMinta" + new_row + "' class='form-control'></div>";

      var new_input3 = "<div class='col-4'><label for='keterangan' id='lblKeterangan" + new_row + "'>Keterangan :</label><input type='text' placeholder='Keterangan...' name='keterangan[]' id='keterangan" + new_row + "' class='form-control'></div>";

      var new_input = "<div class='col-3'><input type='hidden' placeholder='Kode Barang...' name='kdBrg[]' id='kdBrg" + new_row + "' class='form-control' value='" + value +"'></div></div>";


       $('#add_row').append(new_input1 + new_input2 + new_input3 + new_input);

       $('#num_row').val(new_row);
    });

  //-----MENGURANGI FIELD BARANG-----//
  $('.remove').click(function() {
    var old_row = $('#num_row').val();
    console.log(old_row);

     if (old_row > 0) {
       $('#nmBrg' + old_row).remove();
       $('#qtyMinta' + old_row).remove();
       $('#keterangan' + old_row).remove();
       $('#kdBrg' + old_row).remove();
       $('#lblNamaBrg' + old_row).remove();
       $('#lblQtyMinta' + old_row).remove();
       $('#lblKeterangan' + old_row).remove();
       $('#num_row').val(old_row - 1);
     }
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
}

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
