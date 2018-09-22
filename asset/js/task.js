//for (i=0;i<popovers.length;i++){
//	$("#t-5").attr('data-original-title', 'Unit Yang Dipilih');
//	$("#t-5").attr('data-content',"Data yang dipilih adalah ");
//
var once = document.getElementsByClassName("one");
for(i=0;i<once.length;i++){
	id_x25 = once[i].id;
	id_x = id_x25.split("-");
	$("#"+id_x25).text(obj_unit[id_x[2]].no_unit+"-"+obj_unit[id_x[2]].nama_apt);
}
$(".some").popover();
$(".exclusions").popover();

	function validate(){
		var x = document.getElementsByClassName("items");
		var str = ''; var spare='';
		if(document.getElementById("unit").value=="Semua"){
			spare='!';
		} else {
			spare='&';
		}
		for(i=0;i<x.length;i++){
			str2 = x[i].id.split("-");
			str += spare+str2[1];
		}
		
		if(spare=='&' && str==''){
			return false;
		} else {
			$(".hidden-C").append('<input name="kd_unit" id="kd_unit" type="text" class="span2" />');
			$("#kd_unit").val(str);
			return true;
		}
	}

	function filter() {
		var input, filter, ul, li, a, i, x=0;
		input = document.getElementById("searchh");
		filter = input.value.toUpperCase();
		a = $(".items-opt");
		for (i = 0; i < a.length; i++) {
	    	if (a[i].innerHTML.toUpperCase().indexOf(filter)>=0) {
		      	a[i].style.display = ""; x++;
		    } else {
		       a[i].style.display = "none";
		    }
   		 }
    	return x;
	}

	function add_sel(x){
		var no_unit = obj_unit[x].no_unit;
		$("#opt-"+x).remove();
		$("#selected-items").append('<div id="sel-'+x+'" class="items">'+no_unit+'<a onclick="del_sel('+x+');" class="mineClose">×</a></div>');
		document.getElementById("unit-option").style.visibility = "hidden";
		$("#searchh").val("");
		$("#searchh").focus();
	}
	
	function del_sel(x){
		$("#sel-"+x).remove();
		$('#unit-option').append("<a onclick='add_sel("+x+")' id=opt-"+x+" class='items-opt'>"+obj_unit[x].no_unit+" - "+obj_unit[x].nama_apt+"</a>");
		$("#searchh").focus();
	}

	function setDefaultCombo(){
		var x = document.getElementsByClassName("items");
		for(i=0;i<x.length;i++){
			str2 = x[i].id.split("-");
			del_sel(str2[1]);
		}		
	}

	$("#searchh").focus(function(){
    	$(".text-box").addClass("sel-text-box");
	});

	$("#searchh").blur(function(){
    	$(".text-box").removeClass("sel-text-box");
	});

	$("#searchh").keyup(function(){
		if($("#searchh").val()!=""){
			document.getElementById("unit-option").style.visibility = "visible";
			a = filter();
			if(a==0)
				document.getElementById("unit-option").style.visibility = "hidden";
		} else {
			document.getElementById("unit-option").style.visibility = "hidden";
		}
	});

	$('.edit').click(function(){
		/*
	    var i = $(this).attr('id');
	    $.ajax({
	      type: "POST", 
	      url: "../../../proses/task.php", 
	      data: {id : i}, 
	      dataType: "json",
	      beforeSend: function(e) { 
	        if(e && e.overrideMimeType) {
	          e.overrideMimeType("application/json;charset=UTF-8");
	        }
	      },
	      success: function(response){ 
	          $("#task").val(response.task);
	          //$("#unit").val(response.unit);
	          if(response.sifat=="Sekali"){
	          	document.getElementById("has_look").checked = true;
	          }
	          $("#sifat").val(response.sifat);
	          $("#kd_task").val(i);
	          $("#submit").attr('name','updateTask');
	          $("#submit").val('Update');
	          $("#popup").click();
	      },
	      error: function (xhr, ajaxOptions, thrownError) { 
	        alert(thrownError); 
	      }
	    });
	    */
	    alert("Fitur ini masih dalam pengembangan, untuk sementara silahkan hapus dan buat ulang baru");  
	});

	$('.closes').click(function(){
	  $("#submit").attr('name','addTask');
	  $("#submit").val('Tambah');
	  $("#kd_task").val('null');
	  $("#task").val("");
	  $("#unit").val("Semua");
	  $("#sifat").val("Rutin");  
	});

	$("#unit").change(function(){
		var z = document.getElementById("unit").value;
		if(z=="Semua"){
			$("#cap-s").text("Exclusion Unit :");
			$("#searchh").val("");
			$("#searchh").attr({'disabled':'disabled'});
			$("#has_look").show();
		} else {
			$("#cap-s").text("Pilihan Unit :");
			$("#searchh").removeAttr("disabled");
			$("#has_look").hide();
		}
		document.getElementById("unit-option").style.visibility = "hidden";
		setDefaultCombo();
		document.getElementById("has_look").checked = false;
	});

	$("#has_look").change(function(){
		if(document.getElementById("has_look").checked){
			$("#searchh").removeAttr("disabled");
		} else {
			$("#searchh").attr({'disabled':'disabled'});
		}
		setDefaultCombo();
	});

	$("#sifat").change(function (){
		if(document.getElementById("sifat").value=="Rutin"){
			$("#tgl-C").hide();
			$("#tgl_task").removeAttr("required");
		} else {
			$("#tgl-C").show();
			$("#tgl_task").attr({'required':'required'});
		}
	});

	$(".some").hover(function(){
		if($(this).attr("data-content")=="..."){
			var id_x27 = this.id;
			var id_x29 = id_x27.split("&");
			var string = obj_unit[id_x29[1]].no_unit+"-"+obj_unit[id_x29[1]].nama_apt;
			for(i=2;i<id_x29.length;i++){
				string += "<br>"+obj_unit[id_x29[i]].no_unit+"-"+obj_unit[id_x29[i]].nama_apt;
			}
			$(this).attr("data-content",string);
		}
	}, function(){});

	$(".exclusions").hover(function(){
		if($(this).attr("data-content")=="..."){
			var id_x27 = this.id;
			var id_x29 = id_x27.split("!");
			var string = obj_unit[id_x29[1]].no_unit+"-"+obj_unit[id_x29[1]].nama_apt;
			for(i=2;i<id_x29.length;i++){
				string += "<br>"+obj_unit[id_x29[i]].no_unit+"-"+obj_unit[id_x29[i]].nama_apt;
			}
			$(this).attr("data-content",string);
		}
	}, function(){});	