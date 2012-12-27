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

	$('#new-credit-form').validationEngine();

	$('#submit-button').hide();

	$('#CreditoTipoCalculo').change(function(){
		
		if($(this).val() === 'insoluto'){
			
			$('#tasa-interes-input').remove();
			$('#second-column').after(
				'<p class = "inline-label button-height" id = "tasa-interes-input"><label for="CreditoTasaInteres" class ="label">Tasa de Interés:</label><input class = "input small-margin-right" name="data[Credito][tasa_interes]" type="text" value="38.4" class = "" readonly="readonly" maxlength="255" id="CreditoTasaInteres"></p>');
			$('#submit-button').show();


		}else if($(this).val() === 'capital'){
			
			$('#tasa-interes-input').remove();
			$('#second-column').after('<p class = "inline-label button-height" id = "tasa-interes-input"><label for="CreditoTasaInteres" class = "label">Tasa de Interés:</label><select class = "select" name="data[Credito][tasa_interes]" id="CreditoTasaInteres"><option value="36">36</option><option value="30">30</option></select></div></div>'
			);
			$('#submit-button').show();

		}else{
			$('#tasa-interes-input').remove();
			$('#submit-button').hide();

		}
		
	});

});