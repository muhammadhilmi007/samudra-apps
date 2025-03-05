$(document).ready(function(){
	var count = 0;
	var init = 0;
	function checkNull(data){
		if(data === null){
			return "-";
		}
		else{
			return data;
		}
	}

	function setInit(){
		init = 1;
	}

	function getInit(){
		return init;
	}

	function setCount(data){
		count = data;
	}

	function checkCount(){
		return count;
	}

	function getPenjualan(cabang){
		$.ajax({
			url : "/penjualan/list",
			type : "POST",
			data : {cabang : cabang},
			success:function(data){
				if(data.success == 1){
					if(data.count > checkCount()){
						
						var penjualan 	= data.data;
						// console.log(penjualan);

						$("tbody").html("");
						for(i = penjualan.length - 1;i >= 0;i--){
							$("tbody").append('<tr>'+
	                            '<th>'+checkNull(penjualan[i].id)+'</th>'+
	                            '<th>'+checkNull(penjualan[i].stt)+'</th>'+
	                            '<th kasal="'+i+'">'+checkNull(penjualan[i].kantor_asal)+'</th>'+
	                            '<th katuj="'+i+'">'+checkNull(penjualan[i].kantor_tujuan)+'</th>'+
	                            '<th>'+checkNull(penjualan[i].pengirim)+'</th>'+
	                            '<th>'+checkNull(penjualan[i].penerima)+'</th>'+
	                            '<th>'+checkNull(penjualan[i].created_at)+'</th>'+
	                            '<th bedit="'+i+'">'+
	                            	'<a href="/penjualan/'+penjualan[i].id+'/edit">'+
	                            		'<button type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></button>'+
	                            	'</a>'+
	                            '</th>'+
	                        '</tr>');

	                        if(penjualan[i].s_kantor_asal !== null){
	                        	$("[kasal="+i+"]").html(penjualan[i].s_kantor_asal.nama_cabang);
	                        }

	                        if(penjualan[i].s_kantor_tujuan !== null){
	                        	$("[katuj="+i+"]").html(penjualan[i].s_kantor_tujuan.nama_cabang);
	                        }

	                        if(penjualan[i].created_at != penjualan[i].updated_at){
	                        	$("[bedit="+i+"]").html("<a href='/penjualan/"+penjualan[i].id+"'>"+
	                        		"<button type='button' class='btn btn-success btn-xs'><i class='fa fa-search'></i></button>"+
	                        		"</a>");
	                        }
						}
						// console.log("get init", getInit());
						if(getInit() != 0){
							// console.log('init is not 0 and reinitialize the table');
							$("table").DataTable().fnDestroy();
						}
						$("table").DataTable().order([6, 'desc']).draw();

						setCount(data.count);
						setInit();
					}
				}
			}
		});
	}

	getPenjualan(window.cabang);

	setInterval(function(){
		getPenjualan(window.cabang);
	},10000);
});