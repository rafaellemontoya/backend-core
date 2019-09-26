<?php
 header("Access-Control-Allow-Origin: *");
 include ("conexion.php");
 include ("enviar_mail.php");
 $datos=$_GET['datos'];
 $datos = json_decode($datos,true);
 // $nombre = $body["nombre"];
 $nombre = filter_var($datos["nombre"], FILTER_SANITIZE_STRING);
 $apellidos = filter_var($datos["apellidos"], FILTER_SANITIZE_STRING);
 $empresa = filter_var($datos["empresa"], FILTER_SANITIZE_STRING);
 $telefono = filter_var($datos["telefono"], FILTER_SANITIZE_STRING);
 $taller = intval($datos["taller"]);
 $puesto = filter_var($datos["puesto"], FILTER_SANITIZE_STRING);
  $email = filter_var($datos["email"], FILTER_SANITIZE_STRING);
insertar($nombre,$apellidos,$empresa,$puesto,$email,$telefono,$taller);

function insertar($nombre,$apellidos,$empresa,$puesto,$email,$telefono,$taller)
{
  $id_guardado = 0;
  $respuesta="Se conecto";
  $respuesta="guardo";
  $estado_respuesta = 1;
  $connect = new mysqli("localhost", "themytco_userreg", "R3gistr0Ev3ntoS", "themytco_registro_eventos" );

  $stmt = $connect->prepare("INSERT INTO `registro_core` (
    `nombre`, `apellido`,`empresa`, `puesto`, `email`,`telefono`,`id_taller`
  ) VALUES (?,?,?,?,?,?,?)");



  $stmt->bind_param("ssssssi", $nombre,$apellidos,$empresa,$puesto,$email,$telefono,$taller  );


  if($stmt->execute()){
    $respuesta="guardo";
    $estado_respuesta = 1;
    $query = "SELECT * FROM `registro_core` Order by id_registro DESC Limit 1 ";
    $result= mysqli_query($connect, $query);
    $row= mysqli_fetch_assoc($result);
    $id_guardado = $row[id_registro];

    //enviar_mail($nombre, $email, $apellidoPaterno,$apellidoMaterno);

  }else{
    $respuesta="NI guardo $ciudad, $estado, $cp,$email,$telefono ";

    $estado_respuesta = 0;
  }
  $stmt->close();
  $connect->close();





    $nombreRespuesta = $nombre. " ".$apellidos;
    print json_encode( array(
        'respuesta' => $estado_respuesta,
        'estado_respuesta' => $estado_respuesta,
        'nombre' => $nombreRespuesta,
        'id'=>$id_guardado

      ));

}

?>
