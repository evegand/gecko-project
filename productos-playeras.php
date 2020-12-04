<?php
if(!isset($_SESSION)) 
    session_start(); 

$origen = $_SERVER['PHP_SELF'];
?>

<!DOCTYPE HTML>
<html>
    
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
	<title>Ideas Gecko</title>
    
    <!-----------------CSS (estilos)----------------------------->
    <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">              <!--Bootstrap------------>
	<link href="CSS/Icons/fontello-e1be2622/css/fontello.css" rel="stylesheet"> <!--Íconos del footer---->
	<link href="CSS/productos.css" rel="stylesheet">                            <!--Estilos productos---->
	<!--------------Javascript (scripts)------------------------->
	<script type="text/javascript" src="JS/nav.js"></script>

</head>
<body>
	<!------------------------------------- Barra de navegación --------------------------------------------------------->
	<?php include 'menu.php'; ?>
	<!------------------------------------------------------------------------------------------------------------------->

	<!-- --------------------------Contenido----------------------------------------------------------------------------------------------------------------------------------------->
		<div style="height: 64px"></div>
		<h1>Playeras</h1>
		<div class="contenido">
			<a href="productos.php" class="btn btn-dark" style="width: 92%;">Ver otro tipo de productos</a>
		<br>

			<?php
			include("config/db.php");//Contienen las variables, el servidor, usuario, contraseña y nombre  de la base de datos
			include("config/conexion.php");//Contiene de conexion a la base de datos
			
			$consulta= "SELECT * FROM productos WHERE id_categoriaf = 1"; 
			$resultado= mysqli_query($conexion,$consulta) ;

			while($fila = mysqli_fetch_assoc($resultado)){   //Creates a loop to loop through results
				$nombre_producto =  $fila['nombre_producto'];
				$prodJSON = array('id' => $fila['id_producto'],'nombre' => $nombre_producto .' (M)', 'precio' => $fila['precio'], 'detalle' => 'M' , 'imagen' => $fila['imagen'] . ".jpg", 'cantidad' => 1);
		   		echo "<div class='producto pb-3'>
						<p class='add-cart cart' >
							<a onclick='agregarProducto(" . json_encode($prodJSON) . ")'>Añadir al Carrito</a><br>";
							$prodJSON['detalle'] = 'CH';
							$prodJSON['nombre'] = $nombre_producto .' (CH)';
				echo		"<button class='btn btn-secondary btn-sm' onclick='agregarProducto(" . json_encode($prodJSON) . ")'>CH</button>";
							$prodJSON['detalle'] = 'M';
							$prodJSON['nombre'] = $nombre_producto .' (M)';
				echo		"<button class='btn btn-secondary btn-sm' onclick='agregarProducto(" . json_encode($prodJSON) . ")'>M</button>";
							$prodJSON['detalle'] = 'G';
							$prodJSON['nombre'] = $nombre_producto .' (G)';
				echo		"<button class='btn btn-secondary btn-sm' onclick='agregarProducto(" . json_encode($prodJSON) . ")'>G</button>";
				echo	"</p>
						<img class='imgPr' alt='Imagen del producto' src='Images/Productos/" . $fila['imagen'] . ".jpg'>
						<div class='pie-producto'>
							<h2 class='productName'>" . $fila['nombre_producto'] . "</h2>
							<label class='productPrice'>$" . $fila['precio'] . ".00</label>
							<form action='pagina-producto.php' method='GET'>
								<input type='text' name='prod_id' hidden='true' value='".$fila['id_producto']."'>
								<input type='text' name='origen'  hidden='true' value='".$origen."'>
								<input type='submit' name='submit' value='Ver producto' style='background-color: #C4FF33' class='btn btn-sm'>
							</form>
						</div>
					  </div>";
					  

					  //echo json_encode(array('id' => $fila['id_producto'],'nombre' => $fila['nombre_producto'],'precio' => $fila['precio'],'imagen' => $fila['id_producto'] . "jpg"));
					}
				?>
		<br>

		</div>

<script type="text/javascript" src="JS/carrito.js"></script>
</body>
</html>

