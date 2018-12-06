<?php
include('conexion.php');

if(isset($_REQUEST['id']) && !empty($_REQUEST['id'])){

	$id = $_REQUEST['id'];

	if ($resultado = mysqli_query($link, "DELETE from Productos where id = ".$id))
		{
			echo "<script>
              alert('Imagen borrada con éxito');
              window.location= '../html/borrarImagenes.html'
      			  </script>";
		}
		else
		{
			print "Fallo la consulta: ". mysqli_error($link);
			die;
		}
		
		echo json_encode($arr);
		mysqli_close($link);
}

?>
