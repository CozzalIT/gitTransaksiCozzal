  var a = document.getElementById('nama').value;
  
  var timer;  
  
  $("#p_lama").hide();
  $(".loading").hide();

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
      $.post('../../../proses/booked.php', {getList : input},
      function (data) {
      response = JSON.parse(data);
        $(".loading").hide();
        $("#note-anak-isi").append(response.isi);
      });
  }

  function select(x){
    //alert(x.id);
    $(".active").removeClass("active");
    $(x).addClass("active");
    $("#kd_penyewa").val(x.id);
    $("#next").removeAttr("disabled");
  }

  $("#ck").click(function(){
    if(!this.checked){
      $("#p_lama").show();
      $("#p_baru").hide();
      $("#cap-title").text("Pilih Penyewa");
      $("#icon-title").attr("class","icon-signin");
    } else {
      $("#p_lama").hide();
      $("#p_baru").show();
      $("#cap-title").text("Data Penyewa Baru");
      $("#icon-title").attr("class","icon-user");
    }
  });

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
              $("#kd_penyewa").val(response.status);
              $("#next").removeAttr("disabled");
              $("#next").click();           
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
