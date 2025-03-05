$(document).ready(function(){
	$(".select2").select2();

	$("body").on("click", ".btn_edit", function(e){
		e.preventDefault();
		var id 	= $(this).attr("cabangid");
		$.ajax({
			url : "/cabang/"+id,
			type : "POST",
			success:function(data){
				if(data.success == 1){
					var cabang 	= data.data;
					$("#edit_cabang").attr("action", "/cabang/"+cabang.id+"/edit");
					$("#edit_cabang [name=name]").val(cabang.nama_cabang);
					$("#edit_cabang [name=kode]").val(cabang.kode_cabang);
					$("#edit_cabang [name=latitude2]").val(cabang.lat_coord);
					$("#edit_cabang [name=longitude2]").val(cabang.long_coord);
					$("#edit_cabang .select2").select2("val", cabang.divisi);
					if(cabang.pusat != 0){
						$("#edit_cabang [name=pusat]").prop("checked", true);
					}
					$("#modal-editcabang").modal("show");
					setTimeout(function(){
						loadmap2(cabang.lat_coord,cabang.long_coord);}
					, 1000);
				}
			}
		});
	});


	function loadmap2(lat,long){
	  var customMapType = new google.maps.StyledMapType([{"stylers":[{"saturation":-100},{"gamma":1}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":50},{"gamma":0},{"hue":"#50a5d1"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#333333"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"weight":0.5},{"color":"#333333"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"gamma":1},{"saturation":50}]}], {
	    name: 'Custom Style2'
	  });
	  var customMapTypeId = 'custom_style2';
	  var myLatLng = {lat: -7.30815, lng: 108.203294};

	  var map = new google.maps.Map(document.getElementById('klinikonmap2'), {
	  zoom: 15,
	  // center: myLatLng
	  });

	  map.mapTypes.set(customMapTypeId, customMapType);
	  map.setMapTypeId(customMapTypeId);
	        node_lat = lat;
	        node_long = long;
	        var marker = new google.maps.Marker({
	             position: new google.maps.LatLng(node_lat, node_long),
	             map: map,
	             title: 'Klik dan tahan lalu geser untuk mendapatkan titik kordinat',
	             draggable: true
	         });
	        setTimeout(function(){
	        	marker;
	          // new google.maps.Marker({
	          //           position: new google.maps.LatLng(node_lat, node_long),
	          //           map: map,
	          //           draggable : true,
	          //           // icon: new google.maps.MarkerImage( src, new google.maps.Size(100, 106), new google.maps.Point(0, 0), new google.maps.Point(50, 50) ),
	          //           title: "{{$klinik[0]->nama}}"
	          //       });
	                map.setCenter(new google.maps.LatLng(node_lat, node_long));
	        	 google.maps.event.addListener(marker, 'dragend', function(a) {
	             var latitude = marker.position.lat();
	             var longitude = marker.position.lng();
	             $("[name='latitude2']").val(latitude);
	             $("[name='longitude2']").val(longitude);
	             // console.log(latitude, longitude);
	             // bingo!
	             // a.latLng contains the co-ordinates where the marker was dropped
	         });
	        }, 1000);

	}

	// google api key
	// AIzaSyDtOpFXzomqDi7ajn6dIkP5l6x8O3BuDHI

	function loadmap(){
	  var customMapType = new google.maps.StyledMapType([{"stylers":[{"saturation":-100},{"gamma":1}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":50},{"gamma":0},{"hue":"#50a5d1"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#333333"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"weight":0.5},{"color":"#333333"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"gamma":1},{"saturation":50}]}], {
	    name: 'Custom Style'
	  });
	  var customMapTypeId = 'custom_style';
	  var myLatLng = {lat: -7.30815, lng: 108.203294};

	  var map = new google.maps.Map(document.getElementById('klinikonmap'), {
	  zoom: 6,
	  // center: myLatLng
	  });

	  map.mapTypes.set(customMapTypeId, customMapType);
	  map.setMapTypeId(customMapTypeId);
	        node_lat = "-6.870978788759881";
	        node_long = "107.57213680043697";
	        var marker = new google.maps.Marker({
	             position: new google.maps.LatLng(node_lat, node_long),
	             map: map,
	             title: 'Klik dan tahan lalu geser untuk mendapatkan titik kordinat',
	             draggable: true
	         });
	        setTimeout(function(){
	        	marker;
	          // new google.maps.Marker({
	          //           position: new google.maps.LatLng(node_lat, node_long),
	          //           map: map,
	          //           draggable : true,
	          //           // icon: new google.maps.MarkerImage( src, new google.maps.Size(100, 106), new google.maps.Point(0, 0), new google.maps.Point(50, 50) ),
	          //           title: "{{$klinik[0]->nama}}"
	          //       });
	                map.setCenter(new google.maps.LatLng(node_lat, node_long));
	        	 google.maps.event.addListener(marker, 'dragend', function(a) {
	             var latitude = marker.position.lat();
	             var longitude = marker.position.lng();
	             $("[name='latitude']").val(latitude);
	             $("[name='longitude']").val(longitude);
	             // console.log(latitude, longitude);
	             // bingo!
	             // a.latLng contains the co-ordinates where the marker was dropped
	         });
	        }, 1000);

	}
	setTimeout(function(){
		loadmap();
	},1000);
});