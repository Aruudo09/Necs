// PLUGIN FOR JAVASCRIPT --> select2(), DataTables

$(function() {


//SURAT REQUEST
if (window.location.href.indexOf('/Necs/public/surat_request') > -1 ) {

  //-----SELECT2() OPTION BARANG------//
  $(document).ready(function () {
    $('#inptBrgSr').select2();
  });

  //-----GENERATE FIELD INPUT BARANG DI SR-----//
  $('.inptBrgSr').on('change', function() {
    var value = document.getElementById('inptBrgSr').value;
    var nama = $(".inptBrgSr option:selected").text();


    var new_input = "<tr><td><input type='text' name='nmBrg[]' class='form-control' value='" + nama +"'></td>";

    var new_input1 = "<td><input type='number' placeholder='Quantity...' name='qty[]' class='form-control'></td>";

    var new_input3 = "<td><button type='button' class='btn btn-danger remove'><i class='fa fa-trash'></i></button></td>"

    var new_input4 = "<td style='display:none'><input type='hidden' placeholder='Kode Barang...' name='kdBrg[]' class='form-control' value='" + value +"'></td></tr>";


     $('#tabInpt').append(new_input + new_input1 + new_input3 + new_input4);


  });

  //-----MENGURANGI FIELD BARANG DI SR-----//
  $(document).on('click', '#tabInpt .remove',function() {
    $(this).parent('td').parent('tr').remove();
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
    $('#Sr').text('');
    $('#hdnSr').val('');
    $('#Pr').text('');
    $('#Po').text('');
    $('#tbPmnt').text('');
    $('#tbDept').text('');
    $('#tbSpr').text('');
    $('#tbTgl').text('');
    $('.numRow').remove();
    $('#editDtl').prop('disabled', true);

    $.ajax({
      url: 'http://localhost/Necs/public/Surat_request/getSr',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        if ( data.NO_PR == undefined || data.NO_PR == '') {
          $('#Pr').text('Belum Tersedia');
        } else {
          $('#Pr').text(data.NO_PR);
        }

        if ( data.NO_PO == undefined || data.NO_PO == '' ) {
          $('#Po').text('Belum Tersedia');
        } else {
          $('#Po').text(data.NO_PO);
        }

        if ( data.NAMA_SP == undefined || data.NAMA_SP == '' ) {
          $('#tbSpr').text("Belum Tersedia");
        } else {
          $('#tbSpr').text(data.NAMA_SP);
        }

          $('#Sr').text(data.NO_SR);
          $('#hdnSr').val(data.NO_SR);
          $('#tbPmnt').text(data.PEMINTA);
          $('#tbDept').text(data.NMDEF);
          $('#tbTgl').text(data.TGL_SR);

      }
    });

    $.ajax({
      url: 'http://localhost/Necs/public/Surat_request/getSrDtl',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        if ( data.length == 0) {
          alert("DATA DETAIL KOSONG");
        } else if ( data[0].NO_PR != null ) {
          for (var i = 0; i < data.length; i++) {
            var row = "<tbody><tr class='numRow'><td>" +data[i].NAMA_BRG+ "</td>";
            var row0 = "<td style='display:none'>" +data[i].KODE_BRG+ "</td>";
            var row1 = "<td>" +data[i].QTY_MINTA+ "</td>";
            var row2 = "<td>" +data[i].Satuan+ "</td>";
            var row5 = "<td><button disabled type='button' class='btn btn-danger hpsDtl' data-id='" +data[i].NO_SR+ "' data-kd='" +data[i].KODE_BRG+ "'><i class='fa fa-trash'></i></button></td></tr></tbody>";

          $('#myTabs').append(row + row0 + row1 + row2 + row5 );
         }
        } else {

          for (var i = 0; i < data.length; i++) {
            var row = "<tbody><tr class='numRow'><td>" +data[i].NAMA_BRG+ "</td>";
            var row0 = "<td style='display:none'><input type='hidden' name='brg[]' value='" +data[i].KODE_BRG+ "'></td>";
            var row1 = "<td><input type='number' name='qty[]' class='qty' value='" +data[i].QTY_MINTA+ "'></td>";
            var row2 = "<td>" +data[i].Satuan+ "</td>";
            var row5 = "<td><button type='button' class='btn btn-danger hpsDtl' data-id='" +data[i].NO_SR+ "' data-kd='" +data[i].KODE_BRG+ "'><i class='fa fa-trash'></i></button></td></tr></tbody>";

          $('#myTabs').append(row + row0 + row1 + row2 + row5 );
          }
        }
      }
    });
  });

    //-------EDIT DETAIL SR---------//
    $(document).on('click keypress', '.numRow .qty', function(){
      $('#editDtl').prop('disabled', false);
    });

    $(document).on('click keypress', '.numRow .hrg', function(){
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

//PURCHASED_REQUISITION
if (window.location.href.indexOf('/Necs/public/purchased_requisition') > -1 && window.location.href.indexOf('detail') == -1 ) {

  $(document).ready(function(){
    $('#noSr').select2();
  });

  //----------GENERATE NOMOR PR DAN SUPPLIER-------------//
  $('#noSr').change(function(){
    const id = $(this).val();
    $('.dftrRow').remove();
    var sr = document.getElementById('noSr').value;
    var init = document.getElementById('init').value;

    if ( sr.substring(0,7).endsWith('/')) {
      $('#noPr').val(sr.substring(0,6) + '-' + init + sr.substring(6));
      $('#hdnPr').val(sr.substring(0,6));
    } else {
      $('#noPr').val(sr.substring(0,7) + '-' + init + sr.substring(7));
      $('#hdnPr').val(sr.substring(0,7));
    }

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_requisition/dtlSr',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        for (var i = 0; i < data.length; i++) {
          var row = "<tr class='dftrRow'><td>" +data[i].NAMA_BRG+ "</td>";
          var row1 = "<td>" +data[i].QTY_MINTA+ "</td>";
          var row2 = "<td>" +data[i].Satuan+ "</td></tr>";

          $('#dftrBrg').append(row + row1 + row2);
        }
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

            if ( data[0].NAMA_SP == undefined ) {
              $('#tbSpr').text('Belum Tersedia');
            } else {
              $('#tbSpr').text(data[0].NAMA_SP)
            }
            $('#tbSr').text(data[0].NO_SR);
            $('#tbPmnt').text(data[0].PEMINTA);
            $('#tbDept').text(data[0].NMDEF);

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

//-----PENCARIAN SAAT DI DETAIL PR------//
if (window.location.href.indexOf('/Necs/public/purchased_requisition/detail') > -1 ) {

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
      url: 'http://localhost/Necs/public/Purchased_requisition/setPr',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        if (data.NAMA_SP == undefined) {
          $('#tbSpr').text('Belum Tersedia');
        } else {
          $('#tbSpr').text(data.NAMA_SP);
        }
        $('#tbSr').text(data.NO_PR);
        $('#tbPmnt').text(data.USER);
        $('#tbDept').text(data.NMDEF);
      }
    });

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_requisition/getDtlPr',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        if (data.length == 0 ) {
          alert("Detail Data Kosong");
        } else {

            for (var i = 0; i < data.length; i++) {
              var row = "<tr class='numRow'><td>"+ data[i].NAMA_BRG +"</td>";
              var row1 = "<td>"+ data[i].QTY_MINTA +"</td>";
              var row2 = "<td>"+ data[i].Satuan +"</td></tr>";

              $('#myTabs').append(row + row1 + row2);
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
        $('#nmPr').val(data.NO_PR);
        $('#usr').val(data.USER);
        $('#tgl_pr').val(data.TGL_PR);

      }
    });
  });

  //--------TOMBOL KEMBALI----------//
  $('#back').click(function(){
    location.replace('http://localhost/Necs/public/purchased_requisition/1/');
  });
}

//PURCHASED_ORDER
if (window.location.href.indexOf('/purchased_order') > 0 && window.location.href.indexOf('/detail') == -1 ) {

  $(document).ready(function(){
    $('#noPr').select2();
  });

  //--------GENERATE DAFTAR BARANG--------//
  $('#noPr').change(function(){
    var id = document.getElementById('noPr').value;
    $('.numRow').remove();

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
        for (var i = 0; i < data.length; i++) {
          var row = "<tr class='numRow'><td>"+ data[i].NAMA_BRG +"</td>";
          var row0 = "<td style='display:none'><input type='text' name='kd[]' value='"+ data[i].KODE_BRG +"'></td>";
          var row1 = "<td><input type='number' style='width:40%' name='qty[]' value='"+ data[i].QTY_MINTA +"'></td>";
          var row2 = "<td>"+ data[i].Satuan +"</td>";
          var row3 = "<td><input type='number' style='width:60%' name='hrg[]' value=''></td>";
          var row4 = "<td><button type='button' class='btn btn-danger remove'><i class='fa fa-minus'></i></button></td></tr>"

          $('#tbPr').append(row + row0 + row1 + row2 + row3 + row4);
        }
      }
    });
  });

  //----------HAPUS ROW TABLE----------//
  $(document).on('click', '#tbPr .remove', function(){
    $(this).parent('td').parent('tr').remove();
  });

}

if ( window.location.href.indexOf('/Necs/public/purchased_order/detail') > -1 ) {

  //-----------MODAL VIEW DETAIL PO-------------//
  $('.dtl').click(function(){
    const i = $(this).data('id');
    var id = decodeURIComponent(i);

    $('#Po').text(id);
    $('#edt').prop('disabled', true);
    $('.numRow').remove();
    $('#Po').text('');
    $('#tbPmsn').text('');
    $('#tbDept').text('');
    $('#tbSpr').text('');
    $('#tbTgl').text('');


    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_order/getPo',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {

        if ( data.NAMA_SP == undefined) {
          $('#tbSpr').text('Belum Tersedia');
        } else {
          $('#tbSpr').text(data.NAMA_SP);
        }

        var sr = data.NO_PO.split('/').join('F');
        $('#ctk').attr("href", "http://localhost/Necs/public/purchased_order/report/" + sr +"");
        $('#Po').text(data.NO_PO);
        $('#hdnPo').text(data.NO_PO);
        $('#tbPmsn').text(data.PEMESAN);
        $('#tbDept').text(data.NMDEF);
        $('#tbTgl').text(data.TGL_PO);
      }
    });

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_order/getDtl',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {

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
if (window.location.href.indexOf('/Necs/public/barang') > -1 ) {

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
      $('#stckMin').val('');
      $('#stckMax').val('');
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
if (window.location.href.indexOf('/Necs/public/barang_masuk') > -1 ) {

  //------SELECT2() TAMBAH BARANG------//
  $(document).ready(function(){
    $('#poBa').select2();
  });

  $('.btnSmpn').click(function(){
    document.getElementById('poBa').disabled = false;
  });

  //---------CLICK UNTUK MEN-GENERATE NOMOR BA-------------//
  $('#poBa').change(function() {
      var cmbVl = document.getElementById('poBa').value;
      $('.brgRow').remove();
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
               var sisa = data[i].QTY_ORDER - data[i].QTY_TERIMA;

               var new_input = "<tr class='brgRow'><td><input type='text' placeholder='Barang...' name='optBrg[]' id='optBrg" + i + "' class='form-control' value='" + data[i].NAMA_BRG + "' readonly></td>";

               var new_input0 = "<td><input type='text' class='form-control' name='sisa' value='" +sisa+ "' readonly></td>";

               var new_input1 = "<td><input type='number' placeholder='Quantity...' name='qty[]' id='qty" + i + "' class='form-control'></td>";

               var new_input2 = "<td><input type='number' placeholder='Harga...' name='hrgBl[]' id='hrgBl" + i + "' class='form-control' value='" + data[i].HARGA_PO + "' readonly></td>";

               var new_input3 = "<td><button type='button' id='remove' class='btn btn-danger' onclick=''><i class='fas fa-minus'></i></td>";

               var new_input4 = "<td style='display:none'><input type='hidden' name='kdBrg[]' id='kdBrg" + i + "' class='form-control' value='" + data[i].KODE_BRG + "'></td></tr>";

              $('#tbBa').append(new_input + new_input0 + new_input1 + new_input2 + new_input3 + new_input4);

              $('#tbBa').val(i);
              var appenddata2 = i;
              $('#tbBa').on('click', '#remove', function(e){
                e.preventDefault();
                $(this).parent('td').parent('tr').remove();
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
      url: 'http://localhost/Necs/public/barang_masuk/getUbahTmp',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        $('#nomsk').text(data.NO_BCRA);
        $('#no_msk').val(data.NO_BCRA);
        $('#nopo').text(data.NO_PO);
        $('#nosrjln').text(data.NO_SRJLN);
        $('#pnrm').text(data.PENERIMA);
        $('#sp').text(data.NAMA_SP);
        $('#tgltrm').text(data.TGL_BCRA);

        var sr = data.NO_BCRA.split('/').join('F');
        $('#btnCtk').attr("href", "http://localhost/Necs/public/barang_masuk/report/"+sr+"");
      }
    });

    $.ajax({
      url: 'http://localhost/Necs/public/barang_masuk/getUbah',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        if ( data.length == 0 ) {

        } else {

          for (var i = 0; i < data.length; i++) {
            var row = "<tr class='data'><td>" +data[i].NAMA_BRG+ "</td>";
            var row0 = "<td style='display:none'><input type='hidden' name='brg[]' value='" +data[i].KODE_BRG+ "''></td>";
            var row1 = "<td><input type='number' class='form-control qty' name='qty[]' value='" +data[i].QTY_TERIMA+ "'></td>";
            var row2 = "<td>" +data[i].satuan+ "</td>";
            var row3 = "<td>" +data[i].HARGA_BL+ "</td>";
            var row4 = "<td><button type='button' class='btn btn-danger hps' data-id='" +data[i].NO_BCRA+ "' data-kd='" +data[i].KODE_BRG+ "' ><i class='fa fa-trash'></i></button></td></tr>";

            $('#tabBa').append(row + row0 + row1 + row2 + row3 + row4);
         }
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

if (window.location.href.indexOf('/Necs/public/barang_masuk/detail') > -1 ) {
  $('.dtl').click(function(){
    const id = $(this).data('id');

    $('.numRow').remove();
    $('#Po').text('');
    $('#tbPmsn').text('');
    $('#tbDept').text('');
    $('#tbSpr').text('');
    $('#tbTgl').text('');

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_order/getPo',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {

        if ( data.NAMA_SP == undefined) {
          $('#tbSpr').text('Belum Tersedia');
        } else {
          $('#tbSpr').text(data.NAMA_SP);
        }

        $('#Po').text(data.NO_PO);
        $('#hdnPo').text(data.NO_PO);
        $('#tbPmsn').text(data.PEMESAN);
        $('#tbDept').text(data.NMDEF);
        $('#tbTgl').text(data.TGL_PO);
      }
    });

    $.ajax({
      url: 'http://localhost/Necs/public/Purchased_order/getDtl',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {

        for (var i = 0; i < data.length; i++) {
          var row = "<tbody><tr class='numRow'><td>" +data[i].NAMA_BRG+ "</td>";
          var row0 = "<td>" +data[i].QTY_ORDER+ "</td>";
          var row1 = "<td>" +data[i].QTY_TERIMA+ "</td>";
          var row2 = "<td>" +data[i].Satuan+ "</td>";
          var row3 = "<td>" +data[i].HARGA_PO+ "</td>";
          var row4 = "<td>" +data[i].TOT_HARGA+ "</td></tr></tbody>";
          var row5 = "<td style='display:none'><input type='hidden' name='kd[]' value=" +data[i].KODE_BRG+ "></td>";

          $('#myTabs').append(row + row5 + row0 + row1 + row2 + row3 +row4);
        }
      }
    });

  });
}

//BARANG KELUAR
if (window.location.href.indexOf('/Necs/public/barang_keluar') > -1 ) {

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
      var new_input1 = "<tr id='bodyRow" + new_row + "'><td><input type='text' placeholder='Barang...' name='nmBrg[]' class='form-control' value='" + nama +"'></td>";

      var new_input2 = "<td><input type='number' placeholder='Quantity...' name='qtyMinta[]' class='form-control'></td>";

      var new_input3 = "<td><input type='text' placeholder='Keterangan...' name='keterangan[]' class='form-control'></td>";

      var new_input4 = "<td><button type='button' class='btn btn-danger delRow'><i class='fa fa-minus'></i></button></td>";

      var new_input5 = "<td style='display:none'><input type='hidden' placeholder='Kode Barang...' name='kdBrg[]'  class='form-control' value='" + value +"'></td></tr>";


       $('#tabKlr').append(new_input1 + new_input2 + new_input3 + new_input4 + new_input5);

       $('#num_row').val(new_row);
    });

  //-----MENGURANGI FIELD BARANG-----//
  $('#tabKlr').on('click', '.delRow',function() {
    var old_row = $('#num_row').val();

     if (old_row > 0) {
       $('#bodyRow' + old_row).remove();
       $('#num_row').val(old_row - 1);
     }
  });

  //----------EDIT BARANG KELUAR-----------//
  $('.editBrgKlr').on('click', function() {
    const id = $(this).data('id');
    console.log(id);

    $.ajax({
        url: 'http://localhost/Necs/public/Barang_keluar/getUbah',
        data: {id : id},
        type: 'post',
        dataType: 'json',
        success: function(data) {
          $('#inputNoKlr').val(data.NOMOR_SLIP);
          $('#tglKlr').val(data.TANGGAL_OUT);
        }
    });
  });

  //------MENAMPILKAN DETAIL BARANG KELUAR------//
  $('.detail').click(function(){
    const id = $(this).data('id');
    $('.rowDtl').remove();
    $('#noslip').text('');
    $('#namaDtl').text('');
    $('#dept').text('');
    $('#shiftDtl').text('');
    $('#post').text('');
    $('#noref').text('');
    $('#tgl').text('');
    $('#editDtl').prop("disabled", true);

    $.ajax({
      url: 'http://localhost/Necs/public/Barang_keluar/getDtl',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        if (data.length == '') {
          alert("Data Kosong");
        } else {
          $('#noslip').text(data[0].NOMOR_SLIP);
          $('#hdnnoslip').val(data[0].NOMOR_SLIP);
          $('#namaDtl').text(data[0].NAMA_USER);
          $('#dept').text(data[0].NMDEF);
          $('#shiftDtl').text(data[0].SHIFT);
          $('#post').text(data[0].POSTING);
          $('#noref').text(data[0].NO_REF);
          $('#tgl').text(data[0].TANGGAL_OUT);

          for (var i = 0; i < data.length; i++) {
            var row = "<tbody class='rowDtl'><tr><td>" +data[i].NAMA_BRG+ "</td>";
            var row0 = "<td style='display:none'><input type='hidden' name='brg[]' value=" +data[i].KODE_BRG+ "></td>";
            var row1 = "<td><input type='number' class='form-control qty' name='qty[]' value='" +data[i].QUANTITY_MINTA+ "'></td>";
            var row2 = "<td>" +data[i].satuan+ "</td>";
            var row3 = "<td><button type='button' class='btn btn-danger delete' data-id="+data[i].NOMOR_SLIP+" data-kd="+data[i].KODE_BRG+"><i class='fa fa-trash'></i></button></td>";

            $('#tabDtl').append(row + row0 + row1 + row2 + row3);s
        }

        }
      },
      error: function(xhr, status, error) {
        var errorMessage = xhr.status + ': ' + xhr.statusText
        alert("Data Kosong");
      }
    });
  });

  //-------HAPUS BARANG KELUAR----------//
  $(document).on('click', '#tabDtl .delete', function(){
    var id = $(this).data('id');
    var kd = $(this).data('kd');

    $.ajax({
      url: 'http://localhost/Necs/public/Barang_keluar/hapusDtl',
      data: {id : id, kd : kd},
      method: 'post',
      dataType: 'json',
      success: function(data) {
        console.log(data);
        alert("DATA BERHASIL DIHAPUS");
        // window.location.replace("http://localhost/Necs/public/Barang_keluar");
      },
      error: function(xhr, status, error) {
        var errorMessage = xhr.status + ': ' + xhr.statusText
        alert("DATA GAGAL DIHAPUS " + errorMessage);
      }
    });
  });

  //--------EDIT DETAIL BARANG KELUAR---------//
  $('#tabDtl').on('click', '.qty', function(){
    $('#editDtl').prop("disabled", false);
  });

}

//SUPPLIER
if ( window.location.href.indexOf('/Necs/public/supplier') > -1 ) {
  //--------TAMBAH SUPPLIER BARU----------//
  $('#tambahSpl').on('click', function() {

    $('#modalLabelSpl').html('Tambah Data Supplier');
    $('.modal-footer button[type=submit]').html('Simpan Data');

    $('#inputNoSpl').val('');
    $('#inputNmSpl').val('');
    $('#alamatSpl').val('');
    $('#keterangan').val('');
    $('#tanggalUpdate').hide();

  });

  //--------MENAMPILKAN DETAIL SP---------//
  $('.dtlSp').click(function(){
    const id = $(this).data('id');

    $.ajax({
      url: 'http://localhost/Necs/public/supplier/getUbah',
      type: 'post',
      data: {KODE_SP : id},
      dataType: 'json',
      success: function(data) {
        $('#npwpInfo').text(data.npwp);
        $('#cp').text(data.HUBUNGAN);
        $('#tgl_inpt').text(data.Tanggal_input);
        $('#qty').text(data.quantity_perbulan);
        $('#alamat').text(data.ALAMAT_SP);
      }
    });
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

          $('#tanggalUpdate').show();
          $('#tanggalInput').hide();
          $('#inputNoSpl').val(data.KODE_SP);
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
}

//ACCOUNT
if ( window.location.href.indexOf('Necs/public/account/detail') > -1 ) {
  $('.edt').click(function(){
    const id = $(this).data('id');
    $('#hdnID').val(id);

    $.ajax({
      url: 'http://localhost/Necs/public/account/getDtl',
      type: 'post',
      data: {id : id},
      dataType: 'json',
      success: function(data) {
        console.log(data);
        $('#usr').val(data.USERNAME);
        $('#dept').val(data.KODEF);
      }
    });
  });
}

  });
