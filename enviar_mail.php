<?php
header("Access-Control-Allow-Origin: *");
function enviar_mail($nombre, $apellidos, $email, $id_guardado, $taller )
 {


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
    $mail->FromName = "CoRe Ciudades Vivibles y Amables 2019 ";
    $mail->AddAddress($email);

    $mail->Subject = "Registro al evento "; // Este es el titulo del email.
    $mensajeHtml = nl2br($mensaje);

  	// $mail->WordWrap = 50;
    $track_code = md5(rand());

    $srcQR = '<img src="https://www.registro-eventos.com/core/2019/backend/qrgenerator/generate.php?text='.$id_guardado.'" alt="" width="150" height="150" align=center class=float-center>';


      // $message_body = $_POST['email_body'];
  	// $message_body .= '<img src="'.$base_url.'email_track.php?code='.$track_code.'" width="1" height="1" />';
  	// $mail->Body = $message_body;
    // $base_url = "https://themyt.com/frankie/email_track.php?id=$id_guardado";
    $mail->Body = '

    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
    <HTML style="BACKGROUND: #f3f3f3" lang=en xml:lang="en"
    xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>CoRe Ciudades Vivibles y Amables | 17 de Octubre, 2019</TITLE>
    <META content="text/html; charset=iso-8859-1" http-equiv=Content-Type>
    <META name=viewport content=width=device-width>
    <META name=GENERATOR content="MSHTML 8.00.6001.23588">
    </HEAD>
    <BODY>
    <table width="602" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#999999">

      <tr>
        <td width="602" bgcolor="#bbbbbb" style="padding-left:1px; padding-right:1px; padding-top:1px;"><table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td width="546"><img src="https://www.registro-eventos.com/core/2019/registro_html/images/banner-confirma_750_x_200.jpg" width="750" height="250"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

              <tr>
                <td><span style="font-family:Arial, Helvetica, sans-serif;font-size:18px;color:#444444; margin-top:5px; margin-bottom:5px;"><strong>Apreciable '.$nombre.' '.$apellidos.'</strong></span></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><span style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#444444; margin-top:5px; margin-bottom:5px;">Se ha confirmado tu asistencia al  evento: <strong>CoRe Ciudades Vivibles y Amables 2019 </strong></span></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
           <tr>
            <td> <HR style="BORDER-BOTTOM: #1B1A18 2px solid; BORDER-LEFT: #1B1A18 2px solid; MARGIN: 0px 15px; BORDER-TOP: #1B1A18 2px solid; BORDER-RIGHT: #1B1A18 2px solid"></td>
          </tr>
           <tr>
            <td>&nbsp;</td>
          </tr>
           <tr>
            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="center"><span style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#444444; margin-top:5px; margin-bottom:5px;">Para agilizar tu registro, te pedimos llevar el d&iacute;a del evento el siguiente código QR:</span></div></td>
              </tr>
            </table>
              <div align="center"></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="center"><span style="MIN-WIDTH: 532px; WIDTH: 100%">'.$srcQR.'</span></div></td>
          </tr>
           <tr>
            <td>&nbsp;</td>
          </tr>



          <tr>
            <td> <HR style="BORDER-BOTTOM: #1B1A18 2px solid; BORDER-LEFT: #1B1A18 2px solid; MARGIN: 0px 15px; BORDER-TOP: #1B1A18 2px solid; BORDER-RIGHT: #1B1A18 2px solid"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="center"><span style="font-family:Arial, Helvetica, sans-serif;font-size:16px;color:#444444; margin-top:5px; margin-bottom:5px;"><strong>Detalles de Registro</strong></span></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><span style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#444444; margin-top:5px; margin-bottom:5px;">N&uacute;mero de Registro: <strong>'.$id_guardado.' </strong><br>
                  <br>
                  Nombre: <strong> '.$nombre.' '.$apellidos.'</strong><br>
                  <br>
                  Email: <strong>'.$email.'</strong><br>
                   <br>
                  Taller: <strong>'.$taller.'</strong><br>

                  <br>
                </span></td>
              </tr>
            </table></td>
          </tr>

          <tr>
            <td><HR style="BORDER-BOTTOM: #1B1A18 2px solid; BORDER-LEFT: #1B1A18 2px solid; MARGIN: 0px 15px; BORDER-TOP: #1B1A18 2px solid; BORDER-RIGHT: #1B1A18 2px solid"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="center"><span style="font-family:Arial, Helvetica, sans-serif;font-size:16px;color:#444444; margin-top:5px; margin-bottom:5px;"><strong>Informaci&oacute;n de Evento</strong></span></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="51%" valign="top"><span style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#444444; margin-top:5px; margin-bottom:5px;"><strong>Evento </strong><br>
                    <strong>CoRe Ciudades Vivibles y Amables 2019</strong><br>
                  <br>
                  <strong>Fecha</strong> <br>
                   Jueves 17 Octubre, 2019 <br>
                  <br>
                  <strong>Horario</strong> <br>
                  09:00 a 18:00 hrs.</span></td>
                <td width="49%" valign="top"><span style="font-family:Arial, Helvetica, sans-serif;font-size:13px;color:#444444; margin-top:5px; margin-bottom:5px;"><strong>Lugar</strong> <br>
                 Museo Kaluz<br>
                  <br>
                  <strong>Direcci&oacute;n</strong> <br>
                   Av. Hidalgo No. 85, Centro Hist&oacute;rico de la Ciudad de M&eacute;xico, C.P. 06300, CDMX. </span></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><TABLE
                                  style="TEXT-ALIGN: left; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; BORDER-SPACING: 0; WIDTH: 100%; PADDING-RIGHT: 0px; BORDER-COLLAPSE: collapse; VERTICAL-ALIGN: top; PADDING-TOP: 0px">
              <TBODY>
                <TR
                                    style="TEXT-ALIGN: left; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; VERTICAL-ALIGN: top; PADDING-TOP: 0px">
                  <TD
                                    style="BORDER-BOTTOM: #1B1A18 0px solid; TEXT-ALIGN: left; BORDER-LEFT: #1B1A18 0px solid; PADDING-BOTTOM: 0px; LINE-HEIGHT: 1.5; MARGIN: 0px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BORDER-COLLAPSE: collapse !important; FONT-FAMILY: Helvetica,Arial,sans-serif; WORD-WRAP: break-word; BACKGROUND: #1B1A18; COLOR: #fefefe; FONT-SIZE: 13px; VERTICAL-ALIGN: top; BORDER-TOP: #1B1A18 0px solid; FONT-WEIGHT: 300; BORDER-RIGHT: #1B1A18 0px solid; PADDING-TOP: 0px; -moz-hyphens: auto; -webkit-hyphens: auto; hyphens: auto"><CENTER style="MIN-WIDTH: 0px; WIDTH: 100%"
                                    data-parsed="">
                    <A
                                    style="BORDER-BOTTOM: #1B1A18 0px solid; TEXT-ALIGN: center; BORDER-LEFT: #1B1A18 0px solid; PADDING-BOTTOM: 8px; LINE-HEIGHT: 1.5; MARGIN: 0px; PADDING-LEFT: 0px; WIDTH: 100%; PADDING-RIGHT: 0px; DISPLAY: inline-block; FONT-FAMILY: Helvetica,Arial,sans-serif; COLOR: #fefefe; FONT-SIZE: 15px; BORDER-TOP: #1B1A18 0px solid; FONT-WEIGHT: 300; BORDER-RIGHT: #1B1A18 0px solid; TEXT-DECORATION: none; PADDING-TOP: 8px; border-radius: 3px"
                                    class=float-center href="https://www.registro-eventos.com/core/2019/CoRe2019.ics" target="_blank" align="center">Agregar a mi calendario</A>
                  </CENTER></TD>
                </TR>
              </TBODY>
            </TABLE></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><img src="https://www.registro-eventos.com/core/2019/registro_html/images/footer_600_x_30.jpg" width="750" height="30"></td>
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
        'email_envio'=>$email
      );
  }
?>
