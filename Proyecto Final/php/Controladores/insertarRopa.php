<?php
require_once "../../modelos/Ropa.php";
require_once "../../MySQL/MySQLME.php";

    

if($_POST){
    if(isset($_POST["Tipo_de_prenda"]) && isset($_POST["Genero"]) && isset($_POST["Talla"]) && isset($_POST["Color"])  && isset($_POST["Precio"]) && isset($_POST["Stock"]) && isset($_POST["Fecha_de_entrada"]) && isset($_POST["Proveedor"]) && isset($_POST["Detalles"])){
        if (isset ($_FILES['imagen']['name'])) {
            if (($_FILES['imagen']['name'] != "")) {
                $targer_dir = "../images/Files_".$_SESSION["DB"]."/"; //carpeta de destino de archivo
                $file = $_FILES["imagen"]["name"];//obtener el nombre original del archivo
                $path = pathinfo($file);
                // print_r($path);
                $filename = $path['filename'];//obtenemos el nombre del archivo

                $ext = $path['extension'];//obtenemos la extension del archivo
                $temp_name = $_FILES["imagen"]["tmp_name"];//
                $completo= $filename . '.' . $ext;
                echo $completo;

                $path_filename_ext = $targer_dir . $filename . '.' . $ext; //donde se va a almacenar el archivo
                echo $path_filename_ext;
                if (file_exists($path_filename_ext)) {//valida si el archivo existe
                     echo "<script>alert('Error: ya esta registrado este imagen');</script>";
                    echo "<script>window.location.href = 'http://localhost/SalvadorA/Proyecto%20final/php/forminsertarRopa.php';</script>";
			
                } else {//si eno existe al archivo lo mueve a la carpeta que le indiquemos
                    move_uploaded_file($temp_name, $path_filename_ext);
                    echo "el archivo se guardo correctamente";
                    ?>
                    <img src="<?php echo $path_filename_ext; ?>" alt="hols">
                    <?php
                     $ropa = new Ropa(0,$_POST["Tipo_de_prenda"],$_POST["Genero"],$_POST["Talla"],$_POST["Color"],$_POST["Stock"],$_POST["Precio"],$_POST["Fecha_de_entrada"],$_POST["Proveedor"],$_POST["Detalles"],$completo);
                     $mysql = new MySQL();
                     if($mysql->insertarRopa($ropa))
                     header("location: http://localhost/SalvadorA/Proyecto%20final/php/inventario.php");
                 
                }
            } else {
                echo "esta sin subir el archivo";
            }
        } else {
        }
       
       
       
       }else{
    echo "Invalida";

}


}

?>