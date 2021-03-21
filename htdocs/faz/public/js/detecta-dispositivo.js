window.addEvent('domready', function() {

function detectaMobile(){
	var mobil = 1;
			if(navigator.userAgent.match(/LG Browser/i) 	== null
                           && navigator.userAgent.match(/Android/i) 	== null
                           && navigator.userAgent.match(/iPhone/i)  	== null 
                           && navigator.userAgent.match(/iPad/i)    	== null 
                           && navigator.userAgent.match(/iPod/i)    	== null
			   && navigator.userAgent.match(/webOS/i)   	== null
			   && navigator.userAgent.match(/BlackBerry/i) 	== null){
					mobil = 0;
			}

	return mobil;
}
try {				
	var esMobil = detectaMobile(); 
			
		if(esMobil == 1){
				$$("img[name=imagencrop]").each(function(datosEntrada) {
						$(datosEntrada).removeProperties('width', 'height');
				});
		}
}
catch(err) {
  console.log("¡Uppss!: "+ err.message);
}		
});
