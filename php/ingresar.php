

<?php

include("conexion.php");

    unset($_SESSION['error']);

    if(!isset($_POST['usuario']) || !isset($_POST['contrasenia'])) {
    
    }else{
   
    $usuario     = $_POST["usuario"];
    $contrasenia = md5($_POST["contrasenia"]);
    
        if ($resultado = mysqli_query($link, "SELECT * from Usuarios where usuario='" . $usuario . "' and contrasenia='" . $contrasenia . "'")) {
            
            if (mysqli_num_rows($resultado) == 1) {
                $row = mysqli_fetch_assoc($resultado);
                
                if ($row['contrasenia'] == $contrasenia && $row['usuario'] == $usuario) {
                    session_start();
                    $_SESSION['usuario'] = $usuario;
                    header("Location: index.php");
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

<h1>Login</h1>

<form action="ingresar.php" method="post" enctype="multipart/form-data">
<p>
<label for="usuario">Nombre de usuario<br />
<input type="text" name="usuario" class="input" size="20" required /></label>
</p>
<p>
<label for="contrasenia">Contraseña<br />
<input type="password" name="contrasenia" class="input" size="20" required /></label>
</p>
<p class="submit">
<input type="submit" name="login" class="button" value="Entrar" />
</p>
<p id="error"><?php echo isset($_SESSION["error"]) ? $_SESSION["error"] : "";?>
<p class="regtext">No estas registrado? <a href="nuevoUsuario.php" >Registrate</a>!</p>
</form>


</div>
</div> <!-- Cierra el div del container -->

</body>
</html>