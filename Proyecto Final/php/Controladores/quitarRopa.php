<?php
require_once "../../modelos/Ropa.php";
require_once "../../MySQL/MySQLME.php";

    

if($_GET){
    if(isset($_GET["id"])){
       // $ropa = new Ropa($_GET["id"],$_GET["Tipo_de_prenda"],$_GET["Genero"],$_GET["Talla"],$_GET["Color"],$_GET["Stock"],$_GET["Precio"],$_GET["Fecha_de_entrada"],$_GET["Proveedor"],$_GET["Detalles"],$_GET["Imagen"]);
    $mysql = new MySQL();
    $imagenlink=$mysql->obteneridRopa($_GET["id"]);
    
    if($mysql->BorrarRopa($_GET["id"])){
        $targerdir = "../images/Files_".$_SESSION["DB"]."/".$imagenlink->getImagen(); //carpeta de destino de archivo
        echo $targerdir;

        unlink($targerdir);
            header("location: http://localhost/SalvadorA/Proyecto%20final/php/inventario.php");

    }
}else{
    echo "Invalida";

}
}

?>