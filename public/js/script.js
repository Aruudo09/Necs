// PLUGIN FOR JAVASCRIPT --> select2(), DataTables

//----DATA TABLES-----//
$(document).ready(function() {
  $('#tbSp').DataTable();
  $('#tbPo').DataTable();
  $('.tbPo2').DataTable();
  $('.tblBon').DataTable();
});

$(function() {

//SURAT REQUEST

if (window.location.href.indexOf('/Necs/public/surat_request') > 0 ) {

  //-----SELECT2() OPTION BARANG------//
  $(document).ready(function () {
    $('#inptBrgSr').select2();
  });

  //-----GENERATE FIELD INPUT BARANG DI SR-----//
  $('.inptBrgSr').on('change', function() {
    var value = document.getElementById('inptBrgSr').value;
    var nama = $(".inptBrgSr option:selected").text();


    var new_row = parseInt($('#num_row').val()) + 1;
    console.log(new_row);
    var new_input = "<div class='row'><div class='col-5'><label for='nmBrg' id='lblNamaBrg" + new_row + "'>Barang :</label><input type='text' name='nmBrg[]' id='nmBrg" + new_row + "' class='form-control' value='" + nama +"'></div>";

    var new_input1 = "<div class='col-3'><label for='qty' id='lblQtyOrder" + new_row + "'>Order :</label><input type='number' placeholder='Quantity...' name='qty[]' id='qty" + new_row + "' class='form-control'></div>";

    var new_input2 = "<div class='col-4'><label for='harga' id='lblHarga" + new_row + "'>Harga :</label><input type='number' placeholder='Harga...' name='harga[]' id='harga" + new_row + "' class='form-control'></div>";

    var new_input3 = "<div class='col-3'><input type='hidden' placeholder='Kode Barang...' name='kdBrg[]' id='kdBrg" + new_row + "' class='form-control' value='" + value +"'></div></div>";


     $('#add_row').append(new_input + new_input1 + new_input2 + new_input3);

     $('#num_row').val(new_row);
  });

  //-----MENGURANGI FIELD BARANG DI SR-----//
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


  //----mengupdate atau edit NOMOR SR-------//
  $('.edtSr').click(function(){
    const id = $(this).data('id');

    $.ajax({
      url: 'http://localhost/Necs/public/Surat_request/getSr',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        $('#noSr2').val(data.NO_SR);
        $('#peminta2').val(data.PEMINTA);
        $('#tanggal_sr2').val(data.TGL_SR);
        $('#sp2').val(data.KODE_SP);
      }
    });
  });

  //-----------TAMPIL DETAIL SR-------------//
  $('.detail').click(function(){
    const id = $(this).data('id');
    $('#Sr').val('');
    $('#tbPmnt').val('');
    $('#tbDept').val('');
    $('#tbSpr').val('');
    $('#tbTgl').val('');
    $('.numRow').remove();
    $('#editDtl').prop('disabled', true);

    $.ajax({
      url: 'http://localhost/Necs/public/Surat_request/getSrDtl',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        console.log(data);
        if ( data.length == 0) {
          alert("DATA DETAIL KOSONG");
        } else {
          $('#Sr').val(data[0].NO_SR);
          $('#tbPmnt').val(data[0].PEMINTA);
          $('#tbDept').val(data[0].NMDEF);
          $('#tbSpr').val(data[0].NAMA_SP);
          $('#tbTgl').val(data[0].TGL_SR);

          for (var i = 0; i < data.length; i++) {
            var row = "<tbody><tr class='numRow'><td>" +data[i].NAMA_BRG+ "</td>";
            var row0 = "<td style='display:none'><input type='hidden' name='brg[]' value='" +data[i].KODE_BRG+ "'></td>";
            var row1 = "<td><input type='number' name='qty[]' value='" +data[i].QTY_MINTA+ "'></td>";
            var row2 = "<td>" +data[i].Satuan+ "</td>";
            var row3 = "<td><input type='number' name='hrg[]' value='" +data[i].HARGA_SR+ "'></td>";
            var row4 = "<td>" +data[i].TOT_HARGA+ "</td>";
            var row5 = "<td><button type='button' class='btn btn-danger hpsDtl' data-id='" +data[i].NO_SR+ "' data-kd='" +data[i].KODE_BRG+ "'><i class='fa fa-trash'></i></button></td></tr></tbody>";

          $('#myTabs').append(row + row0 + row1 + row2 + row3 + row4 + row5 );
          }
        }
      }
    });
  });

    //-------EDIT DETAIL SR---------//
    $(document).on('click keypress', '.numRow', function(){
      $('#editDtl').prop('disabled', false);
    });

    //-------HAPUS DETAIL SR--------//
    $(document).on('click', '.hpsDtl', function(){

      const id = $(this).data('id');
      const kd = $(this).data('kd');

      $.ajax({
        url: 'http://localhost/Necs/public/Surat_request/hapusSr',
        data: {id : id, kd : kd},
        type: 'post',
        success: function(data) {

          if ( data == true ) {
            alert("Berhasil Menghapus Data");
            window.location.replace('http://localhost/Necs/public/surat_request');
          } else {
            alert("Gagal Menghapus Data");
          }
        },
        error: function(xhr, status, error) {
          var errorMessage = xhr.status + ': ' + xhr.statusText
          alert("DATA GAGAL DIHAPUS " + errorMessage);
        }
      });
    });

}

  if ( window.location.href.indexOf('/Necs/public/surat_request/cari') > 0 ) {
    $('.pgNum').click(function(){
      var page = $(this).text();
      console.log(page);
      $('.pgNum').attr("href", "http://localhost/Necs/public/surat_request/cari/" +page+ "");
    });
  }

//PURCHASED_REQUISITION

if (window.location.href.indexOf('/Necs/public/purchased_requisition') > 0 && window.location.href.indexOf('detail') === -1 && window.location.href.indexOf('cariDtl') === -1 ) {

  $(document).ready(function(){
    $('#noSr').select2();
  });

  //----------GENERATE NOMOR PR DAN SUPPLIER-------------//
  $('#noSr').change(function(){
    var sr = document.getElementById('noSr').value;
    var init = document.getElementById('hdnPr').value;

    if ( sr.substring(0,7).endsWith('/')) {
      $('#noPr').val(sr.substring(0,6) + '-' + init + sr.substring(6));
    } else {
      $('#noPr').val(sr.substring(0,7) + '-' + init + sr.substring(7));
    }

    $.ajax({
      type: 'post',
      url: 'http://localhost/Necs/public/Purchased_requisition/supplier',
      data: {id : sr},
      dataType: 'json',
      success: function(data) {
        // console.log(data);
        $('#sp').val(data.NAMA_SP);
        $('#hdnSp').val(data.KODE_SP);
      }
    });
  });

  //-----------GENERATE ROW DETAIL SR-------------//
  $('.btn').click(function(){
    const id = $(this).data('id');
    $('#tbSr').text('');
    $('#tbPmnt').text('');
    $('#tbDept').text('');
    $('#tbSpr').text('');
    $('.numRow').remove();

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_requisition/dtlSr',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
          if (data.length == 0 ) {
            alert("Detail Data Kosong");
          } else {
            $('#tbSr').text(data[0].NO_SR);
            $('#tbPmnt').text(data[0].PEMINTA);
            $('#tbDept').text(data[0].NMDEF);
            $('#tbSpr').text(data[0].NAMA_SP);

          for (var i = 0; i < data.length; i++) {
            var row = "<tbody><tr class='numRow'><td>"+ data[i].NAMA_BRG +"</td>";
            var row1 = "<td>"+ data[i].QTY_MINTA +"</td>";
            var row2 = "<td>"+ data[i].Satuan +"</td>";
            var row3 = "<td>"+ data[i].HARGA_SR +"</td>";
            var row4 = "<td>"+ data[i].TOT_HARGA +"</td></tr></tbody></table>";

            $('#myTabs').append(row + row1 + row2 + row3 + row4);
            }
          }

      }
    });
  });

}

//-----SAAT MODE PENCARIAN SR DI PR-----//
if (window.location.href.indexOf('/Necs/public/purchased_requisition/cari') > 0 && window.location.href.indexOf('cariDtl') == -1 ) {
  $('.pgNum').click(function(){
    var page = $(this).text();
    $('.pgNum').attr("href", "http://localhost/Necs/public/purchased_requisition/cari/" +page+ "");
  });
}

//-----PENCARIAN SAAT DI DETAIL PR------//
if (window.location.href.indexOf('/Necs/public/purchased_requisition/detail') > 0 || window.location.href.indexOf('/Necs/public/purchased_requisition/cariDtl') > 0) {

  //----------PAGINATION-----------//
  $('.pgNum').click(function(){
    var page = $(this).text();
    $('.pgNum').attr("href", "http://localhost/Necs/public/purchased_requisition/cariDtl/" +page+ "");
  });

  $('.hps').click(function(){
    if (confirm("Apa anda yakin?")) {
      const id = $(this).data('id');

      $.ajax({
        url: 'http://localhost/Necs/public/Purchased_requisition/hapus',
        type: 'post',
        data: {id : id},
        success: function(data) {
          alert("Data Berhasil Dihapus");
          window.location.replace('http://localhost/Necs/public/purchased_requisition/detail');
        },
        error: function(xhr, status, error) {
          var errorMessage = xhr.status + ': ' + xhr.statusText
          alert("DATA GAGAL DIHAPUS " + errorMessage);
        }
      });
    }
  });

  //---------VIEW DETAIL PR----------//
  $('.detail').click(function(){
    const id = $(this).data('id');
    $('#tbSr').text('');
    $('#tbPmnt').text('');
    $('#tbDept').text('');
    $('#tbSpr').text('');
    $('.numRow').remove();

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_requisition/getDtlPr',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        console.log(data);
        if (data.length == 0 ) {
          alert("Detail Data Kosong");
        } else {
          $('#tbSr').text(data[0].NO_PR);
          $('#tbPmnt').text(data[0].PEMINTA);
          $('#tbDept').text(data[0].NMDEF);
          $('#tbSpr').text(data[0].NAMA_SP);

        for (var i = 0; i < data.length; i++) {
          var row = "<tbody><tr class='numRow'><td>"+ data[i].NAMA_BRG +"</td>";
          var row1 = "<td>"+ data[i].QTY_MINTA +"</td>";
          var row2 = "<td>"+ data[i].Satuan +"</td>";
          var row3 = "<td>"+ data[i].HARGA_SR +"</td>";
          var row4 = "<td>"+ data[i].TOT_HARGA +"</td></tr></tbody></table>";

          $('#myTabs').append(row + row1 + row2 + row3 + row4);
          }
        }
      }
    });
  });

  //---------SET INPUT MODAL EDIT PR-------------//
  $('.edit').click(function(){
    const id = $(this).data('id');

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_requisition/setPr',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        console.log(data);
        $('#nmPr').val(data.NO_PR);
        $('#usr').val(data.USER);
        $('#tgl_pr').val(data.TGL_PR);

      }
    });
  });

  //--------TOMBOL KEMBALI----------//
  $('#back').click(function(){
    location.replace('http://localhost/Necs/public/purchased_requisition/1');
  });
}

//PURCHASED_ORDER

if (window.location.href.indexOf('/purchased_order') > 0 && window.location.href.indexOf('/detail') == -1 ) {

  $(document).ready(function(){
    $('#noPr').select2();
  });

  $('#noPr').change(function(){
    var id = document.getElementById('noPr').value;
    $('#numRow').remove();

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_order/getSp',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        $('#sp').val(data.NAMA_SP);
        $('#hdnSp').val(data.KODE_SP);
      }
    });

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_order/getBrg',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        console.log(data);
        for (var i = 0; i < data.length; i++) {
          var row = "<tbody><tr id='numRow'><td>"+ data[i].NAMA_BRG +"</td>";
          var row0 = "<td style='display:none'><input type='text' name='kd[]' value='"+ data[i].KODE_BRG +"'></td>";
          var row1 = "<td><input type='number' style='width:40%' name='qty[]' value='"+ data[i].QTY_MINTA +"'></td>";
          var row2 = "<td>"+ data[i].Satuan +"</td>";
          var row3 = "<td><input type='number' style='width:60%' name='hrg[]' value='"+ data[i].HARGA_SR +"' readonly></td>";
          var row4 = "<td>"+ data[i].TOT_HARGA +"</td></tr></tbody></table>";

          $('#tbPr').append(row + row0 + row1 + row2 + row3 + row4);
        }
      }
    });
  });

}

if ( window.location.href.indexOf('/Necs/public/purchased_order/detail') && window.location.href.indexOf('purchased_requisition') == -1 ) {

  //-----------MODAL VIEW DETAIL PO-------------//
  $('.dtl').click(function(){
    const i = $(this).data('id');
    var id = decodeURIComponent(i);

    $('#Po').text(id);
    $('#edt').prop('disabled', true);
    $('.numRow').remove();
    $('#Po').val('');
    $('#tbPmsn').val('');
    $('#tbDept').val('');
    $('#tbSpr').val('');
    $('#tbTgl').val('');


    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_order/getPo',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        $('#Po').val(data.NO_PO);
        $('#tbPmsn').val(data.PEMESAN);
        $('#tbDept').val(data.NMDEF);
        $('#tbSpr').val(data.NAMA_SP);
        $('#tbTgl').val(data.TGL_PO);
      }
    });

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_order/getDtl',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        console.log(data);

        for (var i = 0; i < data.length; i++) {
          var row = "<tbody><tr class='numRow'><td>" +data[i].NAMA_BRG+ "</td>";
          var row0 = "<td><input type='number' name='qty[]' class='qty' style='width:70%' value='" +data[i].QTY_ORDER+ "'></td>";
          var row1 = "<td>" +data[i].QTY_TERIMA+ "</td>";
          var row2 = "<td>" +data[i].Satuan+ "</td>";
          var row3 = "<td>" +data[i].HARGA_PO+ "</td>";
          var row4 = "<td>" +data[i].TOT_HARGA+ "</td></tr></tbody>";
          var row5 = "<td style='display:none'><input type='hidden' name='kd[]' value=" +data[i].KODE_BRG+ "></td>";

          $('#myTabs').append(row + row5 + row0 + row1 + row2 + row3 +row4);
        }
        $(".qty").on('click keypress', function(){
          console.log('Hello world');
          $('#edt').prop('disabled', false);
        });
      }
    });

  });

  //----------SET EDIT PURCHASED ORDER-----------//
  $('.edt').click(function(){
    const id = $(this).data('id');
    $('#noPo').val('');
    $('#tgl_po').val('');

    $.ajax({
      url: 'http://localhost/Necs/public/purchased_order/getPo',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        $('#noPo').val(data.NO_PO);
        $('#tgl_po').val(data.TGL_PO);
      }
    });
  });

  $('#back').click(function(){
    location.replace('http://localhost/Necs/public/purchased_order/1');
  });
}

//BARANG

if (window.location.href.indexOf('/Necs/public/barang') > 0 && window.location.href.indexOf('cari') == -1 ) {

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

if ( window.location.href.indexOf('/Nces/public/barang/cari') > 0 ) {
  $('.pgNum').click(function(){
    var page = $(this).text();
    $('.pgNum').attr("href", "http://localhost/Necs/public/barang/cari/" +page+ "");
  });
}

//BARANG MASUK

if (window.location.href.indexOf('/Necs/public/barang_masuk') > 0 ) {

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
      console.log(document.getElementById('poBa').value);
      var cmbVl = document.getElementById('poBa').value;
      console.log(cmbVl);
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
               var new_input = "<tbody><tr><td><input type='text' placeholder='Barang...' name='optBrg[]' id='optBrg" + i + "' class='form-control' value='" + data[i].NAMA_BRG + "'></td>";

               var new_input1 = "<td><input type='number' placeholder='Harga...' name='hrgBl[]' id='hrgBl" + i + "' class='form-control' value='" + data[i].HARGA_PO + "'></td>";

               var new_input2 = "<td><input type='number' placeholder='Quantity...' name='qty[]' id='qty" + i + "' class='form-control'></td>";

               var new_input3 = "<td><button type='button' id='remove' class='btn btn-danger' onclick=''><i class='fas fa-minus'></i></td>";

               var new_input4 = "<td style='display:none'><input type='hidden' name='kdBrg[]' id='kdBrg" + i + "' class='form-control' value='" + data[i].KODE_BRG + "'></td></tr></tbody>";

              $('#tbBa').append(new_input + new_input1 + new_input2 + new_input3 + new_input4);

              $('#tbBa').val(i);
              var appenddata2 = i;
              $('#tbBa').on('click', '#remove', function(e){
                e.preventDefault();
                $(this).parent('td').parent('tr').parent('tbody').remove();
              });
             }
               $("#optBrg").val(appenddata1);

       }
     });
  });

  //---------EDIT HEADER BERITA ACARA----------//
  $('.edit').on('click', function() {
    const id = $(this).data('id');
    $('#No_msk').val('');
    $('#noSRJLN2').val('');
    $('#tanggalTerima2').val('');

    $.ajax({
      url: 'http://localhost/Necs/public/barang_masuk/getUbahTmp',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        console.log(data);
        $('#nobcra').val(data.NO_BCRA);
        $('#noSRJLN2').val(data.NO_SRJLN);
        $('#tanggalTerima2').val(data.TGL_BCRA);
      }
    });
  });


  //---------INPUT DETAIL BERITA ACARA----------//
  $('.inptDtl').click(function() {
    const id = $(this).data('id');
    console.log(id);
  });


  //----------EDIT DETAIL BARANG MASUK----------//
  $('.dtlBa').click(function(){
    const id = $(this).data('id');
    $('#nomsk').text('');
    $('#no_msk').val('');
    $('#nopo').text('');
    $('#nosrjln').text('');
    $('#sp').text('');
    $('#tgltrm').text('');
    $('.data').remove();
    $('#editDtl').prop("disabled", true);

    $.ajax({
      url: 'http://localhost/Necs/public/barang_masuk/getUbah',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        $('#nomsk').text(data[0].NO_BCRA);
        $('#no_msk').val(data[0].NO_BCRA);
        $('#nopo').text(data[0].NO_PO);
        $('#nosrjln').text(data[0].NO_SRJLN);
        $('#sp').text(data[0].NAMA_SP);
        $('#tgltrm').text(data[0].TGL_BCRA);

        for (var i = 0; i < data.length; i++) {
          var row = "<tbody class='data'><tr><td>" +data[i].NAMA_BRG+ "</td>";
          var row0 = "<td style='display:none'><input type='hidden' name='brg[]' value='" +data[i].KODE_BRG+ "''></td>";
          var row1 = "<td><input type='number' class='form-control qty' name='qty[]' value='" +data[i].QTY_TERIMA+ "'></td>";
          var row2 = "<td>" +data[i].satuan+ "</td>";
          var row3 = "<td>" +data[i].HARGA_BL+ "</td>";
          var row4 = "<td><button type='button' class='btn btn-danger hps' data-id='" +data[i].NO_BCRA+ "' data-kd='" +data[i].KODE_BRG+ "' ><i class='fa fa-trash'></i></button></td></tr></tbody>";

          $('#tabBa').append(row + row0 + row1 + row2 + row3 + row4);
        }
        $('#tabBa').on('click', '.qty', function(){
          $('#editDtl').prop("disabled", false);
        });
      }
    });
  });

  //-------HAPUS DETAIL BARANG MASUK--------//
  $('#tabBa').on('click', '.hps', function(){
    const id = $(this).data('id');
    const kd = $(this).data('kd');

    $.ajax({
      type: 'post',
      url: 'http://localhost/Necs/public/Barang_masuk/hapusDtl',
      data: {id : id, kd : kd},
      success: function(data) {
        if ( data == true ) {
          alert("Berhasil Menghapus Data");
          window.location.replace("http://localhost/Necs/public/Barang_masuk");
        } else {
          alert("Gagal Menghapus Data");
          window.location.replace("http://localhost/Necs/public/Barang_masuk");
        }
      },
      error: function(xhr, status, error) {
        var errorMessage = xhr.status + ': ' + xhr.statusText
        alert("DATA GAGAL DIHAPUS " + errorMessage);
      }
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

  //------COMBOBOX BARANG-------//
  $(document).ready(function() {
    $('.selectBrg').select2();
  });

  //-----ADD FIELD TAMBAH BARANG----//
  $('.selectBrg').on('change', function() {
      var value = document.getElementById('selectBrg').value;
      var nama = $(".selectBrg option:selected").text();

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
    const kd = $(this).data('kd');
    console.log(id);
    console.log(kd);

    $.ajax({
        url: 'http://localhost/Necs/public/Barang_keluar/getUbah',
        data: {No_pakai : id, kode_brg : kd},
        method: 'post',
        dataType: 'json',
        success: function(data) {
          console.log(data);
            $('#inputNoPk2').val(data.NOMOR_SLIP);
            $('#kd_brg').val(data.KODE_BRG);
            $('#namaBrg2').val(data.KODE_BRG);
            $('#shift2').val(data.SHIFT);
            $('#posting2').val(data.POSTING);
            $('#tanggalkeluar2').val(data.TANGGAL_OUT);
            $('#keterangan2').val(data.KETERANGAN);
            $('#nama2').val(data.NAMA_USER);
            $('#noRef2').val(data.NO_REF);
            $('#qtyMinta2').val(data.QUANTITY_MINTA);
            $('#No_pk').val(data.NOMOR_SLIP);
        }
    });
  });

  //-------HAPUS BARANG KELUAR----------//
  $('.hps').click(function(){
    var id = $(this).data('id');
    var brg = $(this).data('brg');

    $.ajax({
      url: 'http://localhost/Necs/public/Barang_keluar/hapus',
      data: {id : id, brg : brg},
      method: 'post',
      success: function() {
        alert("DATA BERHASIL DIHAPUS");
        window.location.replace("http://localhost/Necs/public/Barang_keluar");
      },
      error: function(xhr, status, error) {
        var errorMessage = xhr.status + ': ' + xhr.statusText
        alert("DATA GAGAL DIHAPUS " + errorMessage);
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
