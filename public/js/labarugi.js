$(document).ready(function(){
	var tahun = "";
	var bulan = "";
	$("[name=tahun]").change(function(){
		tahun = $(this).val();
		loadLabaRugi(tahun, bulan);
		$(".tahun_stat").html(tahun);
	});
	$("[name=bulan]").change(function(){
		bulan = $(this).val();
		loadLabaRugi(tahun, bulan);
		$(".bulan_stat").html($("option[value="+bulan+"]").html());
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

	function loadLabaRugi(tahun, bulan){
		$.ajax({
			url : "/account/labarugi/get",
			type : "POST", 
			data : {tahun : tahun, bulan : bulan},
			success:function(data){
				var a41 = data.a41;
				var a42 = data.a42;
				var a43 = data.a43;
				var a51 = data.a51;
				var a52 = data.a52;
				var a53 = data.a53;
				var a54 = data.a54;
				var a55 = data.a55;
				var a56 = data.a56;

				var tot41 = {thn : 0, bln : 0};
				for(i = 0; i<a41.length; i++){
					var item = a41[i];
					$(".nomThn_"+item.kode).val(number_format(item.nominalTahun));
					$(".nomBln_"+item.kode).val(number_format(item.nominalBulan));
					tot41.thn = tot41.thn + item.nominalTahun;
					tot41.bln = tot41.bln + item.nominalBulan;

				}
				$(".tot_nomThn_a41").html(number_format(tot41.thn));
				$(".tot_nomBln_a41").html(number_format(tot41.bln));


				var tot42 = {thn : 0, bln : 0};
				for(i = 0; i<a42.length; i++){
					var item = a42[i];
					$(".nomThn_"+item.kode).val(number_format(item.nominalTahun));
					$(".nomBln_"+item.kode).val(number_format(item.nominalBulan));
					tot42.thn = tot42.thn + item.nominalTahun;
					tot42.bln = tot42.bln + item.nominalBulan;

				}



				var tot43 = {thn : 0, bln : 0};
				for(i = 0; i<a43.length; i++){
					var item = a43[i];
					$(".nomThn_"+item.kode).val(number_format(item.nominalTahun));
					$(".nomBln_"+item.kode).val(number_format(item.nominalBulan));
					tot43.thn = tot43.thn + item.nominalTahun;
					tot43.bln = tot43.bln + item.nominalBulan;
					var oi = (item.nominalBulan / item.nominalTahun) * 100;
					$(".kdac_"+item.kode).html(oi.toFixed(2)+" %");
				}

				$(".tot_nomThn_a4243").html(number_format(tot42.thn + tot43.thn));
				$(".tot_nomBln_a4243").html(number_format(tot42.bln + tot43.bln));

				var totIncomeThn = tot41.thn + tot42.thn + tot43.thn;
				var totIncomeBln = tot41.bln + tot42.bln + tot43.bln;
				$(".totIncomeThn").html(number_format(totIncomeThn));
				$(".totIncomeBln").html(number_format(totIncomeBln));

				var oi_tot_nomThn_a41 = (tot41.thn / totIncomeThn) * 100;
				var oi_tot_nomBln_a41 = (tot41.bln / totIncomeBln) * 100;
				$(".oi_tot_nomThn_a41").html(oi_tot_nomThn_a41.toFixed(2)+" %");
				$(".oi_tot_nomBln_a41").html(oi_tot_nomBln_a41.toFixed(2)+" %");

				// set OI a41, a42 and a43

				for(i = 0; i<a41.length; i++){
					var item = a41[i];

					var oiThn = (item.nominalTahun / totIncomeThn) * 100;
					var oiBln = (item.nominalBulan / totIncomeBln) * 100;
					$(".oiThn_"+item.kode).html(oiThn.toFixed(2)+" %");
					$(".oiBln_"+item.kode).html(oiBln.toFixed(2)+" %");
				}
				for(i = 0; i<a42.length; i++){
					var item = a42[i];

					var oiThn = (item.nominalTahun / totIncomeThn) * 100;
					var oiBln = (item.nominalBulan / totIncomeBln) * 100;
					$(".oiThn_"+item.kode).html(oiThn.toFixed(2)+" %");
					$(".oiBln_"+item.kode).html(oiBln.toFixed(2)+" %");
				}
				for(i = 0; i<a43.length; i++){
					var item = a43[i];

					var oiThn = (item.nominalTahun / totIncomeThn) * 100;
					var oiBln = (item.nominalBulan / totIncomeBln) * 100;

					$(".oiThn_"+item.kode).html(oiThn.toFixed(2)+" %");
					$(".oiBln_"+item.kode).html(oiBln.toFixed(2)+" %");
				}

				var oi_tot_nomThn_a4243 = ((tot42.thn + tot43.thn) / totIncomeThn) * 100;
				var oi_tot_nomBln_a4243 = ((tot42.bln + tot43.bln) / totIncomeBln) * 100;
				$(".oi_tot_nomThn_a4243").html(oi_tot_nomThn_a4243.toFixed(2)+" %");
				$(".oi_tot_nomBln_a4243").html(oi_tot_nomBln_a4243.toFixed(2)+" %");


				var tot51 = {thn : 0, bln : 0};
				for(i = 0; i<a51.length; i++){
					var item = a51[i];
					$(".nomThn_"+item.kode).val(number_format(item.nominalTahun));
					$(".nomBln_"+item.kode).val(number_format(item.nominalBulan));
					tot51.thn = tot51.thn + item.nominalTahun;
					tot51.bln = tot51.bln + item.nominalBulan;

				}
				$(".tot_nomThn_a51").html(number_format(tot51.thn));
				$(".tot_nomBln_a51").html(number_format(tot51.bln));


				var tot52 = {thn : 0, bln : 0};
				for(i = 0; i<a52.length; i++){
					var item = a52[i];
					$(".nomThn_"+item.kode).val(number_format(item.nominalTahun));
					$(".nomBln_"+item.kode).val(number_format(item.nominalBulan));
					tot52.thn = tot52.thn + item.nominalTahun;
					tot52.bln = tot52.bln + item.nominalBulan;
				}

				var tot53 = {thn : 0, bln : 0};
				for(i = 0; i<a53.length; i++){
					var item = a53[i];
					$(".nomThn_"+item.kode).val(number_format(item.nominalTahun));
					$(".nomBln_"+item.kode).val(number_format(item.nominalBulan));
					tot53.thn = tot53.thn + item.nominalTahun;
					tot53.bln = tot53.bln + item.nominalBulan;
					var oi = (item.nominalBulan / item.nominalTahun) * 100;
					$(".kdac_"+item.kode).html(oi.toFixed(2)+" %");
				}

				$(".tot_nomThn_a5253").html(number_format(tot52.thn + tot53.thn));
				$(".tot_nomBln_a5253").html(number_format(tot52.bln + tot53.bln));

				var totLabaBrutoThn = totIncomeThn - (tot51.thn + (tot52.thn + tot53.thn));
				var totLabaBrutoBln = totIncomeBln - (tot51.bln + (tot52.bln + tot53.bln));
				$(".totLabaBrutoThn").html(number_format(totLabaBrutoThn));
				$(".totLabaBrutoBln").html(number_format(totLabaBrutoBln));

				var oiTotLabaBrutoThn = (totLabaBrutoThn / totIncomeThn) * 100;
				var oiTotLabaBrutoBln = (totLabaBrutoBln / totIncomeBln) * 100;
				$(".oi_totLabaBrutoThn").html(oiTotLabaBrutoThn.toFixed(2)+" %");
				$(".oi_totLabaBrutoBln").html(oiTotLabaBrutoBln.toFixed(2)+" %");


				// set OI a51, a52 and a53
				for(i = 0; i<a51.length; i++){
					var item = a51[i];

					var oiThn = (item.nominalTahun / totIncomeThn) * 100;
					var oiBln = (item.nominalBulan / totIncomeBln) * 100;
					$(".oiThn_"+item.kode).html(oiThn.toFixed(2)+" %");
					$(".oiBln_"+item.kode).html(oiBln.toFixed(2)+" %");
				}

				var oi_tot_nomThn_a51 = (tot51.thn / totIncomeThn) * 100;
				var oi_tot_nomBln_a51 = (tot51.bln / totIncomeBln) * 100;
				$(".oi_tot_nomThn_a51").html(oi_tot_nomThn_a51.toFixed(2)+" %");
				$(".oi_tot_nomBln_a51").html(oi_tot_nomBln_a51.toFixed(2)+" %");

				for(i = 0; i<a52.length; i++){
					var item = a52[i];

					var oiThn = (item.nominalTahun / totIncomeThn) * 100;
					var oiBln = (item.nominalBulan / totIncomeBln) * 100;
					$(".oiThn_"+item.kode).html(oiThn.toFixed(2)+" %");
					$(".oiBln_"+item.kode).html(oiBln.toFixed(2)+" %");
				}

				for(i = 0; i<a53.length; i++){
					var item = a53[i];

					var oiThn = (item.nominalTahun / totIncomeThn) * 100;
					var oiBln = (item.nominalBulan / totIncomeBln) * 100;
					$(".oiThn_"+item.kode).html(oiThn.toFixed(2)+" %");
					$(".oiBln_"+item.kode).html(oiBln.toFixed(2)+" %");
				}

				var oi_tot_nomThn_a5253 = ((tot52.thn + tot53.thn) / totIncomeThn) * 100;
				var oi_tot_nomBln_a5253 = ((tot52.bln + tot53.thn) / totIncomeBln) * 100;
				$(".oi_tot_nomThn_a5253").html(oi_tot_nomThn_a5253.toFixed(2)+" %");
				$(".oi_tot_nomBln_a5253").html(oi_tot_nomBln_a5253.toFixed(2)+" %");




				var tot54 = {thn : 0, bln : 0};
				for(i = 0; i<a54.length; i++){
					var item = a54[i];
					$(".nomThn_"+item.kode).val(number_format(item.nominalTahun));
					$(".nomBln_"+item.kode).val(number_format(item.nominalBulan));
					tot54.thn = tot54.thn + item.nominalTahun;
					tot54.bln = tot54.bln + item.nominalBulan;
					
				}

				$(".tot_nomThn_a54").html(number_format(tot54.thn));
				$(".tot_nomBln_a54").html(number_format(tot54.bln));

				var tot55 = {thn : 0, bln : 0};
				for(i = 0; i<a55.length; i++){
					var item = a55[i];
					$(".nomThn_"+item.kode).val(number_format(item.nominalTahun));
					$(".nomBln_"+item.kode).val(number_format(item.nominalBulan));
					tot55.thn = tot55.thn + item.nominalTahun;
					tot55.bln = tot55.bln + item.nominalBulan;
					var oi = (item.nominalBulan / item.nominalTahun) * 100;
					$(".kdac_"+item.kode).html(oi.toFixed(2)+" %");
				}

				$(".tot_nomThn_a55").html(number_format(tot55.thn));
				$(".tot_nomBln_a55").html(number_format(tot55.bln));

				var tot56 = {thn : 0, bln : 0};
				for(i = 0; i<a56.length; i++){
					var item = a56[i];
					$(".nomThn_"+item.kode).val(number_format(item.nominalTahun));
					$(".nomBln_"+item.kode).val(number_format(item.nominalBulan));
					tot56.thn = tot56.thn + item.nominalTahun;
					tot56.bln = tot56.bln + item.nominalBulan;
					var oi = (item.nominalBulan / item.nominalTahun) * 100;
					$(".kdac_"+item.kode).html(oi.toFixed(2)+" %");
				}

				var totExpensesThn = (tot52.thn + tot53.thn) + tot54.thn + tot55.thn + tot56.thn;
				var totExpensesBln = (tot52.bln + tot53.bln) + tot54.bln + tot55.bln + tot56.bln;
				$(".totExpensesThn").html(number_format(totExpensesThn));
				$(".totExpensesBln").html(number_format(totExpensesBln));
				$(".tot_nomThn_a56").html(number_format(tot56.thn));
				$(".tot_nomBln_a56").html(number_format(tot56.bln));

				var oiTotExpensesThn = (totExpensesThn / totIncomeThn) * 100;
				var oiTotExpensesBln = (totExpensesBln / totIncomeBln) * 100;
				$(".oi_totExpensesThn").html(oiTotExpensesThn.toFixed(2)+" %");
				$(".oi_totExpensesBln").html(oiTotExpensesBln.toFixed(2)+" %");


				// set OI a54, a55, a56

				for(i = 0; i<a54.length; i++){
					var item = a54[i];

					var oiThn = (item.nominalTahun / totIncomeThn) * 100;
					var oiBln = (item.nominalBulan / totIncomeBln) * 100;
					$(".oiThn_"+item.kode).html(oiThn.toFixed(2)+" %");
					$(".oiBln_"+item.kode).html(oiBln.toFixed(2)+" %");
				}

				for(i = 0; i<a55.length; i++){
					var item = a55[i];

					var oiThn = (item.nominalTahun / totIncomeThn) * 100;
					var oiBln = (item.nominalBulan / totIncomeBln) * 100;
					$(".oiThn_"+item.kode).html(oiThn.toFixed(2)+" %");
					$(".oiBln_"+item.kode).html(oiBln.toFixed(2)+" %");
				}
				for(i = 0; i<a56.length; i++){
					var item = a56[i];

					var oiThn = (item.nominalTahun / totIncomeThn) * 100;
					var oiBln = (item.nominalBulan / totIncomeBln) * 100;
					$(".oiThn_"+item.kode).html(oiThn.toFixed(2)+" %");
					$(".oiBln_"+item.kode).html(oiBln.toFixed(2)+" %");
				}

				var totLabaBersihThn = totIncomeThn - totExpensesThn;
				var totLabaBersihBln = totIncomeBln - totExpensesBln;
				$(".totLabaBersihThn").html(number_format(totLabaBersihThn));
				$(".totLabaBersihBln").html(number_format(totLabaBersihBln));

				var oiLabaBersihThn = (totLabaBersihThn / totIncomeThn) * 100;
				var oiLabaBersihBln = (totLabaBersihBln / totIncomeBln) * 100;
				$(".oi_labaBersihThn").html(oiLabaBersihThn.toFixed(2)+" %");
				$(".oi_labaBersihBln").html(oiLabaBersihBln.toFixed(2)+" %");
			}
		});
	}
});