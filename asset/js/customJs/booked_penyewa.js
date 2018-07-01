  var a = document.getElementById('nama').value;
  var has_loaded = false;
  $("#p_lama").hide();

  function setkelamin(jenis){
      $("#jenis_kelamin").val(jenis);
  }

  function filter() {
    var input, filter, ul, li, a, i, x=0;
    input = $(".search").val();
    filter = input.toUpperCase();
    a = $(".list-penyewa");
    for (i = 0; i < a.length; i++) {
      //alert(a[i].innerHTML);
        if (a[i].innerHTML.toUpperCase().indexOf(filter)>=0) {
            a[i].style.display = ""; x++;
        } else {
           a[i].style.display = "none";
        }
       }
      return x;
  }

  function request_penyewa(jenis){
      $.post('../../../proses/booked.php', {getList : a, jenis : jenis},
      function (data) {
      response = JSON.parse(data);
        $(".loading").hide();
        $("#note-anak-isi").append(response.isi);
        has_loaded = true;
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
      if(!has_loaded){
        $(".loading").show();
        request_penyewa("like");
      }
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
        $("#pilih-penyewa").text("Penyewa telah terdaftar, mohon tunggu ...");
        var res = JSON.parse(data);
        if (res.status=="oke"){
          $.post('../../../proses/booked.php', {getPenyewa : nama, no_tlp : no_tlp },
          function (data) {
            response = JSON.parse(data);
            $("#kd_penyewa").val(response.kd_penyewa);
            $("#next").removeAttr("disabled");
            $("#next").click();
          });
        } else {
            swal("Data Penyewa Gagal Didaftarkan", "Silahkan coba ulangi lagi", "success");
        }
      });
    } else {
      alert("Lengkapi data terlebih dahulu");
    }
  });
