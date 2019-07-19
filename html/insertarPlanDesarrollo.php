
 <html>
	<head>
		<title>
			Plan Desarrollo
		</title>
	</head> 
  
	<body>
		<header>
			
		</header>
		<form action =".php" method="post" align="center" >	
			<h2> Insertar Plan Desarrollo</h2>
	 		<div>
	 			<div>
		 		Actividad:
		 		<input type="text" maxlength="45" id ="nombre_PlanDesarrollo" name="nombre_PlanDesarrollo">
		 	    </div>
		 	    <br>
		 	    <div>
		 		Descripci&oacute;n:
		 		<input type="text"  maxlength="45" id="descripcion_PlanDesarrollo"name="descripcion_PlanDesarrollo">
		 		<!-- por si se necesita despues el estatus
		 		Estatus:
		 		<input type="text" value="En progreso" maxlength="45" id="estatus_PlanDesarrollo"name="estatus_PlanDesarrollo"> -->
		 		</div>
		 	    <br>
		 	    <div>
		 		FechaProgramada:
		 		<input type="date"  maxlength="50" id="fecha_PlanDesarrollo" name="fecha_PlanDesarrollo" min="2019-01-01" max="2022-01-01" step="2">
		 		 <!-- esto lo puse las fechas para que se vean mas presentables, solo hay que modificar el max y min -->
		 		</div>
		 	    <br>
		 	    <div>
		 	     Dependecia:
		 		<input type="text"  maxlength="50" id="dependencia_PlanDesarrollo" name="dependencia_PlanDesarrollo">
		 		<!-- tambien la dependencia la conectas con la cadena de sql  -->
		 	    </div>
			</div>
			<input type="submit" value="Guardar">	
	</form>
	</body>	
 </html>