<?php
try{
    $conn = new PDO('mysql:host=localhost; dbname=servi301_gestion_plan_desarrollo; chartset=gbk',  "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}
?>
