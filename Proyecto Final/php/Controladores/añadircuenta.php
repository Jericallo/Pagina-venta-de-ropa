<?php
require_once "../../modelos/Usuario.php";
require_once "../../MySQL/MySQLME.php";

    

if($_POST){
    if(isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["contraseña"]) && isset($_POST["rol"])){
        $usuario = new Usuario(0,$_POST["nombre"],$_POST["correo"],$_POST["contraseña"],$_POST["rol"]);
        $_SESSION["DB"] = $_POST["DB"];
    $mysql = new MySQL();
    $validarcorreo = $mysql->iniciarseccion($_POST["correo"]);

    if($validarcorreo != null) {
        // El correo electrónico ya existe, mostrar mensaje de error
        echo "<script>alert('El correo electrónico ya está en uso.');</script>";
        echo "<script>window.location.href = 'http://localhost/SalvadorA/Proyecto%20final/php/crearcuenta.php';</script>";
    }else{
            

            if($mysql->insertarUsuario($usuario)){
                echo "<script>alert('El correo electrónico ya se creo, inicia seccion.');</script>";

                echo "<script>window.location.href = 'http://localhost/Proyecto%20final/proyecto.php';</script>";
        
            }
    }

    
    
    
    
}else{
    echo "Invalida";

}
}

?>