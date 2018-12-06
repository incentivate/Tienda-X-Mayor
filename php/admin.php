<?php
session_start();

include("conexion.php");

 unset($_SESSION['error']);
 if(!isset($_POST['usuario']) || !isset($_POST['contrasenia'])) {
    
 } else{

 // FIX ME:
 // esto debería ser con md5() pero los datos los cargo desde la BD y no por acá, entonces se complica !!
 $usuario     = $_POST["usuario"];
 $contrasenia = $_POST["contrasenia"];

 if ($resultado = mysqli_query($link, "SELECT * from Administrador where usuario='" . $usuario . "' and contrasenia='" . $contrasenia . "'")) {

     if (mysqli_num_rows($resultado) == 1) {
         $row = mysqli_fetch_assoc($resultado);

         if ($row['contrasenia'] == $contrasenia && $row['usuario'] == $usuario) {
             header("Location: adminSubirBorrarImg.php");
         }
     } else {
            unset($_SESSION['usuario']);
            $_SESSION["error"] = "Usuario y/o contraseña incorrecta";
     }  
  }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
    <link rel="stylesheet" href="../css/ingresar.css">
</head>
<body>
	
<div class="container">

<div id="login">

<h1>Ingresar como Administrador</h1>

<form action="admin.php" method="post" enctype="multipart/form-data">
<p>
<label for="usuario">Nombre de usuario<br />
<input type="text" name="usuario" autocomplete='off' class="input" size="20" required /></label>
</p>
<p>
<label for="contrasenia">Contraseña<br />
<input type="password" name="contrasenia" autocomplete='off' class="input" size="20" required /></label>
</p>
<p class="submit">
<input type="submit" name="login" class="button" value="Entrar" />
</p>
</form>
</p>
<p id="error"><?php echo isset($_SESSION["error"]) ? $_SESSION["error"] : "";?>
</p>

</div> <!-- Cierra el div del login -->
</div> <!-- Cierra el div del container -->

</body>
</html>