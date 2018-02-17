var id_active = 'info';

function changenav(id){
	if (id!=id_active){
		document.getElementById(id_active).className = 'non';
		document.getElementById(id).className = 'active';
		id_active = id;
	}
}
