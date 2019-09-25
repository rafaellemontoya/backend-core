<?php

// $conexion = mysqli_connect (“localhost”, “user”, “pass”);
$conexion = new mysqli("localhost", "themytco_userjna", "JnA19DB", "themytco_jna19" );
mysqli_select_db ($conexion, “registro”);
$sql = “SELECT * FROM registro”;
$resultado = mysqli_query ($conexion, $sql) or die (mysql_error ());
$datos = array();
  while( $rows = mysqli_fetch_assoc($resultado) ) {
    $datos[] = $rows;
  }
mysqli_close($conexion);
 ?>

 <h2>Exportar datos a Excel con PHP y MySQL</h2>
 <form action=“ <?php echo $_SERVER[“PHP_SELF”]; ?>“ method=“post”>
   <button type=“submit” id=“export_data” name=‘export_data’ value=“Export to excel” class=“btn btn-info”>Exportar a Excel</button>
 </form>


<?php
  if(isset($_POST[“export_data”]))
  {
    if(!empty($datos))
    {
      $filename = “prueba.xls”;
      header(“Content-Type: application/vnd.ms-excel”);
      header(“Content-Disposition: attachment; filename=”.$filename);
      $mostrar_columnas = false;
      foreach($datos as $dato)
      {
        if(!$mostrar_columnas)
        {
          echo implode(“\t”, array_keys($dato)) . “\n”;
          $mostrar_columnas = true;
        }
          echo implode(“\t”, array_values($dato)) . “\n”;
        }

    }
    else{
          echo ‘No hay datos a exportar’;
        }
        exit;
  }

?>
