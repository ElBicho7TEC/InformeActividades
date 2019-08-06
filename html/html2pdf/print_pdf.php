<?php
require './vendor/autoload.php';//Se indica la dirección donde se encuentra instalada la libreria html2pdf
 
use Spipu\Html2Pdf\Html2Pdf; //Se hace uso de la libreria
if(isset($_POST['crear'])){//Prueba del envio del formulario de abajo, si se envia por medio del boton crear se genera el pdf
//Recoger contenido del otro fichero
ob_start();
require_once 'print_view.php'; 
$html=ob_get_clean();
$html2pdf = new Html2Pdf('P','carta','es','true','utf-8');//Se indica el tamaño, el idioma y el grupo de caracteres del pdf
$html2pdf->writeHTML($html);//Se imprime la variable que contiene la vista html del archivo print_view.php
$html2pdf->output('informe.pdf');//Se indica el nombre con el que se guardará por defecto si se quiere descargar el pdf
}
?>
<form action="" method="POST"><!--formulario para enviar el título, solo es una prueba -->
	<input type="text" name="titulo" placeholder="Título del pdf"/>
	<input type="submit" name="crear" value="Crear un PDF"/>
</form>