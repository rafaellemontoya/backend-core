<?php



if ($_SERVER['REQUEST_METHOD'] == 'POST') {//Se asegura de recibir un POST

$body = json_decode(file_get_contents("php://input"), true);//Lee el archivo json que envia el front end
    $id = intval($body['id']); //Declaramos la variaboe bodyId

$connect = new mysqli("localhost", "themytco_userreg", "R3gistr0Ev3ntoS", "themytco_registro_eventos" ); //Declara el puerto, el usuarios y contrasenna y nombre de la BDD que vamos a usar

$query = "SELECT * FROM `registro_core` WHERE `id` = $id"; //Buscala fila por id
$result= mysqli_query($connect, $query); //Realiza la query y la almacena en $result
$row= mysqli_fetch_assoc($result);//convierte $result a un array asociativo llamado $row
/* En la sigueinte seccion revisamos que ninguno de los campos halla llegado vacio. De no estarlo, se le asgina una variable*/
$nombre = "";
if($row['nombre']!=null){
    $nombre = $row['nombre'];
}
$apellido = "";
if($row['apellido']!=null){
    $apellidoPaterno = $row['apellidoPaterno'];
}
$empresa = "";
if($row['empresa']!=null){
    $empresa = $row['empresa'];
}
$puesto = "";
if($row['puesto']!=null){
    $puesto = $row['puesto'];
}

$email = "";
if($row['email']!=null){
    $email = $row['email'];
}
$telefono = "";
if($row['telefono']!=null){
    $telefono = $row['telefono'];
}
$id_taller = "";
  if($row['id_taller']!=null ){
    $id_taller=$row['id_taller'];
    if($row['id_taller']===1){
      $nombre_taller='Mediación de Conflictos urbanos';
    }
    elseif($row['id_taller']===2){
      $nombre_taller='Regeneración del Espacio Público';
    }
    else{
      $nombre_taller='No registrado a talleres';
    }

}
/*$tipoAsistente = "";
if($row['tipoAsistente']!=null){
    $tipoAsistente = $row['tipoAsistente'];
}
$titulo = "";*/

if ($row != null){//Una vez mas se asegura de que no halla llegado una fila vacía. De no serlo, se manda un json con la informacion solicitada
    print json_encode(
        array(
                'estado' => "1",
                'id_registro'=>$id,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'empresa' => $empresa,
                'puesto' => $puesto,
                'telefono' => $telefono,
                'id_taller'=>$id_taller,
                'nombre_taller'=>$nombre_taller


        )
    );
}else{
    print json_encode(//si la fila estaba vacía, enciamos un json con estado 0 y todos los demas campos vacíos
        array(
          'estado' => "0",
          'id_registro'=>"",
          'nombre' => "",
          'apellido' => "",
          'empresa' => "",
          'puesto' => "",
          'telefono' => "",
          'id_taller'=>"",
          'nombre_taller'=>""
        )
    );
}





} //metodo post

 ?>
