$(document).ready(function(){
	// $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	//   checkboxClass: 'icheckbox_minimal-blue',
	//   radioClass: 'iradio_minimal-blue'
	// });
	$(".btn_add_permission").click(function(){
		$("#modal-add").modal("show");
	});

	function check_permission_name(name){
		$.ajax({
			url : "/admin/permission/checkname",
			type : "POST",
			data : {name : name},
			success:function(data){
				if(data.success == 1){
					if(data.data === true){
						$("button[type=submit]").attr("disabled", "disabled");
						$("[name=name]").parent().find("label").html("Permission Name (Name already exist)");
						$("[name=name]").parent().addClass("has-error");
					}
					else{
						$("[name=name]").parent().find("label").html("Permission Name");
						$("[name=name]").parent().removeClass("has-error");
						$("button[type=submit]").removeAttr("disabled");
					}
				}
			}
		});
	}


	var timer;

	$("[name=name]").keyup(function(){
		var value = $(this).val();
		clearTimeout(timer);
		timer = setTimeout(function(){
			check_permission_name(value);
		}, 500);
	});
});