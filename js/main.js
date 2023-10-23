var Payment = function(){
	/*Formulario de pagos con tarjeta de credito*/
	$formCreditcard = $("#creditcard-form");
	$formPSE = $("#pse-form");
	$formCash = $("#cash-form");
	$formBanks = $("#banks-form");
	$alertCreditcard = $("#alert-creditcard");
	$alertPSE = $("#alert-pse");
	$alertCash = $("#alert-cash");
	$alertBanks = $("#alert-banks");

	// Obtener la dirección IP
	var userIP;
	$.getJSON("https://api.ipify.org?format=json", function(data){
		userIP = data.ip;
	});

	var makePayment = {};
	makePayment.creditcard=function(){
		$alertCreditcard.html("procesando...");		;
		$.ajax({
			url: 'index.php/creditcard-payment',
			type: 'POST',
			data: $formCreditcard.serialize()  + '&ip=' + userIP,
			dataType: 'json',
			success: function(res) {
				if(res.status == "ok"){
					$alertCreditcard.html("procesando correctamente: " + res.message) ;					
				}else{
					$alertCreditcard.html("error ... " + res.message);
				}
			},
			error:function(res,a){
				$alertCreditcard.html("error ... ");
			}
		});
	};
	makePayment.pse=function(){
		$alertPSE.html("procesando...");		;
		$.ajax({
			url: 'index.php/pse-payment',
			type: 'POST',
			data: $formPSE.serialize()  + '&ip=' + userIP,
			dataType: 'json',
			success: function(res) {
				if(res.status == "ok"){
					$alertPSE.html("procesando correctamente: " + res.message) ;
					// Abre una nueva pestaña con la URL proporcionada
					window.open(res.url, '_blank');
				}else{
					$alertPSE.html("error ... " + res.message);
				}
			},
			error:function(res,a){
				$alertPSE.html("error ... ");
			}
		});
	};
	makePayment.cash=function(){
		$alertCash.html("procesando...");
		$.ajax({
			url: 'index.php/cash-payment',
			type: 'POST',
			data: $formCash.serialize()  + '&ip=' + userIP,
			dataType: 'json',
			success: function(res) {
				if(res.status == "ok"){
					$alertCash.html("procesando correctamente: "  + res.message);
					// Abre una nueva pestaña con la URL proporcionada
					window.open(res.url, '_blank');
				}else{
					$alertCash.html("error ... "+res.message);
				}
			},
			error:function(res,a){
				$alertCash.html("error ... "+res.message	);
			}
		});
	};
	makePayment.banks=function(){
		$alertBanks.html("procesando...");
		$.ajax({
			url: 'index.php/banks-payment',
			type: 'POST',
			data: $formBanks.serialize()  + '&ip=' + userIP,
			dataType: 'json',
			success: function(res) {
				if(res.status == "ok"){
					$alertBanks.html("procesando correctamente: "  + res.message);
					// Abre una nueva pestaña con la URL proporcionada
					window.open(res.url, '_blank');
				}else{
					$alertBanks.html("error ... "+res.message);
				}
			},
			error:function(res,a){
				$alertBanks.html("error ... "+res.message	);
			}
		});
	};
	return {		
		creditcard:function(){
			makePayment.creditcard();
		},
		pse:function(){
			makePayment.pse();
		},
		cash:function(){
			makePayment.cash();
		},
		banks:function(){
			makePayment.banks();
		}
	};
}();

document.getElementById('payment_method_cash').addEventListener('change', function() {
	var paymentMethod = this.value;
	var cashInstructions = document.getElementById('cash-instructions');
	var efectyInstructions = document.getElementById('efecty-instructions');

	if (paymentMethod === 'EFECTY') {
		cashInstructions.style.display = 'none';
		efectyInstructions.style.display = 'block';
	} else {
		cashInstructions.style.display = 'block';
		efectyInstructions.style.display = 'none';
	}
});