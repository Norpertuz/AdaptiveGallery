$(document).ready(function()
{
	$("#pokaz_panel_b").click(function(){ 
		$('#panel').show().animate({"right":"+=300px"},200);
		$('#container').css('width', '75%');
		$("#ukryj_panel_b").fadeIn(500);
	//	$("#ukryj_panel_b").show();
		$("#pokaz_panel_b").hide();
	});
	$("#ukryj_panel_b").click(function(){ 
		$('#panel').animate({"right":"-=300px"},200);
		$('#container').css('width', '98%');
		$("#ukryj_panel_b").hide(); 
		$("#pokaz_panel_b").show();
	});	
});