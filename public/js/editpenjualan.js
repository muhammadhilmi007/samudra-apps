$(document).ready(function(){

	//transit component

	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	  checkboxClass: 'icheckbox_minimal-blue',
	  radioClass: 'iradio_minimal-blue'
	});
	var transit_count = 1;
	setTimeout(function(){
		$(".transit_container").hide(0);
	},1000);

	$("[name=cb_transit]").on('ifChecked', function(event){
	   	$(".transit_container").show(0);
	});
	$("[name=cb_transit]").on('ifUnchecked', function(event){
		$(".transit_container").hide(0);
	});

	function update_btn_transbut(){
		var count = 1;
		$("[transbut]").each(function(){
			if(count != 1){
				$(this).attr("transbut", count);
				$(this).html("");
				$(this).parent().find(".labtrans").html("Transit ke "+count);	
				$(".select2").select2();
			}
			count++;
		});
	}

	function appendallcabang(value){
		var html = "";
		for(i=0;i<value.length;i++){
			html += '<option value="'+value[i].id+'">'+value[i].nama_cabang+'</option>';                            
		}

		return html;
	}

	$(".btn_transit_plus").click(function(){
		var transit_html = '<div class="unit_transit">'+
                            '<div class="row">'+
                                '<label class="labtrans">Transit ke 1</label>'+
                                '<div class="col-xs-10">'+
                                    '<select name="transit[]" class="form-control select2" required>'+
                                        '<option value=""></option>'+
                                        appendallcabang(allcabang)+
                                    '</select>'+
                                '</div>'+
                                '<div class="col-xs-2" transbut="1">'+
                                    '<button type="button" class="btn btn-xs btn-info btn_transit_plus"><i class="fa fa-plus"></i></button>'+
                                    '<button type="button" class="btn btn-xs btn-danger btn_transit_minus"><i class="fa fa-minus"></i></button>'+
                                '</div>'+
                            '</div>'+
                        '</div>';

		$(".transit_container").append(transit_html);

		update_btn_transbut();
		// $("[transbut="+btn_transbut+"]").html("<button type='button' class='btn btn-xs btn-danger'><i class='fa fa-minus'></i></button>")


	});
	
	function delete_last_transbut(){
		var index = 0;
		$(".unit_transit").last().remove();
		
	}

	$(".btn_transit_minus").click(function(){
		delete_last_transbut();
	});

	//penjualan component

	$(".select2").select2();
	$("[name=penerus]").keyup(function(){
		var thisval 	= $(this).val();
		// console.log(thisval);
		if(thisval != ""){
			$("[name=kode_penerus] option[value=70]").hide(0);
			$("[name=kode_penerus]").removeAttr("disabled");
			$("[name=kode_penerus]").removeAttr("required");
			$("[name=kode_penerus]").val("74");
		}
		else{
			$("[name=kode_penerus] option[value=70]").show(0);
			$("[name=kode_penerus]").val("70");
			$("[name=kode_penerus]").attr("disabled", "disabled");
			$("[name=kode_penerus]").attr("required", "required");
		}
	});

	var pengirim = [];
	var penerima = [];
	var alamat = [];
	var penerus = [];
	var nama_barang = [];

	for(i=0;i<window.penjualan.length;i++){
		if(window.penjualan[i].pengirim !== null){
			pengirim.push(window.penjualan[i].pengirim);
		}

		// if(window.penjualan[i].penerima !== null){
		// 	penerima.push(window.penjualan[i].penerima);
		// }

		// if(window.penjualan[i].alamat_penerima !== null){
		// 	alamat.push(window.penjualan[i].alamat_penerima);
		// }

		// if(window.penjualan[i].penerus !== null && window.penjualan[i].penerus != ""){
		// 	penerus.push(window.penjualan[i].penerus);
		// }

		// if(window.penjualan[i].nama_barang !== null){
		// 	nama_barang.push(window.penjualan[i].nama_barang);
		// }
	}

	// console.log("pengirim", pengirim);
	// console.log("penjualan", penjualan);
	// console.log("alamat", alamat);
	// console.log("penerus", penerus);
	// console.log("nama_barang", nama_barang);

	$("[name=pengirim]").autocomplete({
		source : pengirim,
		minLength : 0
	}).bind('focus', function(){ $(this).autocomplete("search"); } );

	function filterpengirim(value){
		$.ajax({
			url : "/penjualan/orgdata/filter/pengirim",
			type : "POST",
			data : {val : value},
			success:function(data){
				if(data.success == 1){
					beforeAutoComplete("penerima", data.data);
				}
			}
		});
	}

	function filterpenerima(pengirim, value){
		$.ajax({
			url : "/penjualan/orgdata/filter/penerima",
			type : "POST",
			data : {val : value, pengirim : pengirim},
			success:function(data){
				if(data.success == 1){
					beforeAutoCompletePenerima("alamat", data.data);
				}
			}
		});
	}

	function filteralamat(pengirim, penerima, value){
		$.ajax({
			url : "/penjualan/orgdata/filter/alamat",
			type : "POST",
			data : {val : value, pengirim : pengirim, penerima : penerima},
			success:function(data){
				if(data.success == 1){
					beforeAutoCompleteAlamat("penerus", data.data);
				}
			}
		});
	}

	function beforeAutoComplete(name, data){
		var dataTemp = [];
		for(i=0;i<data.length;i++){
			dataTemp.push(data[i].penerima);
		}

		beAutoComplete(name, dataTemp);
	}

	function beforeAutoCompletePenerima(name, data){
		var dataTemp = [];
		for(i=0;i<data.length;i++){
			dataTemp.push(data[i].alamat_penerima);
		}

		beAutoComplete(name, dataTemp);
	}

	function beforeAutoCompleteAlamat(name, data){
		var dataTemp = [];
		var nm_barangTemp = [];
		for(i=0;i<data.length;i++){
			dataTemp.push(data[i].penerus);
			nm_barangTemp.push(data[i].nama_barang);
		}

		beAutoComplete(name, dataTemp);
		beAutoComplete("nm_barang", nm_barangTemp);
	}


	function beAutoComplete(name, data){
		console.log("beAutoComplete", "name : "+name, "data : "+data);
		$("[name="+name+"]").autocomplete({
			source : data,
			minLength : 0
		}).bind('focus', function(){ $(this).autocomplete("search"); } );
	}


	$("[name=pengirim]").keyup(function(){
		var val 	= $(this).val();
		filterpengirim(val);
	});

	$("[name=pengirim]").change(function(){
		var val 	= $(this).val();
		filterpengirim(val);
	});

	$("[name=penerima]").change(function(){
		filterpenerima($("[name=pengirim]").val(), $(this).val());
	});
	$("[name=penerima]").keyup(function(){
		filterpenerima($("[name=pengirim]").val(), $(this).val());
	});

	$("[name=alamat]").change(function(){
		filteralamat($("[name=pengirim]").val(), $("[name=penerima]").val(), $(this).val());
	});

	$("[name=alamat]").keyup(function(){
		filteralamat($("[name=pengirim]").val(), $("[name=penerima]").val(), $(this).val());
	});

	$("[name=alamat]").autocomplete({
		source : alamat,
		minLength : 0
	}).bind('focus', function(){ $(this).autocomplete("search"); } );


	$("[name=penerus]").autocomplete({
		source : penerus,
		minLength : 0
	}).bind('focus', function(){ $(this).autocomplete("search"); } );


	$("[name=nama_barang]").autocomplete({
		source : nama_barang,
		minLength : 0
	}).bind('focus', function(){ $(this).autocomplete("search"); } );


	// $("[name=berat]").val(0);
	// $("[name=jml_colly]").val(0);


	var harga = 0;
	var jenis_harga="berat";
	var vmet = {
		v_panjang : 0,
		v_lebar : 0,
		v_tinggi : 0
	};
	$(".vmet").hide(0);

	$("[name=harga]").keyup(function(e){
		// Allow: backspace, delete, tab, escape, enter and .
        // if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        //      // Allow: Ctrl+A, Command+A
        //     (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
        //      // Allow: home, end, left, right, down, up
        //     (e.keyCode >= 35 && e.keyCode <= 40)) {
        //          // let it happen, don't do anything

        //          return;
        // }
        // // Ensure that it is a number and stop the keypress
        // if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        //     e.preventDefault();
        // }

        harga = $(this).val();
        jumlah_harga(harga, jenis_harga, vmet);
	});

	$("[name=v_panjang]").keyup(function(){
		vmet.v_panjang = $(this).val();
		jumlah_harga(harga, jenis_harga, vmet);
	});

	$("[name=v_lebar]").keyup(function(){
		vmet.v_lebar = $(this).val();
		jumlah_harga(harga, jenis_harga, vmet);
	});

	$("[name=v_tinggi]").keyup(function(){
		vmet.v_tinggi = $(this).val();
		jumlah_harga(harga, jenis_harga, vmet);
	});

	$("[name=jenis_harga]").change(function(){
		jenis_harga = $(this).val();

		if($(this).val() == "volume_metric"){
			$(".vmet").show(0);
		}
		else{
			$(".vmet").hide(0);
		}

		jumlah_harga(harga, jenis_harga, vmet);
	});

	$("[name=berat]").keyup(function(){
		jumlah_harga(harga, jenis_harga, vmet);
	});

	$("[name=jml_colly]").keyup(function(){
		jumlah_harga(harga, jenis_harga, vmet);
	});

	function jumlah_harga(harga, jenis_harga, vmet){
		var harga 	= harga;
		var jenis   = jenis_harga;
		var value   = 0;
		console.log(vmet);
		switch(jenis){
			case "berat":
				value = $("[name=berat]").val();
			break;
			case "colly":
				value = $("[name=jml_colly]").val();
			break;
			case "volume_metric":
				value = ""+parseInt(vmet.v_panjang) * parseInt(vmet.v_lebar) * parseInt(vmet.v_tinggi);
			break;
		}
		var jumlah_harga 	= parseInt(harga) * parseInt(value);
		$("[name=jumlah_harga]").val(jumlah_harga);
	}
	jumlah_harga(harga, jenis_harga, vmet);


});