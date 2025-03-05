$(document).ready(function(){
	$(".select2").select2();
	$(".datetimepicker").datetimepicker({
   		format:'YYYY-MM-DD HH:mm:ss' 
	});

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

	$("[name=payment_type]").attr("disabled", "disabled");
	$(".stt_form").change(function(){
		var val 	= $(this).val();
		var stt = val[val.length - 1];
		if(stt != ""){
			$.ajax({
				url : "/penjualan/getbystt",
				type : "POST",
				data : {stt : stt},
				success:function(data){
					if(data.success == 1){
						var penjualan = data.data;
						$("#s_id").html(penjualan.id);
						$("#s_stt").html(penjualan.stt);
						$("#s_kantor_asal").html(penjualan.s_kantor_asal.nama_cabang);
						$("#s_kantor_tujuan").html(penjualan.s_kantor_tujuan.nama_cabang);
						$("#s_pengirim").html(penjualan.pengirim);
						$("#s_penerima").html(penjualan.penerima);
						$("#s_alamat_penerima").html(penjualan.alamat_penerima);
						$("#s_ket_tambahan").html(penjualan.ket_tambahan);
						$("#s_kontak_penerima").html(penjualan.kontak_penerima);
						$("#s_penerus").html(penjualan.penerus);
						$("#s_kode_penerus").html(penjualan.kode_penerus);
						$("#s_nama_barang").html(penjualan.nama_barang);
						$("#s_payment_type").html(penjualan.payment_type);
						$("#s_jumlah_colly").html(penjualan.jumlah_colly);
						$("#s_packing").html(penjualan.packing);
						$("#s_berat").html(penjualan.berat);
						$("#s_harga_per_kilo").html("Rp "+number_format(penjualan.harga_per_kilo));
						$("#s_harga_total").html("Rp "+number_format(penjualan.harga_total));
						if(penjualan.payment_type == "CASH"){
							$("[name=payment_type]").attr("disabled", "disabled");
						}
						else{
							$("[name=payment_type]").removeAttr("disabled");
						}
						$("[name=payment_type]").val(penjualan.payment_type);
					}
				}
			});
		}
		else{
			$("#s_id").html("");
			$("#s_stt").html("");
			$("#s_kantor_asal").html("");
			$("#s_kantor_tujuan").html("");
			$("#s_pengirim").html("");
			$("#s_penerima").html("");
			$("#s_alamat_penerima").html("");
			$("#s_ket_tambahan").html("");
			$("#s_kontak_penerima").html("");
			$("#s_penerus").html("");
			$("#s_kode_penerus").html("");
			$("#s_nama_barang").html("");
			$("#s_payment_type").html("");
			$("#s_jumlah_colly").html("");
			$("#s_packing").html("");
			$("#s_berat").html("");
			$("#s_harga_per_kilo").html("");
			$("#s_harga_total").html("");
		}
	});
	$("[name=stt]").change(function(){
		var val 	= $(this).val();
		var stt = val[val.length - 1];
		if(stt != ""){
			$.ajax({
				url : "/penjualan/getbystt",
				type : "POST",
				data : {stt : stt},
				success:function(data){
					if(data.success == 1){
						var penjualan = data.data;
						$("#s_id").html(penjualan.id);
						$("#s_stt").html(penjualan.stt);
						$("#s_kantor_asal").html(penjualan.s_kantor_asal.nama_cabang);
						$("#s_kantor_tujuan").html(penjualan.s_kantor_tujuan.nama_cabang);
						$("#s_pengirim").html(penjualan.pengirim);
						$("#s_penerima").html(penjualan.penerima);
						$("#s_alamat_penerima").html(penjualan.alamat_penerima);
						$("#s_ket_tambahan").html(penjualan.ket_tambahan);
						$("#s_kontak_penerima").html(penjualan.kontak_penerima);
						$("#s_penerus").html(penjualan.penerus);
						$("#s_kode_penerus").html(penjualan.kode_penerus);
						$("#s_nama_barang").html(penjualan.nama_barang);
						$("#s_payment_type").html(penjualan.payment_type);
						$("#s_jumlah_colly").html(penjualan.jumlah_colly);
						$("#s_packing").html(penjualan.packing);
						$("#s_berat").html(penjualan.berat);
						$("#s_harga_per_kilo").html(penjualan.harga_per_kilo);
						$("#s_harga_total").html(penjualan.harga_total);
						if(penjualan.payment_type == "CASH"){
							$("[name=payment_type]").attr("disabled", "disabled");
						}
						else{
							$("[name=payment_type]").removeAttr("disabled");
						}
						$("[name=payment_type]").val(penjualan.payment_type);
					}
				}
			});
		}
		else{
			$("#s_id").html("");
			$("#s_stt").html("");
			$("#s_kantor_asal").html("");
			$("#s_kantor_tujuan").html("");
			$("#s_pengirim").html("");
			$("#s_penerima").html("");
			$("#s_alamat_penerima").html("");
			$("#s_ket_tambahan").html("");
			$("#s_kontak_penerima").html("");
			$("#s_penerus").html("");
			$("#s_kode_penerus").html("");
			$("#s_nama_barang").html("");
			$("#s_payment_type").html("");
			$("#s_jumlah_colly").html("");
			$("#s_packing").html("");
			$("#s_berat").html("");
			$("#s_harga_per_kilo").html("");
			$("#s_harga_total").html("");
		}
	});	
});