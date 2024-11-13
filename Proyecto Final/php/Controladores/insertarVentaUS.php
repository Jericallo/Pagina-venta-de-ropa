<?php
require_once "../../modelos/Usuario.php";
require_once "../../modelos/Venta.php";

require_once "../../MySQL/MySQLME.php";



if($_POST){
    if(isset($_POST["id_usuario"]) && isset($_POST["nombre"]) &&  isset($_POST["fecha_venta"]) && isset($_POST["ganancia"])){
        $venta = new Venta(0,$_POST["id_usuario"],$_POST["nombre"],$_POST["fecha_venta"],$_POST["ganancia"]);
    $mysql = new MySQL();

    echo "<script>alert('Pago con exito.');</script>";

           

            if($mysql->insertarVenta($venta)){

                header("location: http://localhost/SalvadorA/Proyecto%20final/proyecto.php");
        
            }else {

                echo "<script>alert('Algo salio mal.');</script>";
                echo "<script>window.location.href = 'http://localhost/SalvadorA/Proyecto%20final/pago.php';</script>";
            }
    

    
    
    
    
}else{
    echo "Invalida";
    echo $_SESSION["id"];
}
}


?>

