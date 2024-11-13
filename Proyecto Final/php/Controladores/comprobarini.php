<?php
require_once "../../modelos/Usuario.php";
require_once "../../MySQL/MySQLME.php";

    



if($_POST){
    if(isset($_POST["correo"]) && isset($_POST["contraseña"])){
        $correo =$_POST["correo"];
        $contraseña =$_POST["contraseña"];
        $_SESSION["DB"] = $_POST["DB"];
        $mysql=new MySql();

        $usuario = $mysql->iniciarseccion($correo);


        if($usuario == null){
            echo "<script>alert('Error: El correo electrónico no existe');</script>";
            echo "<script>window.location.href = 'http://localhost/SalvadorA/Proyecto%20final/php/iniciar_seccion.php';</script>";
            exit(); 



        }
        $contraseñaReal=$usuario->getContra();
        session_start();
        if($contraseña==$contraseñaReal){

            $_SESSION["id"]=$usuario->getId();
            $_SESSION["nombre"]=$usuario->getNombre();
            $_SESSION["correo"]=$correo;
            $_SESSION["contraseña"]=$contraseña;
            $_SESSION["rol"]=$usuario->getRol();
            if($_SESSION["rol"]=="Administrador"){
                header("Location: http://localhost/SalvadorA/Proyecto%20final/php/usuarios.php");

            }else{
header("Location: http://localhost/SalvadorA/Proyecto%20final/proyecto.php");

            }

        }else{
            echo "<script>alert('Error: La contraseña es incorrecta');</script>";
            echo "<script>window.location.href = 'http://localhost/SalvadorA/Proyecto%20final/php/iniciar_seccion.php';</script>";
            exit(); 
        }



    }
}
?>