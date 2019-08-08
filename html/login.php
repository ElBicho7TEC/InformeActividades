<?php $hastaAqui=1?>
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<?php include 'header.php' ?>
</div>
<?php
     if (isset($_GET["error"]))
     {
      $idError=$_GET["error"];
     if ($idError==2)
     { //Caso de mal password
?>
 <div class="container">
     <div class="alert alert-danger" role="alert">
         <p>Por favor revise que su correo y contraseña sean correctos</p>
     </div>
 </div>
    <?php
  }
    else if ($idError==1) { //Caso de correo inexistente
    ?>
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <p>El usuario ingresado no existe. Revisa tu correo porfavor</p>
        </div>
    </div>
    <?php }
    else if ($idError==3) { //Redirigido
        ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <p>Inicia sesión antes de poder visitar esta página.</p>
            </div>
        </div>
    <?php }
     } ?>

<div class="container" id="maindiv">
  <div class="row justify-content-center text-center text-md-left">
	  <div class="col-12 col-md-4 mt-4 mt-md-0">
	      <form class="Myformulario" action="verificarLogin.php" method="post" enctype="multipart/form-data">
	          <div class="col-12 form-group">
	              <label>Correo</label>
	              <input
                  type="text"
                  id="correo"
                  name="correo"
                  value=""
                  maxlength="73"
                  pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"
                  required=""
                  style="background-color: white;
                        color: black;
                        font-weight: bold;
                        text-decoration: none;
                        padding: 7px;
                        font-size: 15px;
                        border-radius: 8px;
                        border: 2px solid #211A1A;
                        height: 39px;
                        font-family: Cambria;"
                  placeholder="&#128231; ejemplo@x.com"
                  size="20">
	          </div>
	          <div class="col-12   form-group">
	              <label>Password</label>
	              <input
                  type="password"
                  id="pass"
                  name="pass"
                  value=""
                  maxlength="73"
                  required=""
                  style="background-color: white;
                        color: black;
                        font-weight: bold;
                        text-decoration: none;
                        padding: 7px;
                        font-size: 15px;
                        border-radius: 8px;
                        border: 2px solid #211A1A;
                        height: 39px;
                        font-family: Cambria;"
                  placeholder="&#128272;  ******"
                  size="20">

                  <div class="col-12   form-group">
                      <label>Mantener sesión iniciada:</label><br>
                      <input type="radio" name="mantener" value="si">Sí<br>
                      <input type="radio" name="mantener" value="no" checked="checked">No<br>
                  </div>
	          <div class="col-12   form-group ">
	              <input type="submit"  id="entrar" name="entrar" value="Entrar">
	          </div>
	     </form>
	  </div>
	</div>
<?php include 'footer.php' ?>
