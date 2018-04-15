	<style type="text/css">
		#nganu,#apartement-dropdown{
			width: 80%;
			border: 1px solid #D5D1D1;
			padding: 5px;
			background-color: #FCFCFC;
			cursor: pointer;
		}
		#nganu:hover{
			box-shadow: 2px 2px 4px #D5D1D1;
		}
		#apartement-dropdown{
			width: 60%;
			max-height: 200px;
			overflow-y: auto;
			top: 30%;
			left: 24%;
			z-index: 9999;
			position: fixed;

		}
		.content-dropdown{
		    color: black;
		    padding: 8px 6px;
		    text-decoration: none;
		    display: block;
		}
		.content-dropdown:hover{
			background-color: #D5D1D1;
			box-shadow: 2px 2px 4px #D5D1D1;
			text-decoration: none;
			color : black;
		}	
		#keyword{
			margin: 8px 6px;
			width: 90%;	
		}	
		.hide-dropdown{
			display: none;
		}
		.show-dropdown{
			display: block;
		}
	</style>
	<script type="text/javascript">
		function triger(){
			document.getElementById("apartement-dropdown").classList.toggle("show-dropdown");	
		}
		function filter() {
	  		var input, filter, ul, li, a, i;
	  		input = document.getElementById("keyword");
	  		filter = input.value.toUpperCase();
	  		a = $(".content-dropdown");
	  		for (i = 0; i < a.length; i++) {
		    	if (a[i].innerHTML.toUpperCase().indexOf(filter)>=0) {
		      	a[i].style.display = "";
			    } else {
			       a[i].style.display = "none";
			    }
		    }
		} 		
	</script>