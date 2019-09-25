<?php

require 'vendor/autoload.php';
require_once "bd.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// require 'vendor/autoload.php';
// require ('vendor/autoload.php');
// require ('vendor/phpoffice/phpspreadsheet/src/PhpOffice/PhpSpreadsheet/Spreadsheet.php')
// require ('vendor/phpoffice/phpspreadsheet/src/PhpOffice/PhpSpreadsheet/IOFactory.php')

// include "vendor\phpoffice\phpspreadsheet\src\PhpOffice\PhpSpreadsheet\IOFactory.php"
// include "vendor\phpoffice\phpspreadsheet\src\PhpOffice\PhpSpreadsheet\Spreadsheet.php"

// use \vendor\phpoffice\phpspreadsheet\src\PhpOffice\PhpSpreadsheet\IOFactory;
// use \vendor\phpoffice\phpspreadsheet\src\PhpOffice\PhpSpreadsheet\Spreadsheet;




$bd = obtenerBD();


$encabezado = ["ID", "Nombre", "Apellido Paterno", "Apellido Materno", "Nombre Busqueda", "Empresa", "Puesto", "e-mail", "Fecha llegada", "Fecha Salida", "Nombre Tarjeta", "Número tarjeta", "Expiracion", "CVV", "Estado", "Tipo tarjeta"];

$spreadsheet = new Spreadsheet();
$spreadsheet
  ->getProperties()
  ->setCreator("registro-eventos.com")
  ->setLastModifiedBy('registro-eventos.com') // última vez modificado por
  ->setTitle('Registros Junta Nacional Coldwell')
  ->setSubject('Regitros')
  ->setDescription('Este documento fue generado para Coldwell Banker')
  ->setKeywords('Coldwell Banker Junta Nacional 2019')
  ->setCategory('registro Eventos')
  ->setTitle('Registro Junta Nacional de Asociados')

  ;
      # Escribir encabezado de la tabla

      $spreadsheet->getActiveSheet()
          ->fromArray(
              $encabezado,  // The data to set
              NULL,        // Array values with this value will not be set
              'A1'         // Top left coordinate of the worksheet range where
                           //    we want to set these values (default is A1)
          );

          $consulta = "select id, nombre, apellidoPaterno, apellidoMaterno, nombreBusqueda, empresa, puesto, email, llegada, salida,
           nombreTarjeta, numeroTarjeta, expiracion, cvv, estado, tipoTarjeta from registro";
          $sentencia = $bd->prepare($consulta, [
              PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL,
          ]);
          $sentencia->execute();
          # Comenzamos en la 2 porque la 1 es del encabezado
          $numeroDeFila = 2;
          while ($datos = $sentencia->fetchObject()) {
            # Trabajar con $producto aquí :^)

            # Obtener los datos de la base de datos
            $id = $datos->id;
            $nombre = $datos->nombre;
            $paterno = $datos->apellidoPaterno;
            $materno = $datos->apellidoMaterno;
            $busqueda = $datos->nombreBusqueda;
            $empresa = $datos->empresa;
            $puesto = $datos->puesto;
            $email = $datos->email;
            $llegada = $datos->llegada;
            $salida = $datos->salida;
            $nomTarjeta = $datos->nombreTarjeta;
            $numTarjeta = $datos->numeroTarjeta;
            $expiracion = $datos->expiracion;
            $cvv = $datos->cvv;
            $estado = $datos->estado;
            $tipoTarjeta = $datos->tipoTarjeta;


            # Escribirlos en el documento
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(1, $numeroDeFila, $id);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(2, $numeroDeFila, $nombre);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(3, $numeroDeFila, $paterno);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(4, $numeroDeFila, $materno);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(5, $numeroDeFila, $busqueda);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(6, $numeroDeFila, $empresa);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(7, $numeroDeFila, $puesto);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(8, $numeroDeFila, $email);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(9, $numeroDeFila, $llegada);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(10, $numeroDeFila, $salida);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(11, $numeroDeFila, $nomTarjeta);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(12, $numeroDeFila, $numTarjeta);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(13, $numeroDeFila, $expiracion);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(14, $numeroDeFila, $cvv);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(15, $numeroDeFila, $estado);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(16, $numeroDeFila, $tipoTarjeta);

            $numeroDeFila++;



          }



header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="jna19.xls"');
$writer = IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
?>
