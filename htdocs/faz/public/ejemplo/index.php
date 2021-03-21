<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}
//die("***");
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Smartcrop.js Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script type="text/javascript" src="/portal/scripts/MooTools-Core-1.6.0-compressed.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>



  <img src="https://tvazteca.brightspotcdn.com/0c/44/435946204ffabb5acdce5ab7e97a/complicaahorrar.jpeg" class="imagencrop" crossorigin="anonymous">


  <script src="../js/crop/jquery.js"></script>
    <script src="../js/crop/smartcrop.js"></script>


    <script  src="js/index.js"></script>




</body>

</html>
