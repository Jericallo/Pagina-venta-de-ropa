<?php
require_once "../../modelos/Usuario.php";
require_once "../../MySQL/MySQLME.php";

    

if($_GET){
    if(isset($_GET["id"])){
        $usuario = new Usuario($_GET["id"],$_GET["nombre"],$_GET["correo"],$_GET["contraseña"],$_GET["rol"]);
    $mysql = new MySQL();
    if($mysql->BorrarUsuario($usuario))
    header("location: http://localhost/SalvadorA/Proyecto%20final/php/usuarios.php");
}else{
    echo "Invalida";

}
}

?>