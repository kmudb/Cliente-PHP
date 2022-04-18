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
     <a class="btn btn-outline-warning my-2 my-sm-0" href="logout.php">Cerrar sesión</a>
  </form>
</nav>
<div class="container">
<?php
# Si no entiendes el código, primero mira a login.php

# Iniciar sesión para usar $_SESSION
session_start();

# Y ahora leer si NO hay algo llamado usuario en la sesión,
# usando empty (vacío, ¿está vacío?)
# Recomiendo: https://parzibyte.me/blog/2018/08/09/isset-vs-empty-en-php/
if (empty($_SESSION["usuario"])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: formulario.html");
    # Y salimos del script
    exit();
}
$uri='http://localhost/API/';

$curl=curl_init();
curl_setopt($curl,CURLOPT_URL,$uri);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$result =curl_exec($curl);
$json=json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $result), true);



foreach ($json as $key=> $data1) {
$text= "<div class='card' style='width: 80rem'>";
$text.= ' <div class="card-body">';
    foreach($data1 as $k=>$Valor){

        if($k=="Datos"){
            foreach($Valor as $k1=>$val){
                $text.= '  <p class="card-text">'.$k1.':'.$val.'</p>';
            }
        }else{
            if($k=="ID"){
                $text.= '  <h5 class="card-title">'.$k.':'.$Valor.'</h5>';
            }else{
                $text.= ' <h6 class="card-subtitle mb-2 text-muted">'.$k.':'.$Valor.'</h6>';
            }
        }

    }
   // $text.= '   <a href="#" class="card-link">Another link</a>';
$text.= ' </div>';
$text.= '</div>';
    echo $text.'<br>';
}
?>
</div>

</body>
</html>
