const formIsValid = form => {
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
});