<?php

    require_once "../modelos/Venta.php";
    

    require_once "../MySQL/MySQLME.php";
    $jsonInsert='"user": "salvador", "date":"'.date('Y-m-d H:i:s').'", "secction": "index.php", "sql": "select * from usuarios" ';
    
    require_once "../MySQL/transactions.php";

    if(isset($_GET)){
        if(isset($_SESSION["id"])){
            $id =$_SESSION["id"];
            $mysql=new MySql();
            $ventas = $mysql->obteneridVentaUS($id);
            if($ventas == null){
                header("Location: ventas.php");
            }
    
        }
    
    }
    echo $_SESSION["id"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
</head>
<body>
    
    
    <!-- <td><a href ='borrarUsuario.php?id=".$usuario->getId()."&confirm=true' onclick=\"return confirm('¿Estás seguro de eliminar este usuario?');\">Borrar</a> </td>!-->
    <title>
   </title>
    <table class="table caption-top table-responsive-sm">
        <th>Nombre cliente</th>
        <th>Fecha de venta</th>
        <th>Ganancia</th>

        <th>Acciones</th>
    
   
    <tbody>
    <?php
    foreach ($ventas as $venta){
        echo "<tr>
            <td>".$venta->getNombrecliente()."</td>
            <td>".$venta->getFechaventa()."</td>
            <td>".$venta->getGanancia()."</td>

            
            </tr>";
    }
    



    ?>
    </tbody>
    </table>
    <a class="btn btn-primary" href="../proyecto.php">regresar</a>

</body>
</html>




