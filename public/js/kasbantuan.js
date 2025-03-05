var app = angular.module('anKasBantuan', ['720kb.datepicker']);
app.config(function($interpolateProvider) {
        $interpolateProvider.startSymbol('[['); 
        $interpolateProvider.endSymbol(']]');
 });
app.constant("CSRF_TOKEN", window.csrf);
app.controller('kasbantuan', function($scope, $http) {
    $scope.kasBantuanComponent = [];
    $scope.saldo_kas = 0;
    $scope.saldo_kas_format;
    $scope.opt = [];


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

    for(i = 0; i < window.dataAcc.length; i++){
    	var obj = {
    		id : window.dataAcc[i].kode,
    		label : window.dataAcc[i].kode,
    		subItem : { name : window.dataAcc[i].nama_account }
    	};

    	$scope.opt.push(obj);
    }

    $scope.initJurnal = function(){
    		$scope.kasBantuanComponent = [];
    		$http({
    	        method : "POST",
    	        url : "kasbantuan/get",
    	    }).then(function mySucces(response) {
    	        if(response.data.success == 1){
    	        	var data = response.data.data;
    	        	for(i = 0; i< data.length; i++){

    	        		if(data[i].account != ""){
    	        			var account = data[i].s_account.kode;
    	        			var account_name = data[i].s_account.nama_account;
    	        			var obj_acc = {
    	        				id : account,
    	        				label : account,
    	        				subItem : { name : account_name }
    	        			};
    	        		}
    	        		else{
    	        			var account = "";
    	        			var account_name = "";
    	        			var obj_acc = {
    	        				id : "",
    	        				label : "",
    	        				subItem : {name : ""},
    	        			}
    	        		}

    	        		var obj = {
    	        			id : data[i].id,
    	        			tgl : data[i].tanggal,
    	        			acc : account,
    	        			acc_temp : obj_acc,
    	        			kantor : data[i].kantor,
    	        			kantor_name : data[i].s_kantor.nama_cabang,
    	        			account : account_name,
    	        			keterangan : data[i].keterangan,
    	        			tambahan : data[i].tambahan,
    	        			debet : data[i].debet,
    	        			kredit : data[i].kredit,
    	        		};
    	        		$scope.kasBantuanComponent.push(obj);
    	        		
    	        	}
    	        	$scope.updateJumlah();
    	        }
    	    }, function myError(response) {
    	        console.log("error : "+response);
    	    });
    }

    $scope.initJurnal();

    $scope.addKasBantuanComponent = function(){
    	var obj = {
    		id : "",
    		tgl : "",
    		acc : "",
    		acc_temp : "",
    		kantor : window.userCabang,
    		kantor_name : window.userCabangName+"",
    		account : "",
    		keterangan : "",
    		tambahan : "",
    		debet : 0,
    		kredit : 0,
    	};
    	$scope.kasBantuanComponent.push(obj);

    }

    var timer;

    $scope.chUpdate = function(index){
		// console.log("send",$scope.kasBantuanComponent);
    	 clearTimeout(timer);
    	    timer = setTimeout(function() { 
    	    		$http({
    	    	        method : "POST",
    	    	        url : "kasbantuan/exec",
    	    	        data : {index : index, data : $scope.kasBantuanComponent[index]},
    	    	    }).then(function mySucces(response) {
    	    	    	console.log("response", response);
    	    	        // $scope.myWelcome = response.data;
    	    	        if(response.data.success == 1){
    	    	        	var index 	= response.data.index;
    	    	        	var id 		= response.data.id;

    	    	        	$scope.kasBantuanComponent[index].id = id;
    	    	        	$scope.updateJumlah();

    	    	        	// console.log("success",$scope.kasBantuanComponent);
    	    	        }
    	    	    }, function myError(response) {
    	    	        // $scope.myWelcome = response.statusText;
    	    	        console.log("error : "+response);
    	    	    });
    	    }, 2000);
		
    }

    $scope.chAcc = function(index, value){
    	console.log($scope.kasBantuanComponent[index]);

    	$scope.kasBantuanComponent[index].acc = value.id;
    	$scope.kasBantuanComponent[index].account = value.subItem.name;

    	$scope.chUpdate(index);
    }

    $scope.updateView = function(){
    	var temp = [];
    	for(i=0;i<$scope.kasBantuanComponent.length;i++){
    		if($scope.kasBantuanComponent[i] != null){
    			temp.push($scope.kasBantuanComponent[i]);
    		}
    	}
    	$scope.kasBantuanComponent = temp;
    	$scope.updateJumlah();
    }

    $scope.chDelete = function(index){
    	var data = $scope.kasBantuanComponent[index];
    	if(data.id != ""){
			$http({
				method : "POST",
				url : "kasbantuan/delete",
				data : {id : data.id, index : index}
			}).then(function mySucces(response){
				if(response.data.success == 1){
					console.log(response.data.data);
					delete $scope.kasBantuanComponent[index];
					$scope.updateView();

				}
			});  		
    	}
    }

    $scope.chJumlahDebet = 0;
    $scope.chJumlahKredit = 0;

    $scope.updateJumlah = function(){
    	$scope.chJumlahDebet = 0;
    	$scope.chJumlahKredit = 0;

    	for(i=0;i<$scope.kasBantuanComponent.length; i++){
    		$scope.chJumlahDebet += parseInt($scope.kasBantuanComponent[i].debet);
    		$scope.chJumlahKredit += parseInt($scope.kasBantuanComponent[i].kredit);
    	}
    	$scope.saldo_kas = $scope.chJumlahDebet - $scope.chJumlahKredit;
    	$scope.saldo_kas_format = number_format($scope.saldo_kas);

    }

    $scope.checkKredit = function(index){
    	var data 	= $scope.kasBantuanComponent[index];
    	if(data != null){
    		var account = $scope.kasBantuanComponent[index].acc+"";
    		var first 	= account.substring(0,1);
    		if(first == "1"){
    			$scope.kasBantuanComponent[index].kredit = 0;
    			return true;
    		}
    		else{
    			return false;
    		}
    	}
    	else{
    		return true;
    	}
    }

    $scope.checkDebet = function(index){
    	var data 	= $scope.kasBantuanComponent[index];
    	if(data != null){
    		var account = $scope.kasBantuanComponent[index].acc+"";
    		var first 	= account.substring(0,1);
    		if(first == "5"){
    			$scope.kasBantuanComponent[index].debet = 0;
    			return true;
    		}
    		else{
    			return false;
    		}
    	}
    	else{
    		return true;
    	}
    }

});