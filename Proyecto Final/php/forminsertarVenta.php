<?php
include_once "./includes/header.php";
require_once "../modelos/Usuario.php";
require_once "../MySQL/MySQLME.php";
$mysql = new MySql();
 
$usuarios = $mysql->obtenerUsuarios();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Insertar Venta</title>
</head>
<body>
<h3 class="text-center">Crear Venta</h3>

<form action="./Controladores/insertarVenta.php" method="post">
<div class="container">
        <div class="row">
            <div class="col-3">
                <label for="">ID usuario</label>
                <select class="form-control" name="id_usuario" id="" required>
                    <option  selected disabled >ID usuario</option>
                    <?php
foreach ($usuarios as $usuario){
    if(($usuario->getRol()) == "Usuario"){
echo "     

            <option value='".$usuario->getId()."'>ID: ".$usuario->getId()." nombre: ".$usuario->getNombre()."</option>
            ";

            }

           

    }
    
    ?>
    
                </select>                
            </div>
           
            <div class="col-3">
    <label for="">Fecha de venta</label>
    <input type="date" name="fecha_venta" id="" class="form-control"required>
    </div>
    <div class="col-3">
    <label for="">Ganancias</label>
    <input type="number" name="ganancia" id="" class="form-control" required>
    </div>
           
            <div class="col-3">
                <button class="btn btn-success" type="sumbit">Guardar</button>
                <button class="btn btn-danger" type="button" onclick="window.history.back()">Regresar</button>

            </div>
            
    </div>
    </div>


</form>
    
</body>
</html>