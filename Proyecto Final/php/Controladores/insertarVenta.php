<?php
require_once "../../modelos/Usuario.php";
require_once "../../modelos/Venta.php";

require_once "../../MySQL/MySQLME.php";

if(isset($_POST)){
    if(isset($_POST["id_usuario"])){
        $id =$_POST["id_usuario"];

        $mysql=new MySql();
        $usuario = $mysql->obteneridUsuarios($id);

        if($usuario == null){
            header("Location: ../forminsertarVenta.php ");
        }

    }

}

echo $usuario->getNombre();
if($_POST){
    if(isset($_POST["id_usuario"]) &&  isset($_POST["fecha_venta"]) && isset($_POST["ganancia"])){
        $venta = new Venta(0,$_POST["id_usuario"],$usuario->getNombre(),$_POST["fecha_venta"],$_POST["ganancia"]);
    $mysql = new MySQL();

    
           

            if($mysql->insertarVenta($venta)){
                header("location: http://localhost/SalvadorA/Proyecto%20final/php/ventas.php");
        
            }else {

                echo "<script>alert('Algo salio mal.');</script>";
                echo "<script>window.location.href = 'http://localhost/SalvadorA/Proyecto%20final/php/forminsertarVenta.php';</script>";
            }
    

    
    
    
    
}else{
    echo "Invalida";

}
}


?>

