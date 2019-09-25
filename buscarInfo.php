<?

$connect = new mysqli("localhost", "themytco_userjna", "JnA19DB", "themytco_jna19" );

  if($connect->connect_errno){

    $respuesta = "Error en la conexión";


  }else{


      $json_array = array();
                              $query = "SELECT * FROM `registro` WHERE NOT estado=2";
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
