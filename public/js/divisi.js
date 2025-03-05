$(document).ready(function(){
	$("table").dataTable();


	$(".btn_edit").click(function(){
		var id 	= $(this).attr("divisiid");
		$.ajax({
			url : "/divisi/"+id,
			type : "POST",
			success:function(data){
				if(data.success == 1){
					var divisi = data.data;
					$("#edit_divisi").attr("action", "/divisi/"+divisi.id+"/edit");
					$("#edit_divisi [name=name]").val(divisi.nama_divisi);
					$("#modal-editdivisi").modal("show");
				}
			}
		});
	});


});