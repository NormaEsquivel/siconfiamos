$(document).ready(function(){
	
	$('.submit').click(function(){	
		if (15000<=$('#CreditoPrestamo').val()){
			window.alert('Investigar Crédito');
		}
	});
	$('#CreditoTipoCalculo').change(function(){
		
		if($(this).val() === 'insoluto'){
			
			$('#tasa-interes-input').remove();
			$('.tasa_interes').append(
				'<div id = "tasa-interes-input"><div class="input text required"><label for="CreditoTasaInteres">Tasa de Interés:</label><input name="data[Credito][tasa_interes]" type="text" value="38.4" readonly="readonly" maxlength="255" id="CreditoTasaInteres"></div></div>');
			
		}else if($(this).val() === 'capital'){
			
			$('#tasa-interes-input').remove();
			$('.tasa_interes').append('<div id = "tasa-interes-input"><div class="input select required"><label for="CreditoTasaInteres">Tasa de Interés:</label><select name="data[Credito][tasa_interes]" id="CreditoTasaInteres"><option value="36">36</option><option value="30">30</option></select></div></div>'
			);
			
		}
		
	});
	
	$('#calendario').datepicker();
	$('.calendar').datepicker();
});
