<?php
include_once "./includes/header.php";

require_once "../modelos/Ropa.php";
require_once "../MySQL/MySQLME.php";


if(isset($_GET)){
    if(isset($_GET["id"])){
        $id =$_GET["id"];
        $mysql=new MySql();
        $ropa = $mysql->obteneridRopa($id);
        if($ropa == null){
            header("Location: ropas.php");
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
            <th>ID</th>
        <th>Tipo de prenda</th>
        <th>Genero</th>
        <th>Talla</th>
        <th>Color</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Fecha de entrada</th>
        <th>Proveedor</th>
        <th>Detalles</th>

    
   
    <tbody>
    
    <?php
            echo "<tr>
            <td>". $id."</td>
            <td>".$ropa->getTipodeprenda()."</td>
            <td>".$ropa->getGenero()."</td>
            <td>".$ropa->getTalla()."</td>
            <td>".$ropa->getColor()."</td>
            <td>".$ropa->getPrecio()."</td>
            <td>".$ropa->getStock()."</td>
            <td>".$ropa->getFechadeentrada()."</td>
            <td>".$ropa->getProveedor()."</td>
            <td>".$ropa->getDetalles()."</td>
            </tr>"; 

        ?>
    </tbody>
    </table>
    <a class="btn btn-primary" href="inventario.php">regresar</a>

    
    
    
</body>
</html>




