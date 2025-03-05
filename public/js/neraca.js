$(document).ready(function(){
	$("[datepicker]").datepicker({ 
		format: 'yyyy-mm-dd'
	});
	$("[datepicker]").datepicker('setDate', new Date());


	var cabang;
	var tanggal;

	function init(){
		cabang 	= $("[name=pil_cabang]").val();
		tanggal = $("[datepicker").val();

		loadNeraca(cabang, tanggal);
	}

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

	function loadNeraca(cabang, tanggal){
		$.ajax({
			url : "/account/neraca/get",
			type : "POST",
			data : {cabang : cabang, tanggal : tanggal},
			success:function(data){
				if(data.success == 1){
					var data = data.data;
					var total_1 = {};
					var jml_kewajiban = 0;
					var jml_aktiva = 0;
					var jml_aktiva_lancar = 0;
					var jml_modal = 0;
					$.each(data, function(key, value){
						for(i=0;i<value.length;i++){
							if(i == 0){
								total_1[key] = 0;
							}
							if(key == "a21"){
								jml_kewajiban = jml_kewajiban + 1;
							}
							if(key == "a11" || key == "a12" || key == "a13" || key == "a14"){
								jml_aktiva = jml_aktiva + 1;
							}
							if(key == "a11" || key == "a12" || key == "a13"){
								jml_aktiva_lancar = jml_aktiva_lancar + 1;
							}
							if(key == "a31" || key == "a32" || key == "a33"){
								jml_modal = jml_modal + 1;
							}
							var nama_account = value[i].nama_account.toLowerCase();
							var nominal = value[i].nominal;

							var nama_account_array = nama_account.split(" ");
							nama_account = nama_account_array.join("_");
							// nama_account = nama_account.replace(" ","_");
							nama_account = nama_account.replace("/","-");
							nama_account = nama_account.replace('\'',"");
							// console.log(key, value[i].nama_account, value[i].nominal, nama_account);
							$("."+nama_account+"_1").html(number_format(nominal));
							total_1[key] = total_1[key] + nominal;

						}
					});
					$.each(total_1, function(key, value){
						$(".total_"+key+"_1").html(number_format(value));
					});
					var total_aktiva_lancar_1 = total_1["a11"] + total_1["a12"] + total_1["a13"];
					$(".total_aktiva_lancar_1").html(number_format(total_aktiva_lancar_1));
					var total_assets_1 = total_aktiva_lancar_1 + total_1["a14"];
					$(".total_assets_1").html(number_format(total_assets_1));

					var total_modal_1 = total_1["a31"] - total_1["a32"] + total_1["a33"];
					$(".total_modal_1").html(number_format(total_modal_1));

					var total_pasiva_1 = total_modal_1 + total_1["a21"];
					$(".total_pasiva_1").html(number_format(total_pasiva_1));
					// console.log("kewajiban : " + jml_kewajiban, "aktiva : "+ jml_aktiva);
					var rasio_utang_1 = jml_kewajiban / jml_aktiva;
					$(".rasio_utang_1").html(rasio_utang_1.toFixed(2));

					var rasio_lancar_1 = total_aktiva_lancar_1 / total_1["a21"];
					$(".rasio_lancar_1").html(rasio_lancar_1.toFixed(2));
					var modal_berjalan_1 = total_aktiva_lancar_1 - total_1["a21"];
					$(".modal_berjalan_1").html(number_format(modal_berjalan_1));

					var rasio_aset_terhadap_modal_1 = jml_aktiva / jml_modal;
					$(".rasio_aset_terhadap_modal_1").html(rasio_aset_terhadap_modal_1.toFixed(2));
					var rasio_hutang_terhadap_modal_1 = jml_kewajiban / jml_modal;
					$(".rasio_hutang_terhadap_modal_1").html(rasio_hutang_terhadap_modal_1.toFixed(2));

					$("[name=halaman]").val($(".content_container").html());
				}
			}
		});
	}

	init();
	$("[datepicker]").change(function(){
		tanggal = $(this).val();
		$("[name=stanggal]").val(tanggal);
		loadNeraca(cabang, tanggal);
	});
});