<?php
include_once "./includes/header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Insertar Usuario</title>
</head>
<body>
<h3 class="text-center">Crear Usuario</h3>

<form action="./Controladores/insertarUsuario.php" method="post">
<div class="container">
        <div class="row">
            <div class="col-3">
                <label for="">Nombre</label>
                <input type="text" name="nombre" id="" class="form-control" required>
                </div>
            <div class="col-3">
    <label for="">Correo</label>
    <input type="email" name="correo" id="" class="form-control" required>
    </div>
            <div class="col-3">
    <label for="">contraseña</label>
    <input type="password" name="contraseña" id="" class="form-control" required>
    </div>
            <div class="col-3">
            <label for="">Rol</label>
                <select class="form-control" name="rol" id="" required>
                <option  selected disabled >Rol</option>

                    <option value="Administrador">Administrador</option>
                    <option value="Usuario">Usuario</option>
                </select>
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