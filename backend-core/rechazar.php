<?php


 header("Access-Control-Allow-Origin: *");
$body = json_decode(file_get_contents("php://input"), true);


  // $nombre = $body["nombre"];

  $id = $body["id"];
  $email = $body["email"];


  $connect = new mysqli("localhost", "themytco_userjna", "JnA19DB", "themytco_jna19" );


    if($connect->connect_errno){

      $respuesta = "Error en la conexión";


    }else{
      $respuesta="Se conecto";


      $estado = 2;
      $stmt = $connect->prepare("UPDATE `themytco_jna19`.`registro` SET `estado` = ?  WHERE `themytco_jna19`.`registro`.`id` = ? ");
      $stmt->bind_param("ii", $estado, $id );
      if($stmt->execute()){
        $respuesta="guardo";
        $estado_respuesta = 1;

        $query = "SELECT * FROM `registro` WHERE `id` = '$id'";
        $result= mysqli_query($connect, $query);
        $row= mysqli_fetch_assoc($result);


        enviar_mail($row['nombre'], $email, $row['apellidoPaterno'],$row['apellidoMaterno'], $row['llegada'], $row['salida'], $id);

      }else{
        $respuesta="NI guardo $ciudad, $estado, $cp,$email,$telefono ";

        $estado_respuesta = 0;
      }
      $stmt->close();
      $connect->close();



    }
    $nombreRespuesta = $nombre. " ".$apellidoPaterno." ".$apellidoMaterno;
    print json_encode( array(
        'respuesta' => $estado_respuesta,
        'estado_respuesta' => $estado_respuesta,
        'nombre' => $row

      ));



function enviar_mail($nombre, $email, $apellidoPaterno,$apellidoMaterno, $llegada, $salida, $id) {

    require("class.phpmailer.php");
    require("class.smtp.php");



    // Datos de la cuenta de correo utilizada para enviar v�a SMTP
    $smtpHost = "registro-eventos.com";  // Dominio alternativo brindado en el email de alta
    $smtpUsuario = "registro@registro-eventos.com";  // Mi cuenta de correo
    $smtpClave = "r3gi5TrO3";  // Mi contrase�a
    $mensaje = "";

  	$mail = new PHPMailer;
  	$mail->IsSMTP();
  	$mail->SMTPAuth = true;
  	$mail->Port = 26;
    $mail->IsHTML(true);
    $mail->CharSet = "utf-8";

    // VALORES A MODIFICAR //
    $mail->Host = $smtpHost;
    $mail->Username = $smtpUsuario;
    $mail->Password = $smtpClave;

    // $mail->SMTPSecure = '';
    $mail->From = $smtpUsuario; // Email desde donde env�o el correo.
    $mail->FromName = "Coldwell Banker";
    $mail->AddAddress($email);

    $mail->Subject = "Registro Junta Nacional de Afiliados 2019"; // Este es el titulo del email.
    $mensajeHtml = nl2br($mensaje);

  	// $mail->WordWrap = 50;
    $track_code = md5(rand());



      // $message_body = $_POST['email_body'];
  	// $message_body .= '<img src="'.$base_url.'email_track.php?code='.$track_code.'" width="1" height="1" />';
  	// $mail->Body = $message_body;
    $base_url = "https://themyt.com/frankie/email_track.php?id=$id_guardado";
    $mail->Body = '

    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
    <HTML style="BACKGROUND: #f3f3f3" lang=en xml:lang="en"
    xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>Junta Nacional de Asociados | 24 al 26 de Octubre, 2019</TITLE>
    <META content="text/html; charset=iso-8859-1" http-equiv=Content-Type>
    <META name=viewport content=width=device-width>
    <META name=GENERATOR content="MSHTML 8.00.6001.23588">
    </HEAD>
    <BODY>
    <table width="602" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#999999">

      <tr>
        <td width="602" bgcolor="#bbbbbb" style="padding-left:1px; padding-right:1px; padding-top:1px;"><table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td width="546"><img src="https://www.registro-eventos.com/cbm/jna19/registro_html/images/banner_750_x_250.jpg" width="750" height="250"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

              <tr>
                <td><span style="font-family:Arial, Helvetica, sans-serif;font-size:18px;color:#444444; margin-top:5px; margin-bottom:5px;"><strong>Estimado '.$nombre.' '.$apellidoPaterno.' '.$apellidoMaterno.'</strong></span></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><span style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#444444; margin-top:5px; margin-bottom:5px;">Revisamos el status de tu registro y no podemos cofirmar tu asistencia por el momento.<br>

Por favor enviar un mail a Lina Gonzalez (<a href="mailto:lina_gonzalez@coldwellbanker.com.mx">lina_gonzalez@coldwellbanker.com.mx</a>) para dar seguimiento a tu registro.<br>
                  <br>
                  Gracias<br>
                  <br>
                  <br>
                  <strong>Colwell Banker M&eacute;xico</strong></span></td>
              </tr>
            </table></td>
          </tr>


          <tr>
            <td>&nbsp;</td>
          </tr>


          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><img src="https://www.registro-eventos.com/cbm/jna19/registro_html/images/footer_750_x_30.jpg" width="750" height="30"></td>
          </tr>
          <tr>
            <td><div align="center">&nbsp;</div></td>
          </tr>
        </table>

      </td>

      </tr>
      </table>
    </BODY>
    </HTML>


'; // Texto del email en formato HTML

    $mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
    // FIN - VALORES A MODIFICAR //

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );



    $respuesta = "";
    $estado_respuesta = 0;
  	if($mail->Send())
  	{
      $respuesta = "Enviado";
      $estado_respuesta = 1;

    } else {
      $respuesta = "Error al enviar";
      $estado_respuesta = 0;

    }

    return array(
        'respuesta' => $respuesta,
        'estado_respuesta' => $estado_respuesta,
      );
  }



  /**
   * Reemplaza todos los acentos por sus equivalentes sin ellos
   *
   * @param $string
   *  string la cadena a sanear
   *
   * @return $string
   *  string saneada
   */
  function sanear_string($string)
  {

      $string = trim($string);

      $string = str_replace(
          array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
          array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
          $string
      );

      $string = str_replace(
          array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
          array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
          $string
      );

      $string = str_replace(
          array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
          array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
          $string
      );

      $string = str_replace(
          array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
          array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
          $string
      );

      $string = str_replace(
          array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
          array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
          $string
      );

      $string = str_replace(
          array('ñ', 'Ñ', 'ç', 'Ç'),
          array('n', 'N', 'c', 'C',),
          $string
      );

      //Esta parte se encarga de eliminar cualquier caracter extraño
      // $string = str_replace(
      //     array("\", "¨", "º", "-", "~",
      //          "#", "@", "|", "!", """,
      //          "·", "$", "%", "&", "/",
      //          "(", ")", "?", "'", "¡",
      //          "¿", "[", "^", "<code>", "]",
      //          "+", "}", "{", "¨", "´",
      //          ">", "< ", ";", ",", ":",
      //          ".", " "),
      //     '',
      //     $string
      // );


      return $string;
  }

?>
