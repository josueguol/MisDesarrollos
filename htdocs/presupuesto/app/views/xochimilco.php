<!DOCTYPE html>
<html lang="en">
<head>
  <title>Xochimilco - Presupuesto</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/css/ext/bootstrap.min.css">
  <link rel="stylesheet" href="/css/style.css">
  <script src="/js/ext/jquery.min.js"></script>
  <script src="/js/ext/popper.min.js"></script>
  <script src="/js/ext/bootstrap.min.js"></script>
  <script src="/js/ext/jquery.validate.min.js"></script>
  <script src="/js/main.js"></script>
  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>Alcandía Xochimilco</h1>
  <p>Presupuesto de egresos</p> 
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">Consultar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">Cargar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">Salir</a>
      </li>    
    </ul>
  </div>  
</nav>

<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
      <h2>TITLE HEADING</h2>
      <h5>Title description, Dec 7, 2017</h5>
      <div class="fakeimg">Fake Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
      <br>
      <h2>TITLE HEADING</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <div class="fakeimg">Fake Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>Subdirección de Recursos Humanos</p>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="loginForm">
      <div class="modal-header">
        <h5 class="modal-title" id="loginLabel">Iniciar sesión</h5>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="username">Usuario</label>
          <input type="text" class="form-control" name="username" placeholder="usuario">
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" class="form-control" name="password" placeholder="contraseña">
        </div>
      </div>
      <div class="modal-footer">
        <label id="messageError" class="error" style="display: none;"></label>
        <input type="submit" id="submitForm" class="btn btn-primary" value="Entrar">
      </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>