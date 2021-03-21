
var request = function(url, params, callback) {
  $.ajax({
    url: url,
    method: "POST",
    data: params,
    beforeSend: function (xhr) {
      /* Authorization header */
      xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem("token"));
    },
    success: function (response) {
      callback(response);
    },
    error: function (jqXHR) {
      callback(jqXHR);
    }
  })
}

$(function() {
  console.log( "ready!" )
  request("/api/xoc/status", null, function(response) {
    if (response.status == 401) {
      $('#loginModal').modal({
        backdrop: 'static',
        keyboard: false
      })
      $('#loginModal').modal('show')
    } else {
      console.log("OK")
    }
  })
})

$(window).on( "load", function() {
  $('#loginModal').on('show.bs.modal', function (event) {
    console.log("Por favor inicie sesión")
  })
  
  var form = $("#loginForm");

  $.validator.addMethod("regex", function(value, element) { 
    return value.indexOf(" ") < 0 && value != ""; 
  }, "No space please and don't leave it empty");
  
  form.validate({
    event: "blur",
    rules: {
      'username': {
        required: true,
        minlength: 3,
        regex: true
      },
      'password': {
        required: true,
        minlength: 3
      }
    },
    messages: {
      "username": "No debe contener espacios, acentos ni signos, excepto \".\", \"_\" y \"-\"",
      "password": "Falta contraseña"
    },      
    submitHandler: function(){
      request("/api/xoc/login", $('form').serialize(), function(response) {
        if (response.status == 401) {
          $("#messageError").show()
          $("#messageError").text(response.responseJSON.message)
          console.log(response.responseJSON.message)
        } else {
          localStorage.setItem("token", response.data.token)
          $('#loginModal').modal('hide')
          $("#messageError").text("")
          $("#messageError").hide()
          console.log("OK")
        }
      })
    }
  })

  console.log( "window loaded" )
})