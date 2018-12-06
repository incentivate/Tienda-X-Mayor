<?php

include("conexion.php");

if(!isset($_POST["nombreImagen"]) || !isset($_FILES["imagenes"]["error"]) || !isset($_POST["precioImagen"]))
  {
	// NO SE PORQUE ROMPE SI ESCRIBO ACÁ UN ECHO ... 
  }
else
{

	$extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
	$max_tamanio = 1024 * 1024 * 8;

	$fichero_origen = $_FILES['imagenes']['tmp_name'];
	$fichero_destino = '../imagenes/'.$_FILES['imagenes']['name'];
	
	// Valida si es una imagen y su extension
	if ( in_array($_FILES['imagenes']['type'], $extensiones) ) {

    // Validacion del tamaño de la imagen 
	if ($_FILES['imagenes']['size']< $max_tamanio) {
          
		//Si la imagen fue subida con POST, la muevo de la carpeta temporal a mi servidor
		 if(is_uploaded_file($fichero_origen)){
			 if(move_uploaded_file($fichero_origen, $fichero_destino))
			 {
				
			 }
			 else echo "Error al guardar la imagen seleccionada";
		 }
     }
	}

	$imagen = $fichero_destino;
	$nombre = $_POST["nombreImagen"];
	$precio = intval($_POST["precioImagen"]);

	
	if ($resultado = mysqli_query($link, "insert into Productos (Imagen, Nombre, Precio) values ('$imagen', '$nombre', $precio)"))
	{
        echo "<script>
              alert('Imagen subida con éxito');
              window.location= '../html/admin.html';
      		 </script>";
	}
	else
	{
    	print "Fallo la consulta: ". mysqli_error($link);
    	die;
	}
 }

//-----------------------------------------------------------------------
// RESPUESTA EN JSON DESDE LA BASE DE DATOS

	if ($resultado = mysqli_query($link, "select * from Productos"))
	{
    	while ($fila = mysqli_fetch_assoc($resultado))
		
		$arr[] = array('id' 	=> $fila['id'],
					   'Imagen' => $fila['Imagen'],
					   'Nombre' => $fila['Nombre'],
					   'Precio' => $fila['Precio']);

    	mysqli_free_result($resultado);
	}
	else
	{
    	print "Fallo la consulta: ". mysqli_error($link);
    	die;
	}

	echo json_encode($arr);

	mysqli_close($link);

?>