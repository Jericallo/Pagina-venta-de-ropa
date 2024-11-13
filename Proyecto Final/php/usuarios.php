<?php
include_once "./includes/header.php";

    require_once "../modelos/Usuario.php";
    

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
 
    $usuarios = $mysql->obtenerUsuarios();

    include_once "./includes/navbar.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <?php
if(count($usuarios)){
    

    ?>
    <!-- <td><a href ='borrarUsuario.php?id=".$usuario->getId()."&confirm=true' onclick=\"return confirm('¿Estás seguro de eliminar este usuario?');\">Borrar</a> </td>!-->
    <title>
   </title>
    <table class="table caption-top table-responsive-sm">
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Contra</th>
        <th>Rol</th>

        <th>Acciones</th>
    
   
    <tbody>
    <?php
foreach ($usuarios as $usuario){
    echo "<tr>
            <td>".$usuario->getId()."</td>
            <td>".$usuario->getNombre()."</td>
            <td>".$usuario->getCorreo()."</td>
            <td>".$usuario->getContra()."</td>
            <td>".$usuario->getRol()."</td>

            <td><a class='btn btn-warning' href ='./actualizarusuario.php?id=".$usuario->getId()."' >Actualizar</a></td>
            <td><a class='btn btn-danger' type='button' href ='./Controladores/quitarUsuario.php?id=".$usuario->getId()."&confirm=true' onclick=\"return confirm('¿Estás seguro de eliminar este usuario?');\">Borrar</a> </td>  
            <td><a class='btn btn-warning' href ='./verusuario.php?id=".$usuario->getId()."' >ver</a></td>
          
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
    
    <a class="btn btn-success" href="./forminsertarUsuario.php">Crear</a>
    <a class="btn btn-primary" href="../cerrarseccion.php">Salir seccion</a>
    <a class="btn btn-primary" href="./reporte.php">reporte</a>

</body>
</html>




