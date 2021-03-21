function formIsValid(form){
  //form.getElement('p:last-of-type').setStyle('display', 'none');
	$("errorMsg2").setStyle('display', 'none');
  var valid = true;
  var regexMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var regexTel = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
  if(form.getElement('input[name="nombre"]').get('value') == '' || 
  form.getElement('input[name="nombre"]').get('value').length < 3 ||
  form.getElement('input[name="apellidopaterno"]').get('value') == '' ||
  form.getElement('input[name="apellidopaterno"]').get('value').length < 3 ||
  !regexMail.test(form.getElement('input[name="email"]').get('value'))){
	  $("errorMsg2").set('html','Favor de llenar todos los campos correctamente.');
	  $("errorMsg2").setStyle('display', 'inline-block');
    return false;
  } else if(!regexTel.test(form.getElement('input[name="celular"]').get('value'))){
	  $("errorMsg2").set('html','El teléfono es a 10 dígitos');
	  $("errorMsg2").setStyle('display', 'inline-block');
  } else if(form.getElement('input[type="checkbox"]').checked === false) {
	$("errorMsg2").set('html','Favor de aceptar los Términos y Condiciones.');
    $("errorMsg2").setStyle('display', 'inline-block');
    return false;
  } else return true;
}

function submitForm(form){
	if(formIsValid(form)){
		return true;
	}else{
		return false;
	}
}

window.addEvent('domready', function () {
  $('submit1').addEvent('click', function (e) {
    e.preventDefault();
    //submitForm($('form1'));
    if(submitForm($('form1'))){
    	var datos = {
        		nombre: $("nombre").get("value"), 
        		apellidopaterno: $("apellidopaterno").get("value"),
        		apellidomaterno: $("apellidomaterno").get("value"),
        		email: $("email").get("value"),
        		celular: $("celular").get("value"),
        };
        (new Request.JSON({
    		url: '/ontraport/ontraport/set/format/json',
    		data: datos,
    		onRequest: function(){
    			$('submit1').set('disabled', true);
    			$('submit1').set('text', 'Espere...');
    		},
    		onSuccess: function (respuesta) {
    			console.log(respuesta);
    			$('submit1').set('text', 'solicita tu coaching financiero');
    			$('submit1').set('disabled', false);
    			$("nombre").set("value","");
    			$("apellidopaterno").set("value","");
    			$("apellidomaterno").set("value","");
    			$("email").set("value","");
    			$("celular").set("value","");
    			$("agree").set("checked", false);
    		},
            onFailure: function(respuesta){
            	alert("Ocurrio un error intentarlo de nuevo más tarde");
                console.log(respuesta);
            }
    	})).send();
    }
  });
});
