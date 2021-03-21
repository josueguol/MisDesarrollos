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
	  form.getElement('p:last-of-type').set('html','Favor de llenar todos los campos correctamente.');
	  form.getElement('p:last-of-type').setStyle('display', 'inline-block');
    return false;
  } else if(!regexTel.test(form.getElement('input[name="celular"]').get('value'))){
	  form.getElement('p:last-of-type').set('html','El teléfono es a 10 dígitos');
	  form.getElement('p:last-of-type').setStyle('display', 'inline-block');
  } else if(form.getElement('input[type="checkbox"]').checked === false) {
	  form.getElement('p:last-of-type').set('html','Favor de aceptar los Términos y Condiciones.');
	  form.getElement('p:last-of-type').setStyle('display', 'inline-block');
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
			$('submit1').set('text', 'Procesando');
			$('submit1').set('disabled', false);
    		window.location = '/thankyou.html';
    		},
            onFailure: function(respuesta){
            	alert("Ocurrio un error intentarlo de nuevo más tarde");
            }
    	})).send();
    }
  });
  
  $('submit2').addEvent('click', function (e) {
	    e.preventDefault();
	    //submitForm($('form1'));
	    if(submitForm($('form2'))){
	    	var datos = {
	        		nombre: $("nombre2").get("value"), 
	        		apellidopaterno: $("apellidopaterno2").get("value"),
	        		apellidomaterno: $("apellidomaterno2").get("value"),
	        		email: $("email2").get("value"),
	        		celular: $("celular2").get("value"),
	        };
	        (new Request.JSON({
	    		url: '/ontraport/ontraport/set/format/json',
	    		data: datos,
			onRequest: function(){
				$('submit2').set('disabled', true);
				$('submit2').set('text', 'Espere...');
			},
	    		onSuccess: function (respuesta) {
				$('submit1').set('text', 'Procesando');
				$('submit1').set('disabled', false);
	    			window.location = '/thankyou.html';
	    		},
	            onFailure: function(respuesta){
	            	alert("Ocurrio un error intentarlo de nuevo más tarde");
	            }
	    	})).send();
	    }
	  });
});

/*const formIsValid = form => {
  form.getElement('p:last-of-type').setStyle('display', 'none');
  let valid = true;
  let regexMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  let regexTel = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/;
  if(form.getElement('input[name="first_name"]').get('value') == '' || 
  form.getElement('input[name="first_name"]').get('value').length < 3 ||
  form.getElement('input[name="last_name"]').get('value') == '' ||
  form.getElement('input[name="last_name"]').get('value').length < 3 ||
  !regexMail.test(form.getElement('input[name="email"]').get('value')) ||
  !regexTel.test(form.getElement('input[name="phone"]').get('value'))){
    form.getElement('p:last-of-type').set('html','Favor de llenar todos los campos correctamente.');
    form.getElement('p:last-of-type').setStyle('display', 'inline-block');
    return false;
  } else if(form.getElement('input[type="checkbox"]').checked === false) {
    form.getElement('p:last-of-type').set('html','Favor de aceptar los Términos y Condiciones.');
    form.getElement('p:last-of-type').setStyle('display', 'inline-block');
    return false;
  } else return true;
}

const submitForm = form => {
  if(formIsValid(form))form.submit();
}

window.addEvent('domready', function () {
  $('submit1').addEvent('click', function (e) {
    e.preventDefault();
    submitForm($('form1'));
  });
  $('submit2').addEvent('click', function (e) {
    e.preventDefault();
    submitForm($('form2'));
  });
});*/
