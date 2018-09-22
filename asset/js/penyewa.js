var selected_kd = "";
var penyewa = document.getElementsByClassName("penyewa");
var selectedDetail = -1;
var arr_red = new Array();
var obj = new Array();
red();
//kurangiCapStatus();

function LoadFromObj(n){
	for(var x=0;x<obj.length;x++){
		if(obj[x].kd_penyewa==n)
			return obj[x];
	}
}

function kurangiCapRed(n){
	var x = $("#cap-"+n).text();
	x = x.split("(");
	var y = x[1];
	y = y.replace(")","");
	var i = Number(y);
	i--;
	$("#cap-"+n).text($("#cap-"+n).text().replace(y,i));
}

function kurangiCapStatus(){
	var x = $("#text-status").text();
	var y = x.length;
	var tmp_s = "";
	var i = y-38;
	for(var j=0, n=30;j<i;j++, n++){
		tmp_s += x[n];
	}
	var num = Number(tmp_s);
	num--;
	x = x.replace(tmp_s,num);
	$("#text-status").text(x);
}

function SaveToObj(n){
	obj.push({
		kd_penyewa : n,
		nama : document.getElementById(n).innerHTML,
		alamat : document.getElementById("alamat-"+n).innerHTML,
		tlp : document.getElementById("tlp-"+n).innerHTML,
		jenis_kelamin : document.getElementById("jk-"+n).innerHTML,
		email : document.getElementById("email-"+n).innerHTML
	});
}

function similar_kd(item,index){
	var result = item;
	for(z=index+1;z<penyewa.length;z++){
		var a = document.getElementById(penyewa[index].id).innerHTML.toUpperCase();
		var b = penyewa[z].innerHTML.toUpperCase();
		if(b.indexOf(a)>=0){
			result += "*"+penyewa[z].id;
			selected_kd += "*"+penyewa[z].id;
			SaveToObj(penyewa[z].id);
		}
	}		
	return result;
}

function red() {
	var index = 0;
	for(i=0;i<penyewa.length;i++){
		var id = penyewa[i].id;
		var ids = "*"+id;
		var element = "";
		if(!(selected_kd.indexOf(ids)>=0)){
			var x = similar_kd(id,i);
			if(x!=id){
				SaveToObj(id);
				arr_red.push(x);
				var a = x.split("*");
				element += '<div id="red-'+index+'">';
				element += '<div onclick="showDetail('+index+')" class="widget-title" style="cursor:pointer;"> <span class="icon">';
				element += '<i id="icon-'+index+'" class="icon-user"></i></span><h5 id="cap-'+index+'">'+penyewa[i].innerHTML+"("+a.length+")"+'</h5>';
				element += '</div></div>';
				$("#global-red").append(element);		
      			index++;		
			}
		}
	}
	$("#gif-status").hide();
	var status = "Tidak ditemukan duplikasi data";
	if(index>0) status = "Ditemukan duplikasi data pada "+index+" penyewa";
	$("#text-status").text(status);
}

function showDetail(n){
	$("#detail_red").remove();
	if(selectedDetail!=n){
		var temp = $("#text-status").text();
		$("#gif-status").show();
		$("#text-status").text("Memuat ...");
		selectedDetail = n;

		var st = arr_red[n];
		st = st.split("*");
		element = '<div id="detail_red" class="control-group newpadd">';
		for(c=0;c<st.length;c++){
			id = st[c];
			tmp_obj = LoadFromObj(id);
			element += '<div id="kd-'+id+'" class="note"><a onclick="ignore('+id+','+n+');" class="selected2">Abaikan</a>';
			element += '<a onclick="agree('+id+','+n+');" class="selected">Gunakan Ini</a>';
			element += tmp_obj.nama+' - '+tmp_obj.jenis_kelamin+'<br>';
			element += tmp_obj.alamat+' - '+tmp_obj.tlp;
			element += '<br>'+tmp_obj.email+'</div>';
		}
		$("#red-"+n).append(element);

		$("#gif-status").hide();
		$("#text-status").text(temp);
	} else 
		selectedDetail = -1;		
}

function agree(kd_penyewa,kd_red){
	$("#gif-status").show();
	var temp = $("#text-status").text();
	$("#text-status").text("Menyesuaikan ...");
	$("#icon-"+kd_red).attr("class","icon-refresh");
	$.post("../../../proses/penyewa.php", {kd_redudansi : arr_red[kd_red], kd_penyewa: kd_penyewa},
	function (data) {
		$("#icon-"+kd_red).attr("class","icon-ok");
		$("#gif-status").hide();
		$(".close").hide();
		$("#text-status").text("Refresh untuk melihat perubahan");
		$("#detail_red").remove();
		setTimeout(function(){ 
			$("#red-"+kd_red).remove();
		}, 500);
	});		
}

function ignore(kd_penyewa,kd_red){
	$("#kd-"+kd_penyewa).remove();
	tmp = arr_red[kd_red];
	tmp = tmp.split("*");
	if(tmp.length>2){
		kurangiCapRed(kd_red);
		new_str = "";
		for(z=0;z<tmp.length;z++){
			if(tmp[z]!=kd_penyewa){
				if(new_str==""){
					new_str = tmp[z];
				} else {
					new_str += "*"+tmp[z];
				}
			}
		}
		arr_red[kd_red] = new_str;
	} else {
		$("#red-"+kd_red).remove();
		kurangiCapStatus();
	}
}