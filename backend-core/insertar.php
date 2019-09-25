
<?php
 header("Access-Control-Allow-Origin: *");
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
