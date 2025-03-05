$(document).ready(function(){
	$("table").dataTable();


	$(".btn_edit").click(function(){
		var id 	= $(this).attr("accountid");
		$.ajax({
			url : "/account/"+id,
			type : "POST",
			success:function(data){
				if(data.success == 1){
					var account = data.data;
					$("#edit_account").attr("action", "/account/"+account.id+"/edit");
					$("#edit_account [name=kode]").val(account.kode);
					$("#edit_account [name=nama]").val(account.nama_account);
					$("#modal-editaccount").modal("show");
				}
			}
		});
	});


});