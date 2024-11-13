<?php
include_once "./includes/header.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Insertar Inventario</title>
    
</head>
<body>
<h3 class="text-center">Agregar Inventario</h3>

<form action="./Controladores/insertarRopa.php" method="post" enctype="multipart/form-data">
<div class="container">
        <div class="row">
            <div class="col-3">
                <label for="">Tipo de prenda</label>
                <input type="text" name="Tipo_de_prenda" id="" class="form-control" required>
            </div>
            <div class="col-3">
            <label for="">Genero</label>
                <select class="form-control" name="Genero" id="" required>
                <option  selected disabled >Genero</option>

                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Niño">Niño</option>
                    <option value="Niña">Niña</option>
                </select>
                
            </div>
            <div class="col-3">
                <label for="">Talla</label>
                <input type="text" name="Talla" id="" class="form-control" required>
            </div>
            <div class="col-3">
                <label for="">Color</label>
                <input type="text" name="Color" id="" class="form-control" required>
            </div>
            <div class="col-3">
                <label for="">Precio</label>
                <input type="number" name="Precio" id="" class="form-control" required>
            </div>
            <div class="col-3">
                <label for="">Stock</label>
                <input type="number" name="Stock" step="1" id="" class="form-control" required>
            </div>
            <div class="col-3">
                <label for="">Fecha_de_entrada</label>
                <input type="date" name="Fecha_de_entrada" id="" class="form-control" required>
            </div>
            <div class="col-3">
                <label for="">Proveedor</label>
                <input type="text" name="Proveedor" id="" class="form-control" required>
             </div>
             <div class="col-3">
                <label for="">Detalles</label>
                <input type="text" name="Detalles" id="" class="form-control" required>
             </div>

             <div class="col-3">

             <label for="precio">Imagen:</label>

            <input type="file" name="imagen" id="imagen"required>
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