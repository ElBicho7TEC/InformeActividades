<?php include 'getInfo.php'; ?>
<html>
<head>
    <title>Usuarios Existentes</title>

    <?php include 'header.php'; ?>
</head>

<body>

<div class="header-bottom">
    <div class="container">
        <div class="row justify-content-center text-center text-md-left">
        </div>
    </div>
</div>

<div class="container mb-2">
    <h1 class="text-center">
        Actividad
    </h1>
    <b>Busqueda por dependencia:</b>
    <!--<div class="row-fluid">
        <div class="form-group text-center">
            <span>Dependencia:</span>
            <select  id="Dependencia" name="Dependencia" required="">
                <p></p>
                <?php
                include 'conexion.php';
                $datos = $conn->query('SELECT * FROM dependencia');
                while ($valores=$datos->fetch()) {
                    echo "'<option value= $valores[iddependencia]> $valores[nombredependencia] </option>'";
                }
                ?>
            </select>
        </div>-->
        <table>
            <tr>
                <td>
                    <strong>Folio</strong>
                </td>

                <td>
                    <strong>Fecha</strong>
                </td>

                <td>
                    <strong>Plan de Desarrollo</strong>
                </td>

                <td>
                    <strong>Elaboró</strong>
                </td>
                <td>
                    <strong>Dependencia</strong>
                </td>
            </tr>


            <?php
            include("conexion.php");

            $cadena='select i.idInforme, i.fecha, p.nombreplandesarrollo, CONCAT(u.nombre, \' \', u.apellidopaterno) as nombrecompleto, d.nombredependencia from informe i, usuarios u, plandesarrollo p, dependencia d where u.idusuario=i.idusuario and p.idplandesarrollo=i.idplandesarrollo and u.iddependencia=d.iddependencia ORDER BY i.idInforme DESC;';
            $gsent = $conn->prepare($cadena);
            $gsent->execute();
            while ($resultado = $gsent->fetch(PDO::FETCH_ASSOC))
            {
                $Folio=$resultado['idInforme'];
                $Fecha=$resultado['fecha'];
                $Plan=$resultado['nombreplandesarrollo'];
                $Elaboro=$resultado['nombrecompleto'];
                $Dependencia=$resultado['nombredependencia'];
                ?>

                <tr>
                    <td>
                        <?php  echo   $Folio ?>
                    </td>
                    <td>
                        <?php  echo   $Fecha ?>
                    </td>
                    <td>
                        <?php  echo   $Plan ?>
                    </td>
                    <td>
                        <?php echo $Elaboro ?>
                    </td>
                    <td>
                        <?php echo $Dependencia ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
<div class="container">
    <div class="footer" style="color:#fff; background:#34495E;">
        <p style="text-align: center;">
            © 2019 Copyright: Ahuacatlán, Nayarit.
        </p>
    </div>
</div>
</body>
</html>