$(document).ready(function(){
	$(".datetimepicker").datetimepicker({
   		format:'YYYY-MM-DD HH:mm:ss' 
	});
	$(".select2").select2();

	function checknull(data){
		if(data === null){
			return "-";
		}
		else{
			return data;
		}
	}

	var key = "";
	var hal = 1;
	var orderby = "";
	var ascdsc = "ASC";
	var limit = 10;

	function index_lansir(key, hal, orderby, ascdsc, limit){
		$.ajax({
			url : "/lansir/orgdata",
			type : "POST",
			data : {key : key, hal : hal, orderby : orderby, ascdsc : ascdsc, limit : limit},
			success:function(data){
				$("tbody").html("");
				if(data.success == 1){
					for(i=0;i<data.data.length;i++){
						var lansir = data.data[i];
						$("tbody").append('<tr>'+
								  			'<td>'+lansir.id+'</td>'+
								  			'<td>'+lansir.kode_lansir+'</td>'+
								  			'<td>'+lansir.antrian_kendaraan+'</td>'+
								  			'<td>'+lansir.berangkat+'</td>'+
								  			'<td>'+checknull(lansir.sampai)+'</td>'+
								  			'<td>'+
								  				'<a href="/lansir/'+lansir.id+'/delete" confirm="Apakah anda yakin akan menghapus lansir '+lansir.id+'  ?">'+
								  					'<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>'+
								  				'</a>'+
								  				'<a href="/lansir/'+lansir.id+'">'+
								  					'<button type="button" class="btn btn-xs btn-info btn_edit" divisiid="#"><i class="fa fa-search"></i></button>'+
								  				'</a>'+
								  			'</td>'+
								  		'</tr>')
					}
					var count = data.count;
					var page  = count / limit;


					if(page % 1 != 0){
						var ex = page.toString().split(".");
						page = parseInt(ex[0]) + 1;
					}
						var left_limit = 0;
						var right_limit = page;

						var left_interval = execDesired(hal,3,"left", page);
						var right_interval = execDesired(hal,3,"right", page);

						$(".app_pagin").html("");
						
						// console.log("left : "+left_interval, "right : "+right_interval);

						var forhal = hal - 1;

						for(a=left_interval; a>0; a--){
							var reshal = hal - a;
							$(".app_pagin").append('<li><a href="#" pagin="'+reshal+'">'+reshal+'</a></li>');
						}

						$(".app_pagin").append('<li><a href="#" pagin="'+hal+'">'+hal+'</a></li>');

						for(a=0; a<right_interval; a++){
							var reshal = parseInt(hal) + parseInt(a) + 1;
							// console.log("right", "hal : "+hal, "reshal : "+reshal);
							if(!(reshal > right_limit)){
								$(".app_pagin").append('<li><a href="#" pagin="'+reshal+'">'+reshal+'</a></li>');
							}
						}

						if(hal != 1){
							var reshal = hal - 1;
							$(".app_pagin").prepend('<li><a href="#" pagin="'+reshal+'">«</a></li>');
						}
						if(hal != page){
							var reshal = hal + 1;
							$(".app_pagin").append('<li><a href="#" pagin="'+reshal+'">»</a></li>');
						}

						$("[pagin="+hal+"]").css({"background" : "#ECF0F5"});
				}
			}
		});
	}

	function execDesired(hal, desired, position, pagecount){
		var result = 0;
		var hal = hal - 1;
		switch(position){
			case "left" :
				for(a=hal; a>0; a--){
					if(result < desired){
						result++;
					}
				}
			break;
			case "right":
				for(a=hal; a<=pagecount;a++){
					if(result < desired){
						result++;
					}
				}
			break;
		}
			// console.log(position, result);
			// console.log("hal", hal);

		return result;
	}


	index_lansir(key, hal, orderby, ascdsc, limit);

	var timer;

	$(".isearch").keyup(function(){
		key = $(this).val();
		hal = 1;
		clearTimeout(timer);  
	    timer = setTimeout(function() { 
	    	index_lansir(key, hal, orderby, ascdsc, limit);
	    }, 2000);
	});

	$(".ilimit").change(function(){
		limit = $(this).val();
		hal = 1;
		index_lansir(key, hal, orderby, ascdsc, limit);
	});
	$(".iorder").change(function(){
		ascdsc = $("iascdsc").val();
		orderby = $(this).val();
		hal = 1;
		index_lansir(key, hal, orderby, ascdsc, limit);
	});

	$(".iascdsc").change(function(){
		ascdsc = $(this).val();
		hal = 1;
		if($(".iorder").val() != ""){
			index_lansir(key, hal, orderby, ascdsc, limit);
		}
	});

	$("body").on('click', '[pagin]', function(e){
			e.preventDefault();
			hal = $(this).attr("pagin");
			index_lansir(key, hal, orderby, ascdsc, limit);
	});
});