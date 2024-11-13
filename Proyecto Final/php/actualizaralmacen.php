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
            header("Location: inventario.php");
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

<form action="./Controladores/cambioRopa.php" method="post">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
<input type="hidden" name="Imagen" value="<?php echo $ropa->getImagen(); ?>">

    
<div class="container">
        <div class="row">
            <div class="col-3">
                <label for="">Tipo de prenda</label>
                <input type="text" name="Tipo_de_prenda" id="" class="form-control" value="<?php echo $ropa->getTipodeprenda(); ?>">
            </div>
            <div class="col-3">
            <label for="">Genero</label>
                <select class="form-control" name="Genero" id="" required >
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Niño">Niño</option>
                    <option value="Niña">Niña</option>
                </select>
                
            </div>
            <div class="col-3">
                <label for="">Talla</label>
                <input type="text" name="Talla" id="" class="form-control"value="<?php echo $ropa->getTalla(); ?>">
            </div>
            <div class="col-3">
                <label for="">Color</label>
                <input type="text" name="Color" id="" class="form-control"value="<?php echo $ropa->getColor(); ?>">
            </div>
            <div class="col-3">
                <label for="">Precio</label>
                <input type="number" name="Precio" id="" class="form-control"value="<?php echo $ropa->getPrecio(); ?>">
            </div>
            <div class="col-3">
                <label for="">Stock</label>
                <input type="number" name="Stock" step="1" id="" class="form-control"value="<?php echo $ropa->getStock(); ?>">
            </div>
            <div class="col-3">
                <label for="">Fecha_de_entrada</label>
                <input type="date" name="Fecha_de_entrada" id="" class="form-control"value="<?php echo $ropa->getFechadeentrada(); ?>">
            </div>
            <div class="col-3">
                <label for="">Proveedor</label>
                <input type="text" name="Proveedor" id="" class="form-control"value="<?php echo $ropa->getProveedor(); ?>">
             </div>
             <div class="col-3">
                <label for="">Detalles</label>
                <input type="text" name="Detalles" id="" class="form-control"value="<?php echo $ropa->getDetalles(); ?>">
             </div>
             <div class="col-3">
                <button class="btn btn-success" type="sumbit">Guardar</button>
                <a class="btn btn-primary" href="inventario.php">regresar</a>

            </div>

        </div>
    </div>
    

    


</form>
    


   



</body>
</html>