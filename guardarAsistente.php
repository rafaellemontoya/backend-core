<?php



$body = json_decode(file_get_contents("php://input"), true);


  // $nombre = $body["nombre"];

  $id_registro = intval($body["id_registro"]);
  $nombre = $body["nombre"];
  $apellido = $body["apellido"];
  $empresa = $body["empresa"];
  $puesto = $body["puesto"];
  $telefono = $body["telefono"];
  $email = $body["email"];


$connect = new mysqli("localhost", "themytco_userreg", "R3gistr0Ev3ntoS", "themytco_registro_eventos" );



    if($connect->connect_errno){

      $respuesta = "Error en la conexión";


    }else{
      $respuesta=1;
      $stmt = $connect->prepare("UPDATE `themytco_registro_eventos`.`registro_core` SET `nombre` = ?,`apellido` = ?,`email` = ?,`empresa` = ?,`puesto` = ?,`telefono` = ?,`id`=?

          WHERE `themytco_registro_eventos`.`registro_core`.`id_registro` = ? ");
      $stmt->bind_param("ssssssi",
      $nombre, $apellido, $empresa, $puesto, $telefono, $email,
        $id_registro );

      if($stmt->execute()){
        $respuesta=1;
        $estado_respuesta = 1;


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
        'id_registro' => $id_registro

      ));




?>
