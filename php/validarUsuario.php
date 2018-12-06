<?php

include("conexion.php");
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';
require 'phpMailer/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;

if(!isset($_POST["usuario"]) || !isset($_POST["contrasenia"]) || !isset($_POST["mail"]))
  {
    print "Debe completar todos los campos del formulario";
  }

else{
	$subject = "Por favor confirme su registro en TiendaXMayor.com!";
	$usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];
	$email = $_POST["mail"];
	$body = "Bienvenido $usuario a TiendaXMayor.com. Su contraseña de registro es $contrasenia";

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host       = "smtp.gmail.com";
$mail->Port       = 465;
$mail->SMTPAuth   = true;
$mail->SMTPSecure = 'ssl';
$mail->Username   = "incentivate";
$mail->Password   = "nachocapo24"; // cambiar la pass del mail desde que voy a mandar

$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
));

$mail->setFrom('incentivate@gmail.com', "Mail enviado desde mi gran mega APP");  
$mail->isHTML(true);
$mail->AddAddress($_POST["mail"]);
$mail->Subject = utf8_decode($subject);
$mail->Body = $body; 
$mail->AltBody = "Body alternativo";
$exito = $mail->Send();
	
	$md5Pass = md5($contrasenia);

	// Debería ir con mysqli_real_escape_string, pero no anda :/
	if ($resultado = mysqli_query($link, "insert into Usuarios (usuario, contrasenia, mail) values ('$usuario', '$md5Pass', '$email')"))
	{
		print "Usuario generado correctamente";
		header("Location: index.php");
	}
	else
	{
    	print "No se pudo generar el usuario: ". mysqli_error($link);
    	die;
	}
}

?>