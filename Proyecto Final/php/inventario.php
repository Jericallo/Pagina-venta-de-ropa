<?php
include_once "./includes/header.php";

    require_once "../modelos/Ropa.php";
    
    require_once "../MySQL/MySQLME.php";
    
    if($_POST){
 
     if(isset($_POST["DB"]) ){
         $_SESSION["DB"] = $_POST["DB"];
    }
 }
 if(isset($_SESSION['DB'])){
    $db=$_SESSION['DB'];

}else{  $db="Mexico";}
    $mysql = new MySql();
 
    $ropas = $mysql->obtenerRopa();

    include_once "./includes/navbar.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de ropas</title>
</head>
<style>
    img{
        width: 250px;
        height: 150px;
    }
</style>
<body>
    <?php
if(count($ropas)){
    

    ?>
    <!-- <td><a href ='borrarUsuario.php?id=".$usuario->getId()."&confirm=true' onclick=\"return confirm('¿Estás seguro de eliminar este usuario?');\">Borrar</a> </td>!-->
    <title>
   </title>
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
        <th>Imagen</th>
        

        <th>Acciones</th>
    
   
    <tbody>
    <?php
foreach ($ropas as $ropa){
    $targerdir = "./images/Files_".$_SESSION["DB"]."/".$ropa->getImagen(); //carpeta de destino de archivo
    ?>
    <br>
    <?php
    echo "<tr>
            <td>".$ropa->getId()."</td>
            <td>".$ropa->getTipodeprenda()."</td>
            <td>".$ropa->getGenero()."</td>
            <td>".$ropa->getTalla()."</td>
            <td>".$ropa->getColor()."</td>
            <td>".$ropa->getPrecio()."</td>
            <td>".$ropa->getStock()."</td>
            <td>".$ropa->getFechadeentrada()."</td>
            <td>".$ropa->getProveedor()."</td>
            <td>".$ropa->getDetalles()."</td>
            <td><img src='".$targerdir."' alt='hols'></td>
        

            <td><a class='btn btn-warning' href ='./actualizaralmacen.php?id=".$ropa->getId()."' >Actualizar</a></td>
            <td><a class='btn btn-danger' type='button' href ='./Controladores/quitarRopa.php?id=".$ropa->getId()."&confirm=true' onclick=\"return confirm('¿Estás seguro de eliminar este inventario?');\">Borrar</a> </td>  
            <td><a class='btn btn-warning' href ='./verinventario.php?id=".$ropa->getId()."' >ver</a></td>
          
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
    
    <a class="btn btn-success" href="./forminsertarRopa.php">Crear</a>
    <a class="btn btn-primary" href="../cerrarseccion.php">Salir seccion</a>
   
</body>
</html>




