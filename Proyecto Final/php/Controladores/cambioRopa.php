<?php
require_once "../../modelos/Ropa.php";
require_once "../../MySQL/MySQLME.php";

    

if($_POST){
    if(isset($_POST["Tipo_de_prenda"]) && isset($_POST["Genero"]) && isset($_POST["Talla"]) && isset($_POST["Color"])  && isset($_POST["Precio"]) && isset($_POST["Stock"]) && isset($_POST["Fecha_de_entrada"]) && isset($_POST["Proveedor"]) && isset($_POST["Detalles"])){
        $ropa = new Ropa($_POST["id"], $_POST["Tipo_de_prenda"], $_POST["Genero"], $_POST["Talla"], $_POST["Color"], $_POST["Precio"], $_POST["Stock"], $_POST["Fecha_de_entrada"], $_POST["Proveedor"], $_POST["Detalles"], $_POST["Imagen"]);
    $mysql = new MySQL();
    if($mysql->actualizarRopa($ropa))
    header("location: http://localhost/SalvadorA/Proyecto%20final/php/inventario.php");
}else{
    echo "Invalida";

}
}

?>