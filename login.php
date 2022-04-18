<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-dark bg-primary justify-content-between">
  <a class="navbar-brand">Equipos</a>
  <form class="form-inline">
     <a class="btn btn-outline-warning my-2 my-sm-0" href="logout.php">Regresar Login</a>
  </form>
</nav>
<div class="container">


<?php

$usuario = $_POST["usuario"];
$pwd = $_POST["pwd"];
$uri='http://localhost/API/?usuario='.$usuario.'&pwd='.$pwd;

$curl=curl_init();
curl_setopt($curl,CURLOPT_URL,$uri);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$result =curl_exec($curl);
$json=json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $result), true);

curl_close($curl);

if($json['message']=="Usuario invalido"){
  echo '<img src="https://us.123rf.com/450wm/carmenbobo/carmenbobo1507/carmenbobo150700007/41824544-sello-de-goma-con-el-texto-no-autorizado-en-el-interior-ilustraci%C3%B3n-vectorial.jpg">';
  
}else{
    session_start();
    $_SESSION["usuario"] = $usuario;
    header("Location:secreta.php");
}


?>
</div>
</body>
</html>

