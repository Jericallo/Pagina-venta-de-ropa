<?php
require_once "../../modelos/Usuario.php";
require_once "../../MySQL/MySQLME.php";

    

if($_POST){
    if(isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["contraseña"]) && isset($_POST["id"]) && isset($_POST["rol"])){
        $usuario = new Usuario($_POST["id"],$_POST["nombre"],$_POST["correo"],$_POST["contraseña"],$_POST["rol"]);
    $mysql = new MySQL();
    if($mysql->actualizarUsuario($usuario))
    header("location: http://localhost/SalvadorA/Proyecto%20final/proyecto.php");
}else{
    echo "Invalida";

}
}

?>