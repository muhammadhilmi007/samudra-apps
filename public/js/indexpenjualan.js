$(document).ready(function(){

	function checkNull(data){
		if(data === null){
			return "-";
		}
		else{
			return data;
		}
	}


	var cabang 	= window.cabang;

	var key = "";
	var hal = 1;
	var orderby = "";
	var ascdsc = "ASC";
	var limit = 10;

	function index_penjualan(key, hal, orderby, ascdsc, limit, cabang){
		$.ajax({
			url : "/penjualan/orgdata",
			type : "POST",
			data : {key : key, hal : hal, orderby : orderby, ascdsc : ascdsc, limit : limit, cabang : cabang},
			success:function(data){
				$("tbody").html("");
				if(data.success == 1){
					var penjualan 	= data.data;
					for(i = 0;i < penjualan.length;i++){
						$("tbody").append('<tr>'+
                            '<td>'+checkNull(penjualan[i].id)+'</td>'+
                            '<td>'+checkNull(penjualan[i].stt)+'</td>'+
                            '<td kasal="'+i+'">'+checkNull(penjualan[i].kantor_asal)+'</td>'+
                            '<td katuj="'+i+'">'+checkNull(penjualan[i].kantor_tujuan)+'</td>'+
                            '<td>'+checkNull(penjualan[i].pengirim)+'</td>'+
                            '<td>'+checkNull(penjualan[i].penerima)+'</td>'+
                            '<td>'+checkNull(penjualan[i].created_at)+'</td>'+
                            '<td bedit="'+i+'">'+
                            	'<a href="/penjualan/'+penjualan[i].id+'/edit">'+
                            		'<button type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></button>'+
                            	'</a>'+
                            '</td>'+
                        '</tr>');

                        if(penjualan[i].s_kantor_asal !== null){
                        	$("[kasal="+i+"]").html(penjualan[i].s_kantor_asal.nama_cabang);
                        }

                        if(penjualan[i].s_kantor_tujuan !== null){
                        	$("[katuj="+i+"]").html(penjualan[i].s_kantor_tujuan.nama_cabang);
                        }

                        if(penjualan[i].user !== null){
                        	$("[bedit="+i+"]").html("<a href='/penjualan/"+penjualan[i].id+"'>"+
                        		"<button type='button' class='btn btn-success btn-xs'><i class='fa fa-search'></i></button>"+
                        		"</a>");
                        }
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


	index_penjualan(key, hal, orderby, ascdsc, limit, cabang);

	var timer;

	$(".isearch").keyup(function(){
		key = $(this).val();
		hal = 1;
		clearTimeout(timer);  
	    timer = setTimeout(function() { 
	    	index_penjualan(key, hal, orderby, ascdsc, limit, cabang);
	    }, 2000);
	});

	$(".ilimit").change(function(){
		limit = $(this).val();
		hal = 1;
		index_penjualan(key, hal, orderby, ascdsc, limit, cabang);
	});
	$(".iorder").change(function(){
		ascdsc = $("iascdsc").val();
		orderby = $(this).val();
		hal = 1;
		index_penjualan(key, hal, orderby, ascdsc, limit, cabang);
	});

	$(".iascdsc").change(function(){
		ascdsc = $(this).val();
		hal = 1;
		if($(".iorder").val() != ""){
			index_penjualan(key, hal, orderby, ascdsc, limit, cabang);
		}
	});

	$("body").on('click', '[pagin]', function(e){
			e.preventDefault();
			hal = $(this).attr("pagin");
			index_penjualan(key, hal, orderby, ascdsc, limit, cabang);
	});
});