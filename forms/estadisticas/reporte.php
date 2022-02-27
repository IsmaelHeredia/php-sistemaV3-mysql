<?php  

while (! file_exists("functions") ) {
    chdir("..");
}

include_once("functions/Helper.php");

$helper = new Helper();

$helper->verificar_usuario_logeado();

echo "<center><h3>Reporte Estadístico</h3></center></br>";

include_once("listado.php");
echo "<br/>";
include_once("grafico1.php");
echo "<br/>";
include_once("grafico2.php");
		    
?>