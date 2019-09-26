
<?php
 header("Access-Control-Allow-Origin: *");
 include ("conexion.php");
 include ("enviar_mail");
 $datos=$_GET['datos'];
 $datos = json_decode($datos,true);
 // $nombre = $body["nombre"];
 $nombre = filter_var($datos["nombre"], FILTER_SANITIZE_STRING);
 $apellidos = filter_var($datos["apellidos"], FILTER_SANITIZE_STRING);
 $empresa = filter_var($datos["empresa"], FILTER_SANITIZE_STRING);
 $telefono = filter_var($datos["telefono"], FILTER_SANITIZE_STRING);
 $taller = filter_var($datos["taller"], FILTER_SANITIZE_STRING);
insertar($nombre,$apellidos,$empresa,$puesto,$email,$telefono,$taller);

function insertar($nombre,$apellidos,$empresa,$puesto,$email,$telefono,$taller)
{
  $id_guardado = 0;
  $respuesta="Se conecto";
  $stmt = $connect->prepare("INSERT INTO `registro_core` (
    `nombre`, `apellidos`,`empresa`, `puesto`, `email`,`telefono`,`id_taller`
  ) VALUES (?,?,?,?,?,?,?)");

  $stmt->bind_param("ssssssi", $nombre,$apellidos,$empresa,$puesto,$email,$telefono,$taller
                            );


  if($stmt->execute()){
    $respuesta="guardo";
    $estado_respuesta = 1;
    $query = "SELECT * FROM `registro_core` Order by id DESC Limit 1 ";
    $result= mysqli_query($connect, $query);
    $row= mysqli_fetch_assoc($result);
    $id_guardado = $row[id];

    //enviar_mail($nombre, $email, $apellidoPaterno,$apellidoMaterno);

  }else{
    $respuesta="NI guardo $ciudad, $estado, $cp,$email,$telefono ";

    $estado_respuesta = 0;
  }
  $stmt->close();
  $connect->close();



}

    $nombreRespuesta = $nombre. " ".$apellidos;
    print json_encode( array(
        'respuesta' => $estado_respuesta,
        'estado_respuesta' => $estado_respuesta,
        'nombre' => $nombreRespuesta,
        'id'=>$id_guardado

      ));

}

?>
