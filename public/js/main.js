$(document).ready(function(){
	$("body").on('click', '[confirm]', function(e){
		e.preventDefault();
		var href = $(this).attr("href");
		var message = $(this).attr("confirm");
		$(".modal-confirm-content").html(message);
		$(".modal-confirm-href").attr("href", href);
		$("#modal-confirm").modal("show");
	});
});