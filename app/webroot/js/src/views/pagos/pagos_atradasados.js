$(document).ready(function(){
	$('.datepicker').glDatePicker({
		zIndex:100,
		onChange: function(target, newDate)
	    {
	        target.val
	        (
	            newDate.getDate()  + "/" +
	            (newDate.getMonth() + 1) + "/" +
	            newDate.getFullYear()
	        );
	    }
	});

	$('#sorting-example2').tablesorter({
		
	});
	
});