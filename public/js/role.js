$(document).ready(function(){
	
	function check_role_name(name){
		$.ajax({
			url : "/admin/role/checkname",
			type : "POST",
			data : {name : name},
			success:function(data){
				if(data.success == 1){
					if(data.data === true){
						$("button[type=submit]").attr("disabled", "disabled");
						$("[name=name]").parent().find("label").html("Role Name (Name already exist)");
						$("[name=name]").parent().addClass("has-error");
					}
					else{
						$("[name=name]").parent().find("label").html("Role Name");
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
			check_role_name(value);
		}, 500);
	});
	$("table").dataTable();

	$("body").on("click", ".btn_edit", function(){
		var id 	= $(this).attr("roleid");
		$.ajax({
			url : "/admin/role/"+id,
			type : "POST",
			success:function(data){
				if(data.success == 1){
					var role = data.data;
					$("#edit_role").attr("action", "/admin/role/"+role.id+"/edit");
					$("#edit_role [name=name]").val(role.name);
					$("#edit_role [name=display_name]").val(role.display_name);
					$("#edit_role [name=description]").val(role.description);
					$("#modal-editrole").modal("show");
				}
			}
		});
	});

});