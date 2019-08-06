<?php
require './vendor/autoload.php';
 
use Spipu\Html2Pdf\Html2Pdf; 
if(isset($_POST['crear'])){
//Recoger contenido del oro fichero
ob_start();
require_once 'print_view.php'; 
$html=ob_get_clean();
$html2pdf = new Html2Pdf('P','carta','es','true','utf-8');
$html2pdf->writeHTML($html);
$html2pdf->output('informe.pdf');
}
?>
<form action="" method="POST">
	<input type="text" name="titulo" placeholder="Título del pdf"/>
	<input type="submit" name="crear" value="Crear un PDF"/>
</form>