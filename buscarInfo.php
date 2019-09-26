<?

 $connect = new mysqli("localhost", "themytco_userreg", "R3gistr0Ev3ntoS", "themytco_registro_eventos" );
  if($connect->connect_errno){

    $respuesta = "Error en la conexión";


  }else{



      $json_array = array();
                              $query = "SELECT * FROM `registro_core`";
                              $result= mysqli_query($connect, $query);
                              while($row= mysqli_fetch_assoc($result)){
                                $json_array[] = $row;
                              }

                              $respuesta = "hola";
                              print json_encode(

                                    $json_array

                                );

                            }
?>
