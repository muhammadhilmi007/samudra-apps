$(document).ready(function(){
	$(".timepicker").datetimepicker({
		format : "HH:mm"
	});

	$("table").DataTable().order([0, "desc"]).draw();

	$("[datepicker]").datepicker({ format: 'yyyy-mm-dd'});

	$(".select2").select2();
});