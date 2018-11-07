  var a = document.getElementById('nama').value;
  
  var timer;  
  
  $(".loading").hide();
  $("#IDPenyewa").hide();

  function setkelamin(jenis){
      $("#jenis_kelamin").val(jenis);
  }

  function filter() {
    clearTimeout(timer);
    // cancel selected item
    $("#kd_penyewa").val("");
    $("#next").attr("disabled",'disabled');

    var input;
    input = $(".search").val();
    // removing all the child 
    var list_base = document.getElementById("note-anak-isi");
    while(list_base.firstChild){
      list_base.removeChild(list_base.firstChild);
    }    

    if(input!=""){
      timer = setTimeout(request_penyewa,700);
    } 
  }

  function stop_filter(){
    clearTimeout(timer);
  }

  function request_penyewa(){
      var input;
      input = $(".search").val();

      $(".loading").show();
      $.post('../../../proses/transaksi_broker.php', {getList : input},
      function (data) {
        res = JSON.parse(data);
        if(res.length==0){
          $("#note-anak-isi").append('<div class="note"> Tidak ditemukan penyewa </div>');
        } else {
          for(var i=0; i<res.length; i++){
            var str = '<div id="'+res[i].kd_penyewa+'" onclick="select(this);" data-nama="'+res[i].nama+'" data-alamat="'+res[i].alamat+'"';
            str += '" data-email="'+res[i].email+'" data-tlp="'+res[i].no_tlp+'" data-dismiss="modal"';
            str += 'style="cursor:pointer;" class="note list-penyewa"><strong>'+res[i].nama+'</strong>';
            str += '<br>'+res[i].alamat+'<div style="text-align:right;float:right;">'+res[i].no_tlp+'</div></div>';
            $("#note-anak-isi").append(str);
          }
        }
        $(".loading").hide();
      });
  }

  function select(x){
    $("#kd_penyewa").val(x.id);
    $("#nama_penyewa").val($(x).data('nama'));
    $("#alamat_penyewa").val($(x).data('alamat'));
    $("#email_penyewa").val($(x).data('email'));
    $("#no_tlp_penyewa").val($(x).data('tlp'));
    $("#IDPenyewa").show();
    $("#head-tgl").attr({'href':'#collapseGFour'});
  }

  $("#pilih-penyewa").click(function(){
    var nama = $("#nama").val();
    var alamat = $("#alamat").val();
    var jenis_kelamin = $("#jenis_kelamin").val();
    var email = $("#email").val();
    var no_tlp = $("#no_tlp").val();
    no_tlp = no_tlp.replace(" ","");
    if(nama!="" && alamat!="" && jenis_kelamin!="" && email!="" && no_tlp!=""){
      $(this).attr({"disabled":"disabled"});
      $(this).text("Mendaftaran Penyewa...");
      $.post('../../../proses/booked.php', {
        daftar_penyewa : nama, alamat : alamat, email : email,
        jenis_kelamin : jenis_kelamin, no_tlp : no_tlp
      },
      function (data) {
          response = JSON.parse(data);
          if(response.status!="gagal"){
            $("#pilih-penyewa").text("Penyewa berhasil didaftarkan");
            setTimeout(function(){
              $(".close").click();           
              $("#kd_penyewa").val(response.status);
              $("#nama_penyewa").val(nama);
              $("#alamat_penyewa").val(alamat);
              $("#email_penyewa").val(email);
              $("#no_tlp_penyewa").val(no_tlp);
              $("#IDPenyewa").show();
              $("#head-tgl").attr({'href':'#collapseGFour'});              
            }, 1000);            
          } else {
            var a = '<div class="alert alert-danger" style="margin:0px;" role="alert">';
            a += 'Pendaftar gagal terdaftar. Sistem sedang sibuk, silahkan coba beberapa saat.';
            a += '</div>';
            $("#alert_element").text(s);
          }
      });
    } else {
      alert("Lengkapi data terlebih dahulu");
    }
  });
