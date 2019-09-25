
<?php
 header("Access-Control-Allow-Origin: *");
 include ("conexion.php");
 $datos=$_GET['datos'];
 $datos = json_decode($datos,true);
 // $nombre = $body["nombre"];
 $nombre = filter_var($datos["nombre"], FILTER_SANITIZE_STRING);
 $apellidos = filter_var($datos["apellidos"], FILTER_SANITIZE_STRING);
 $empresa = filter_var($datos["empresa"], FILTER_SANITIZE_STRING);
 $telefono = filter_var($datos["telefono"], FILTER_SANITIZE_STRING);
 $taller = filter_var($datos["taller"], FILTER_SANITIZE_STRING);
insertar($nombre,$apellidos,$empresa,$puesto,$email,$telefono);
$query = "SELECT `id` FROM `talleres_core_2019`";
$result = mysqli_query($conexion, $query);
function insertar($nombre,$apellidos,$empresa,$puesto,$email,$telefono)
{
  $respuesta="Se conecto";
  $stmt = $connect->prepare("INSERT INTO `talleres_core_2019` (
    `nombre`, `apellidos`,`empresa`, `puesto`, `email`,`telefono`
  ) VALUES (?,?,?,?,?,?)");

  $stmt->bind_param("ssssss", $nombre,$apellidos,$empresa,$puesto,$email,$telefono
                            );


  if($stmt->execute()){
    $respuesta="guardo";
    $estado_respuesta = 1;
    enviar_mail($nombre, $email, $apellidoPaterno,$apellidoMaterno);

  }else{
    $respuesta="NI guardo $ciudad, $estado, $cp,$email,$telefono ";

    $estado_respuesta = 0;
  }
  $stmt->close();
  $connect->close();



}

    $nombreRespuesta = $nombre. " ".$apellidoPaterno." ".$apellidoMaterno;
    print json_encode( array(
        'respuesta' => $estado_respuesta,
        'estado_respuesta' => $estado_respuesta,
        'nombre' => $nombreRespuesta

      ));

}

?>
