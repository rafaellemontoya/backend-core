<?php
 header("Access-Control-Allow-Origin: *");
 include ("conexion.php");
 function contar($taller){
   $datos=$_GET['datos'];
   $datos = json_decode($datos,true);
   $taller = intval($datos["taller"]);
   $connect = new mysqli("localhost", "themytco_userreg", "R3gistr0Ev3ntoS", "themytco_registro_eventos" );
   $query = "SELECT COUNT(*) AS total FROM registro_core WHERE id_taller=$taller";
   $resultado_query=mysqli_query($connect,$query);
   $contador = mysqli_fetch_array($resultado_query, MYSQLI_NUM);
   return $contador

 }

 ?>
