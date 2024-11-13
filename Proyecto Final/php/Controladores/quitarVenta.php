<?php
require_once "../../modelos/Venta.php";
require_once "../../MySQL/MySQLME.php";

    

if($_GET){
    if(isset($_GET["id"])){
        $venta = new Venta($_GET["id"],$_GET["id_usuario"],$_GET["nombre_cliente"],$_GET["fecha_venta"],$_GET["ganancia"]);
    $mysql = new MySQL();
    if($mysql->BorrarVenta($venta))
    header("location: http://localhost/SalvadorA/Proyecto%20final/php/ventas.php");
}else{
    echo "Invalida";

}
}

?>