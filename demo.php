<?php 

//BASADO EN JPEG, PARA USAR EN PNG, GIF ETC CAMBIAR EL NOMBRE DE LAS FUNCIONES

if (isset($_FILES['imagen1']) && $_FILES['imagen1']['tmp_name']!=''){

//Imagen original
$rtOriginal=$_FILES['imagen1']['tmp_name'];

//Crear variable
$original = imagecreatefromjpeg($rtOriginal);

//Ancho y alto máximo
$max_ancho = 600; $max_alto = 400;
 
//Medir la imagen
list($ancho,$alto)=getimagesize($rtOriginal);

//Ratio
$x_ratio = $max_ancho / $ancho;
$y_ratio = $max_alto / $alto;

//Proporciones
if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
    $ancho_final = $ancho;
    $alto_final = $alto;
}
else if(($x_ratio * $alto) < $max_alto){
    $alto_final = ceil($x_ratio * $alto);
    $ancho_final = $max_ancho;
}
else {
    $ancho_final = ceil($y_ratio * $ancho);
    $alto_final = $max_alto;
}

//Crear un lienzo
$lienzo=imagecreatetruecolor($ancho_final,$alto_final); 

//Copiar original en lienzo
imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
 
//Destruir la original
imagedestroy($original);

//Crear la imagen y guardar en directorio upload/
imagejpeg($lienzo,"Happy_".time().'.jpg');

}
if($_POST){ 
// Creamos la cadena aletoria 
$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; 
$cad = ""; 
for($i=0;$i<12;$i++) { 
$cad .= substr($str,rand(0,62),1); 
} 
// Fin de la creacion de la cadena aletoria 
$tamano = $_FILES [ 'file' ][ 'size' ]; // Leemos el tamaño del fichero 
$tamaño_max="50000000000"; // Tamaño maximo permitido 
if( $tamano < $tamaño_max){ // Comprovamos el tamaño  
$destino = 'uploaded' ; // Carpeta donde se guardata 
$sep=explode('image/',$_FILES["file"]["type"]); // Separamos image/ 
$tipo=$sep[1]; // Optenemos el tipo de imagen que es 
//if($tipo == "gif" || $tipo == "pjpeg" || $tipo == "bmp"){ // Si el tipo de imagen a subir es el mismo de los permitidos, segimos. Puedes agregar mas tipos de imagen 
move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], 'www.marsesweb.esy.es/content/uploads/background.jpg');  // Subimos el archivo 
    ?>
La imagen fue enviada con exito.<br><strong>Datos:</strong><br>
<ul>
  <li>Tipo <?=$tipo?></li>
  <li>Ubicasion http://www.midomini.com.ar/<?=$destino . '/' .$cad.'.'.$tipo?></li>
</ul><br>
<strong>Codigo HTML:</strong><br>
<textarea name="html" id="html"><img src="http://www.midomini.com.ar/<?=$destino.'/'.$cad.'.'.$tipo?>"><br>Por www.midomini.com.ar</textarea><br>
<img src="http://www.midomini.com.ar/<?=$destino.'/'.$cad.'.'.$tipo?>"> <?php // Incluimos la plantilla 
//} 
//else echo "el tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo desimos 
} 
else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo desimos 
} 
?>
<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Ejemplo formulario con array de inputs</title>
</head>
<body>
	<form action="demo_array_inputs.php" method="get">

		<input type="checkbox" name="como[]" id="como1" value="Web">
		<label for="como1">Una web</label>

		<input type="checkbox" name="como[]" id="como2" value="Google">
		<label for="como2">Google</label>

		<input type="checkbox" name="como[]" id="como3" value="Anuncio en prensa">
		<label for="como3">Anuncio en prensa</label>

		<input type="checkbox" name="como[]" id="como4" value="Anuncio en tv">
		<label for="como4">Anuncio en tv</label>

		<button type="submit">Enviar</button>

	</form>
	 <form action="" method="post" enctype="multipart/form-data">
 	<input type="file" name="imagen1">
 	<input type="submit" value="Subir">
 </form>
	<?php
	if ( !empty($_GET["como"]) && is_array($_GET["como"]) ) {
    	echo "<ul>";
		foreach ( $_GET["como"] as $como ) {
			echo "<li>";
			echo $como;
			echo "</li>";
		}
		echo "</ul>";
	}
	?>
	<script>
function ver(image){
document.getElementById('image').innerHTML = "<img src='"+image+"'>" 
}
</script>
<form action="" method="post" enctype="multipart/form-data"> 
    Archivo: <input name="file" type="file"  onChange="ver(form.file.value)"> 
    <input name="submit" type="submit" value="Upload!">  
</form><br> <span id="image"></span>
</body>
</html>