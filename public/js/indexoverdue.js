$(document).ready(function(){
	function number_format (number, decimals, dec_point, thousands_sep) {
		    // Strip all characters but numerical ones.
		    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		    var n = !isFinite(+number) ? 0 : +number,
		        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		        sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
		        dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
		        s = '',
		        toFixedFix = function (n, prec) {
		            var k = Math.pow(10, prec);
		            return '' + Math.round(n * k) / k;
		        };
		    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
		    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		    if (s[0].length > 3) {
		        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		    }
		    if ((s[1] || '').length < prec) {
		        s[1] = s[1] || '';
		        s[1] += new Array(prec - s[1].length + 1).join('0');
		    }
		    return s.join(dec);
		}


	function show_cash(nominal, id){
		var button = "";
		if(nominal != 0){
			button = '<a href="/overdue/'+id+'/actcash" confirm="Anda yakin akan melunaskan overdue dengan id : '+id+' ?" >'+
								  					'<button type="button" class="btn btn-xs btn-info" divisiid="#"><i class="fa fa-dollar"></i> Lunaskan </button>'+
								  				'</a> ';
		}

		return button;


	}

	var key = "";
	var hal = 1;
	var orderby = "";
	var ascdsc = "ASC";
	var limit = 10;

	function index_overdue(key, hal, orderby, ascdsc, limit){
		$.ajax({
			url : "/overdue/orgdata",
			type : "POST",
			data : {key : key, hal : hal, orderby : orderby, ascdsc : ascdsc, limit : limit},
			success:function(data){
				$("tbody").html("");
				if(data.success == 1){
					for(i=0;i<data.data.length;i++){
						var overdue = data.data[i];
						$("tbody").append('<tr>'+
								  			'<td>'+overdue.id+'</td>'+
								  			'<td>'+overdue.stt+'</td>'+
								  			'<td>'+overdue.s_cabang.nama_cabang+'</td>'+
								  			'<td>'+overdue.pelanggan+'</td>'+
								  			'<td>Rp '+number_format(overdue.nominal_awal)+'</td>'+
								  			'<td>Rp '+number_format(overdue.nominal)+'</td>'+
								  			'<td>'+
								  				'<a href="/overdue/'+overdue.id+'/delete" confirm="Apakah anda yakin akan menghapus overdue '+overdue.id+'  ?">'+
								  					'<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>'+
								  				'</a> '+
								  				'<a href="/overdue/'+overdue.id+'">'+
								  					'<button type="button" class="btn btn-xs btn-success" divisiid="#"><i class="fa fa-search"></i></button>'+
								  				'</a> '+
								  				show_cash(overdue.nominal, overdue.id)+
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


	index_overdue(key, hal, orderby, ascdsc, limit);

	var timer;

	$(".isearch").keyup(function(){
		key = $(this).val();
		hal = 1;
		clearTimeout(timer);  
	    timer = setTimeout(function() { 
	    	index_overdue(key, hal, orderby, ascdsc, limit);
	    }, 2000);
	});

	$(".ilimit").change(function(){
		limit = $(this).val();
		hal = 1;
		index_overdue(key, hal, orderby, ascdsc, limit);
	});
	$(".iorder").change(function(){
		ascdsc = $("iascdsc").val();
		orderby = $(this).val();
		hal = 1;
		index_overdue(key, hal, orderby, ascdsc, limit);
	});

	$(".iascdsc").change(function(){
		ascdsc = $(this).val();
		hal = 1;
		if($(".iorder").val() != ""){
			index_overdue(key, hal, orderby, ascdsc, limit);
		}
	});

	$("body").on('click', '[pagin]', function(e){
			e.preventDefault();
			hal = $(this).attr("pagin");
			index_overdue(key, hal, orderby, ascdsc, limit);
	});

	$(".open_invoice").click(function(){
		$("#modal-openinvoice").modal("show");
		setTimeout(function(){
			$(".select2").select2();
			$(".timerange").daterangepicker();
		}, 1000);
	});

	$(".print_invoice").click(function(){
		var pengirim = $("[name=pengirim]").val();
		var range 	= $("[name=range]").val();

		var splitrange 	= range.split(" - ");
		var new_range 	= [];
		for(i=0;i<splitrange.length;i++){
			var temp  = "";
			var sp  	= splitrange[i].split("/");

			sp = sp[2]+"-"+sp[0]+"-"+sp[1];

			new_range[i] = sp;
		}

		new_range = new_range.join("_");
		if(pengirim != "" && range != ""){
			window.location.href = window.location.href+"/invoice/"+pengirim+"/"+new_range;
		}
	});
});