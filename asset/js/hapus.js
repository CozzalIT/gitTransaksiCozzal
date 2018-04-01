$('.hapus').click(function(){

	swal({
		title:'KONFIRMASI',
		text :'Apakah anda yakin manghapus data ',
		icon : 'warning',
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if(willDelete){
			window.location = this.href;
		}
	});
	return false;

})

$('.cancel').click(function(){

	swal({
		title:'KONFIRMASI',
		text :'Apakah anda yakin membatalkan transaksi?',
		icon : 'warning',
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if(willDelete){
			window.location = this.href;
		}
	});
	return false;

})
