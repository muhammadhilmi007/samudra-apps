$(document).ready(function(){

	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	  checkboxClass: 'icheckbox_minimal-blue',
	  radioClass: 'iradio_minimal-blue'
	});

	$(".select2").select2();

	function synchronize_password(pass, repass){
		if(pass != repass){
			$("button[type=submit]").attr("disabled", "disabled");
			$("[name=repassword]").parent().find("label").html("Re-Type Password (Password doesn't match)");
			$("[name=repassword]").parent().addClass("has-error");
		}
		else{
			$("[name=repassword]").parent().find("label").html("Re-Type Password");
			$("[name=repassword]").parent().removeClass("has-error");
			$("button[type=submit]").removeAttr("disabled");
		}
	}

	$("[name=password]").keyup(function(){
		var val 	= $(this).val();
		if(val == ""){
			$("[name=repassword]").val("");
			$("[name=repassword]").attr("readonly", "readonly");
			$("[name=repassword]").parent().find("label").html("Re-Type Password");
			$("[name=repassword]").parent().removeClass("has-error");
			$("button[type=submit]").attr("disabled", "disabled");
		}
		else{
			$("[name=repassword]").removeAttr("readonly");
			$("button[type=submit]").removeAttr("disabled");
		}
	});

	$("[name=repassword]").keyup(function(){
		var pass 	= $("[name=password]").val();
		var repass	= $(this).val();
		synchronize_password(pass, repass);
	});

	function check_email(email){
		$.ajax({
			url : "/admin/user/checkemail",
			type : "POST",
			data : {email : email},
			success:function(data){
				if(data.success == 1){
					if(data.data === true){
						$("button[type=submit]").attr("disabled", "disabled");
						$("[name=email]").parent().find("label").html("Email (Email already exist)");
						$("[name=email]").parent().addClass("has-error");
					}
					else{
						$("[name=email]").parent().find("label").html("Email");
						$("[name=email]").parent().removeClass("has-error");
						$("button[type=submit]").removeAttr("disabled");
					}
				}
			}
		});
	}


	var timer;

	$("[name=email]").keyup(function(){
		var value = $(this).val();
		clearTimeout(timer);
		timer = setTimeout(function(){
			check_email(value);
		}, 500);
	});
	$("table").dataTable();

	// AND FILTER
	// $.fn.dataTableExt.afnFiltering.push(
	//   function(oSettings, aData, iDataIndex) {
	//       var keywords = $(".dataTables_filter input").val().split(' ');  
	//       var matches = 0;
	//       for (var k=0; k<keywords.length; k++) {
	//           var keyword = keywords[k];
	//           for (var col=0; col<aData.length; col++) {
	//               if (aData[col].indexOf(keyword)>-1) {
	//                   matches++;
	//                   break;
	//               }
	//           }
	//       }
	//       return matches == keywords.length;
	//    }
	// );
	
	// OR FILTER

	// var input = $(".dataTables_filter input");
	// input.unbind('keyup search input').bind('keypress', function (e) {
	//     if (e.which == 13) {
	//        var keywords = input.val().split(' '), filter ='';
	//        for (var i=0; i<keywords.length; i++) {
	//            filter = (filter!=='') ? filter+'|'+keywords[i] : keywords[i];
	//        }            
	//        dataTable.fnFilter(filter, null, true, false, true, true);
	//        //                                ^ Treat as regular expression or not
	//     }
	// });

	// $.fn.dataTableExt.afnFiltering.push(
	//     function( oSettings, aData, iDataIndex ) {
	//         var iMin = document.getElementById('min').value * 1;
	//         var iMax = document.getElementById('max').value * 1;
	//         var iVersion = aData[3] == "-" ? 0 : aData[3]*1;
	//         if ( iMin == "" && iMax == "" )
	//         {
	//             return true;
	//         }
	//         else if ( iMin == "" && iVersion < iMax )
	//         {
	//             return true;
	//         }
	//         else if ( iMin < iVersion && "" == iMax )
	//         {
	//             return true;
	//         }
	//         else if ( iMin < iVersion && iVersion < iMax )
	//         {
	//             return true;
	//         }
	//         return false;
	//     }
	// );


	$("body").on('click', '.btn_edit',function(e){
		e.stopPropagation();
		var iduser 	= $(this).attr("userid");
		$(".edit_role").each(function(){ 
			$(this).iCheck("uncheck");
		});
		$.ajax({
			url : "/admin/user/"+iduser,
			type : "POST",
			success:function(data){
				if(data.success == 1){
					var user = data.data;
					$("#edit_user").attr("action", "/admin/user/"+user.id+"/edit");
					$("#edit_user").each(function(){
						this.reset();
					});
						for(i=0; i<user.roles.length; i++){
							$(".edit_role[value="+user.roles[i].id+"]").iCheck('check');
						}
					$("#edit_user [name=name]").val(user.name);
					$("#edit_user [name=email]").val(user.email);
					$("#edit_user .select2").select2("val", user.cabang);
					$("#modal-edituser").modal("show");
				}
			}
		});
	});


});