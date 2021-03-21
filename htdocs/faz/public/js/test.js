var PCBTest = new Class({
  initialize: function () {
    this.answers = {};
    this.current = 1;
    this.steps = $('steps').getElements('span');
    this.testBoxes = $('testMain').getElements('div.testBox');
    $('testMain').getElements('button.testBtn').each(function (el, i) {
      el.addEvent('click', function (e) {
        e.preventDefault();
        this.answers[this.current] = el.get('data-item');

        if ($('form').getElement('input#' + $(this.testBoxes[this.current - 1]).get('data-id')) === null) {
          var input = new Element('input', {
            'id': $(this.testBoxes[this.current - 1]).get('data-id'),
            'name': $(this.testBoxes[this.current - 1]).get('data-id'),
            'value': el.getElement('strong').get('html')
          });
          input.inject($('form'));
        } else {
          $('form').getElement('input#' + $(this.testBoxes[this.current - 1]).get('data-id')).set('value', el.getElement('strong').get('html'));
        }

        this.setActive(e.target);
        $('errorMsg').setStyle('display', 'none')
      }.bind(this));
    }.bind(this));

    $('anterior').addEvent('click', function () {
      this.move('bck');
    }.bind(this));

    $('siguiente').addEvent('click', function () {
      this.move('fwd');
    }.bind(this));

    $('name').addEvent('change', function () {
      $('nombre').set('value', $('name').get('value'));
    });

    $('lastname').addEvent('change', function () {
      $('apellidopaterno').set('value', $('lastname').get('value'));
    });

    $('surname').addEvent('change', function () {
      $('apellidomaterno').set('value', $('surname').get('value'));
    });

    $('email').addEvent('change', function () {
      $('emailf').set('value', $('email').get('value'));
    });
  },
  setActive: function (btn) {
    btn.getParent().getElements('button').each(function (el, i) {
      el.removeClass('selected');
    });
    btn.addClass('selected');
  },
  move: function (dir) {
    switch (dir) {
      case 'bck':
        if (this.current > 1) {
          $('anterior').setStyle('display', 'block');
          this.testBoxes[this.current - 1].setStyle('display', 'none');
          this.current--;
          this.current === 1 ? $('anterior').setStyle('display', 'none') : null;
        }
        break;
      case 'fwd':
        if (this.isStepComplete()) {
          if (this.current < this.steps.length) {
            this.setScroll = true;
            this.testBoxes[this.current - 1].setStyle('display', 'none');
            this.current++;
            this.current > 1 ? $('anterior').setStyle('display', 'block') : $('anterior').setStyle('display', 'none');
          } else if (this.formValid($('form'))) {
            this.setScroll = false;
            this.finished = true;
            this.redirectToResult();
          }
        } else {
          this.setScroll = false;
          $('errorMsg').getElement('p').set('html', 'Favor de seleccionar una opción para continuar.');
          $('errorMsg').setStyle('display', 'inline-block');
        }
        break;
    }
    if (!this.finished) {
      if (this.current === this.steps.length) {
        $('siguiente').removeClass('buttonP');
        $('siguiente').addClass('buttonG');
        $('siguiente').set('html', 'finalizar');
      } else {
        $('siguiente').removeClass('buttonG');
        $('siguiente').addClass('buttonP');
        $('siguiente').set('html', 'siguiente');
      }
      this.setStep();
      this.testBoxes[this.current - 1].setStyle('display', 'block');
      if (this.setScroll) {
        window.scrollTo(0, $('contentBox').getPosition().y - 20);
        if ($('nav')) {
          setTimeout(function(){ 
        	  $('nav').addClass('hidden'); 
          }, 50);
        }
      }
    }
  },
  setStep: function () {
    this.steps.each(function (el, i) {
      if (i < this.current) el.addClass('activated');
      else el.removeClass('activated');
    }.bind(this));
  },
  isStepComplete: function () {
    var valid = this.testBoxes[this.current - 1].getElement('button.selected') != null ? true : false;
    return valid;
  },
  formValid: function (form) {
    var regexMail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    $('errorMsg').setStyle('display', 'none');
    if ($('name').get('value') === '' || $('name').get('value').length < 3 || 
    	      $('lastname').get('value') === '' || $('lastname').get('value').length < 3 || 
    	      $('surname').get('value') === '' || $('surname').get('value').length < 3 || 
    	      !regexMail.test($('email').get('value'))) {
      $('errorMsg').getElement('p').set('html', 'Favor de ingresar nombre, apellidos y correo correctamente.');
      $('errorMsg').setStyle('display', 'inline-block');
      return false
    } else if ($('accept').checked == false) {
      $('errorMsg').getElement('p').set('html', 'Favor de aceptar los términos y condiciones.');
      $('errorMsg').setStyle('display', 'inline-block');
      return false;
    } else return true;
  },
  redirectToResult: function () {
    var url;
    switch (this.answers[8]) {
      case 'a':
        // conservador
        url = '/tp-conservador.html';
        break;
      case 'b':
        // moderado
        url = '/tp-moderado.html';
        break;
      case 'c':
        // agresivo
        url = '/tp-agresivo.html';
        break;
    }
      $('loading').setStyle('display', 'block');
      var respuestas = [];
      $$('button.selected').each(function(el) {
    	  //console.log(el.get( "data-field" ));
    	  respuestas.push({pregunta: el.get( "data-field" ), respuesta: el.get( "data-value" )})
      });
      var datos = {
      		nombre: $("nombre").get("value"), 
      		apellidopaterno: $("apellidopaterno").get("value"),
      		apellidomaterno: $("apellidomaterno").get("value"),
      		email: $("emailf").get("value"),
      		celular: "0",
      		respuestas: respuestas
      };
      (new Request.JSON({
  		url: '/ontraport/ontraport/test/format/json',
  		data: datos,
  		onSuccess: function (respuesta) {
  			window.location = url;
  			//console.log(respuesta);
  		},
          onFailure: function(respuesta){
          	alert("Ocurrio un error intentarlo de nuevo más tarde");
              //console.log(respuesta);
          }
  	})).send();
  }
});

var pcbTest;

window.addEvent('domready', function () {
  pcbTest = new PCBTest();
});