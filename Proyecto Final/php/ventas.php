<?php
include_once "./includes/header.php";

    require_once "../modelos/Venta.php";
    

    require_once "../MySQL/MySQLME.php";
    $jsonInsert='"user": "salvador", "date":"'.date('Y-m-d H:i:s').'", "secction": "index.php", "sql": "select * from usuarios" ';
    
    require_once "../MySQL/transactions.php";

    
    if($_POST){
 
     if(isset($_POST["DB"]) ){
         $_SESSION["DB"] = $_POST["DB"];
    }
 }
 if(isset($_SESSION['DB'])){
    $db=$_SESSION['DB'];

}else{  $db="Mexico";}
    $mysql = new MySql();
 
    $ventas = $mysql->obtenerVentas();

    include_once "./includes/navbar.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
</head>
<body>
    <?php
if(count($ventas)){
    

    ?>
    <!-- <td><a href ='borrarUsuario.php?id=".$usuario->getId()."&confirm=true' onclick=\"return confirm('¿Estás seguro de eliminar este usuario?');\">Borrar</a> </td>!-->
    <title>
   </title>
    <table class="table caption-top table-responsive-sm">
        <th>ID Venta</th>
        <th>ID de usuario</th>
        <th>Nombre cliente</th>
        <th>Fecha de venta</th>
        <th>Ganancia</th>

        <th>Acciones</th>
    
   
    <tbody>
    <?php
foreach ($ventas as $venta){
    echo "<tr>
            <td>".$venta->getIdventa()."</td>
            <td>".$venta->getIdusuario()."</td>
            <td>".$venta->getNombrecliente()."</td>
            <td>".$venta->getFechaventa()."</td>
            <td>".$venta->getGanancia()."</td>

            <td><a class='btn btn-danger' type='button' href ='./Controladores/quitarVenta.php?id=".$venta->getIdventa()."&confirm=true' onclick=\"return confirm('¿Estás seguro de eliminar esta venta?');\">Borrar</a> </td>  
            <td><a class='btn btn-warning' href ='./verventa.php?id=".$venta->getIdventa()."' >ver</a></td>
          
            </tr>";

}

    ?>
    </tbody>
    </table>
    <?php
    }else{
    ?>
    <label for="">No hay registro</label>
    <?php
    }
    ?>
    
    <a class="btn btn-success" href="./forminsertarVenta.php">Crear</a>
    <a class="btn btn-primary" href="../cerrarseccion.php">Salir seccion</a>
   
</body>
</html>




