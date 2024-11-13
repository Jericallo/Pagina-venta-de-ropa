<?php
include_once "./includes/header.php";

require_once "../modelos/Venta.php";
require_once "../MySQL/MySQLME.php";

if(isset($_GET)){
    if(isset($_GET["id"])){
        $id =$_GET["id"];
        $mysql=new MySql();
        $venta = $mysql->obteneridVenta($id);
        if($venta == null){
            header("Location: ventas.php");
        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ver</title>
</head>
<body>
    
    <!-- <td><a href ='borrarUsuario.php?id=".$usuario->getId()."&confirm=true' onclick=\"return confirm('¿Estás seguro de eliminar este usuario?');\">Borrar</a> </td>!-->

    <table class="table caption-top table-responsive-sm">
    <th>ID Venta</th>
        <th>ID de usuario</th>
        <th>Nombre cliente</th>
        <th>Fecha de venta</th>
        <th>Ganancia</th>


    
   
    <tbody>
    
    <?php
            echo "<tr>
            <td>". $id."</td>
            <td>".$venta->getIdusuario()."</td>
            <td>".$venta->getNombrecliente()."</td>
            <td>".$venta->getFechaventa()."</td>
            <td>".$venta->getGanancia()."</td>
            </tr>"; 

        ?>
    </tbody>
    </table>
    <a class="btn btn-primary" href="ventas.php">regresar</a>

    
    
    
</body>
</html>




