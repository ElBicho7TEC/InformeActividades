<?php
try{
    $conn = new PDO('mysql:host=ahuacatlan.serviciosmunicipales.com.mx; dbname=servi301_gestion_plan_desarrollo; chartset=gbk',  "servi301_root", "msBKy#@,SZ{1");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}
?>
