<?php
include_once "./includes/header.php";

require_once "../modelos/Usuario.php";
require_once "../MySQL/MySQLME.php";

if(isset($_GET)){
    if(isset($_GET["id"])){
        $id =$_GET["id"];
        $mysql=new MySql();
        $usuario = $mysql->obteneridUsuarios($id);
        if($usuario == null){
            header("Location: usuarios.php");
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
        <th>Nombre</th>
        <th>Correo</th>
        <th>Contra</th>
        <th>Rol</th>

    
   
    <tbody>
    
    <?php
            echo "<tr>
            <td>". $id."</td>
            <td>".$usuario->getNombre()."</td>
            <td>".$usuario->getCorreo()."</td>
            <td>".$usuario->getContra()."</td>
            <td>".$usuario->getRol()."</td>
            </tr>"; 

        ?>
    </tbody>
    </table>
    <a class="btn btn-primary" href="usuarios.php">regresar</a>

    
    
    
</body>
</html>




