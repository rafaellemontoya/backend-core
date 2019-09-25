<?php
function obtener_cupo($id){
   header("Access-Control-Allow-Origin: *");
include ("conexion.php");
$query = "SELECT * FROM `talleres_core_2019` WHERE `id_taller`=$id ";
$result= mysqli_query($connect, $query);
while($row= mysqli_fetch_assoc($result)){


  }
  return $result
}

 ?>
