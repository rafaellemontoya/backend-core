<?php
include('conexion.php');
header("Access-Control-Allow-Origin: *");
include ("conexion.php");
include ("enviar_mail");
$datos=$_GET['datos'];
$datos = json_decode($datos,true);
// $nombre = $body["nombre"];
$nombre = intval($datos["id"]);
buscar($id);
$estado_respuesta =0;
function buscar($id)
{


    if($connect->connect_errno){

      $respuesta = "Error en la conexión";


    }else{
      $respuesta="Se conecto";


      $query = "SELECT * FROM `registro_core` WHERE `id_asistente` =  $id";
      $result= mysqli_query($connect, $query);
      $row= mysqli_fetch_assoc($result);
      $estado_respuesta =1;
      $nombre = $row[nombre];
      $apellido = $row[apellido];
      $email = $row[email];
      $id_taller = $row[id_taller];
      $nombre_taller = "";
      if($id_taller == 1){

        $nombre_taller = "Medición de conflictos urbanos";
      }else if($id_taller == 2){
        $nombre_taller = "Regeneración del espacio público";
      }


    }
    $nombreRespuesta = $nombre. " ".$apellidoPaterno." ".$apellidoMaterno;
    print json_encode( array(
        'respuesta' => $estado_respuesta,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'email' => $email,
        'taller' => $nombre_taller,

      ));


  }

?>
