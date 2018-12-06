
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Usuario</title>
	<link rel="stylesheet" href="../css/ingresar.css">
</head>
<body>
	
<div class="container">
<div id="login">

<h1>Registrar Usuario</h1>

<form action="validarUsuario.php" method="post" enctype="multipart/form-data">
<p>
<label for="usuario">Nombre de usuario<br />
<input type="text" name="usuario" class="input" size="20" required /></label>
</p>
<p>
<label for="contrasenia">Contraseña<br />
<input type="password" name="contrasenia" class="input" size="20" required /></label>
</p>
<p>
<label for="mail">Email<br />
<input type="email" name="mail" class="input" size="20" required /></label>
</p>
<p class="submit">
<input type="submit" name="login" class="button" value="Enviar" />
</p>
</form>


</div>
</div> <!-- Cierra el div del container -->

</body>
</html>



