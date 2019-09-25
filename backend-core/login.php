<?php

  $body = json_decode(file_get_contents("php://input"), true);
  // $nombre = $body["nombre"];
  $email = filter_var($body["email"], FILTER_SANITIZE_STRING);
  $password = filter_var($body["password"], FILTER_SANITIZE_STRING);


  $connect = new mysqli("localhost", "themytco_userjna", "JnA19DB", "themytco_jna19" );
  $respuesta="";
  $estado_respuesta = 0;
  $nombre = "";
  $id = 0;
    if($connect->connect_errno){

      $respuesta = "Error en la conexión";


    }else{
      $respuesta="Se conecto";

      $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
      $result= mysqli_query($connect, $query);
      $row= mysqli_fetch_assoc($result);
      if($row != null){
        $estado_respuesta = 1;
        $nombre = $row['nombre'];
        $id = $row['id'];

      }else{
        $estado_respuesta = -1;
        $nombre = "";
        $id = 0;
        $email = "";
      }






    print json_encode( array(
        'respuesta' => $estado_respuesta,
        'id' => $id,
        'nombre' => $nombre,
        'email' => $email,
        'row' => $row

      ));



}

?>
