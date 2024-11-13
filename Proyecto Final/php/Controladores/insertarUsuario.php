<?php
require_once "../../modelos/Usuario.php";
require_once "../../MySQL/MySQLME.php";

    

if($_POST){
    if(isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["contraseña"]) && isset($_POST["rol"])){
        $usuario = new Usuario(0,$_POST["nombre"],$_POST["correo"],$_POST["contraseña"],$_POST["rol"]);
    $mysql = new MySQL();
    $validarcorreo = $mysql->iniciarseccion($_POST["correo"]);

    if($validarcorreo != null) {
        // El correo electrónico ya existe, mostrar mensaje de error
        echo "<script>alert('El correo electrónico ya está en uso.');</script>";
        echo "<script>window.location.href = 'http://localhost/SalvadorA/Proyecto%20final/php/usuarios.php';</script>";
    }else{

            if($mysql->insertarUsuario($usuario)){
                header("location: http://localhost/SalvadorA/Proyecto%20final/php/usuarios.php");
        
            }
    }

    
    
    
    
}else{
    echo "Invalida";

}
}

?>