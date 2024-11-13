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

    <title>Actualizar Usuario</title>
</head>
<body>

<form action="./Controladores/cambioUsuario.php" method="post">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

<div class="container">
        <div class="row">
            <div class="col-3">
    <label for="">Nombre</label>
    <input type="text" class="form-control" name="nombre" id="" value="<?php echo $usuario->getNombre(); ?>">
    </div>
            <div class="col-3">
    <label for="">Correo</label>
    <input type="email" class="form-control" name="correo" id="" value="<?php echo $usuario->getCorreo(); ?>">
    </div>
            <div class="col-3">
    
    <label for="">contraseña</label>
    <input type="password" class="form-control" name="contraseña" id="" value="<?php echo $usuario->getContra(); ?>">
    </div>
            <div class="col-3">
    <label for="">Tipo de usuario</label>
    <select class="form-control" name="rol" id="" required >
        <option value="Administrador">Administrador</option>
        <option value="Usuario">Usuario</option>
    </select>
    </div>
            <div class="col-3">
            <button class="btn btn-success" type="sumbit">Guardar</button>
            <a class="btn btn-primary" href="usuarios.php">regresar</a>

    </div>
        </div>
    </div>

    


</form>
    
</body>
</html>