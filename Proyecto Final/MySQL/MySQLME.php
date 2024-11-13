<?php
    session_start();

class MySql{
    public $_connection;
    function __construct(){
        if(isset($_SESSION["DB"])){
            $this->_connection = mysqli_connect("localhost","root","",$_SESSION['DB'],3308);
            if(!$this->_connection)
                echo "<script>alert('Sin éxito en la conexión');</script>";
    
        }else{
            $this->_connection = mysqli_connect("localhost","root","","Mexico",3308);
            if(!$this->_connection)
                echo "<script>alert('Sin éxito en la conexión');</script>";
    
        }
    }

    /**
     * Metodo para obtener un arreglo de usuarios
     */
    function obtenerUsuarios(){
        $usuarios = [];
        $res = mysqli_query($this->_connection,"SELECT * FROM usuarios");
        $array = mysqli_fetch_all($res,MYSQLI_BOTH);
        echo "<br/><br/><br/><br/>";

        foreach ($array as $row) {
           // print_r($row);
            $usuarios[] = new Usuario(
                $row['id'],
                $row['nombre'],
                $row['correo'],
                $row['contraseña'],
                $row['rol']
            );
        }
        return $usuarios;
    }
    function obtenerUsuariossss($database){
        $usuarios = [];
        // Cambiamos de base de datos usando la función mysqli_select_db
        mysqli_select_db($this->_connection, $database);
        $res = mysqli_query($this->_connection,"SELECT * FROM usuarios");
        $array = mysqli_fetch_all($res,MYSQLI_BOTH);
        echo "<br/><br/><br/><br/>";

        foreach ($array as $row) {
           // print_r($row);
            $usuarios[] = new Usuario(
                $row['id'],
                $row['nombre'],
                $row['correo'],
                $row['contraseña'],
                $row['rol']
            );
        }
        return $usuarios;
    }





    function obtenerVentas(){
        $ventas = [];
        $res = mysqli_query($this->_connection,"SELECT * FROM ventas");
        $array = mysqli_fetch_all($res,MYSQLI_BOTH);
        echo "<br/><br/><br/><br/>";

        foreach ($array as $row) {
           // print_r($row);
            $ventas[] = new Venta(
                $row['id_venta'],
                $row['id_usuario'],
                $row['nombre_cliente'],
                $row['fecha_venta'],
                $row['ganancia']
            );
        }
        return $ventas;
    }

    function obtenerRopa(){
        $ropas = [];
        $res = mysqli_query($this->_connection,"SELECT * FROM ropas");
        $array = mysqli_fetch_all($res,MYSQLI_BOTH);
        echo "<br/><br/><br/><br/>";

        foreach ($array as $row) {
           // print_r($row);
            $ropas[] = new Ropa(
                $row['id'],
                $row['Tipo_de_prenda'],
                $row['Genero'],
                $row['Talla'],
                $row['Color'],
                $row['Precio'],
                $row['Stock'],
                $row['Fecha_de_entrada'],
                $row['Proveedor'],
                $row['Detalles'],
                $row['Imagen']
            );
        }
        return $ropas;
    }
   


    
    // usuarios insertar
    function insertarUsuario(Usuario $usuario){
        
        $id= 0;
       
        
       if($usuario){
        $res = mysqli_query($this->_connection,"INSERT INTO usuarios (nombre,correo,contraseña,rol) VALUES 
        ('".$usuario->getNombre()."','".$usuario->getCorreo()."','".$usuario->getContra()."','".$usuario->getRol()."'  )");
    if($res){
        $id = mysqli_insert_id($this->_connection);
    }
       }
       return $id;
    }


    function insertarVenta(Venta $venta){
        
        $id= 0;
       
        
       if($venta){
        $res = mysqli_query($this->_connection,"INSERT INTO ventas (id_usuario,nombre_cliente,fecha_venta,ganancia) VALUES 
        ('".$venta->getIdusuario()."','".$venta->getNombrecliente()."','".$venta->getFechaventa()."','".$venta->getGanancia()."'  )");
    if($res){
        $id = mysqli_insert_id($this->_connection);
    }
       }
       return $id;
    }

    // 
    function insertarRopa(Ropa $ropa){
        $id= 0;
       if($ropa){

        $res = mysqli_query($this->_connection,"INSERT INTO ropas (Tipo_de_prenda,Genero,Talla,Color,Stock,Precio,Fecha_de_entrada,Proveedor,Detalles,Imagen) VALUES 
        ('".$ropa->getTipodeprenda()."','".$ropa->getGenero()."','".$ropa->getTalla()."','".$ropa->getColor()."','".$ropa->getStock()."','".$ropa->getPrecio()."','".$ropa->getFechadeentrada()."','".$ropa->getProveedor()."','".$ropa->getDetalles()."','".$ropa->getImagen()."'  )");
    if($res){
        $id = mysqli_insert_id($this->_connection);
    }
       }
       return $id;
    }
//actua
function actualizarUsuario(Usuario $usuario){
    $res = false;
    if($usuario->getId()){
        $query = "UPDATE usuarios SET nombre ='".$usuario->getNombre()."',".
        "correo='".$usuario->getCorreo()."',".
        "rol='".$usuario->getRol()."',".
        "contraseña='".$usuario->getContra()."' WHERE id = ".$usuario->getId();
        
        $res = mysqli_query($this->_connection, $query); // Ejecutar la consulta SQL
        
       
    }
    return $res;
}
function obteneridUsuarios($id){

    $usuarios= null;
    $res = mysqli_query($this->_connection, "SELECT * FROM usuarios WHERE id=$id");
    if(mysqli_num_rows($res)){
        $data=mysqli_fetch_array($res);
        $usuarios = new Usuario ($data["id"],$data["nombre"],$data["correo"],$data["contraseña"],$data["rol"]);
    }
    return $usuarios;
}
function obteneridRopa($id){

    $ropas= null;
    $res = mysqli_query($this->_connection, "SELECT * FROM ropas WHERE id=$id");
    if(mysqli_num_rows($res)){
        $data=mysqli_fetch_array($res);
        $ropas = new Ropa ($data["id"],$data["Tipo_de_prenda"],$data["Genero"],$data["Talla"],$data["Color"],$data["Precio"],$data["Stock"],$data["Fecha_de_entrada"],$data["Proveedor"],$data["Detalles"],$data["Imagen"]);
    }
    return $ropas;
}

function obteneridVenta($id){

    $ventas= null;
    $res = mysqli_query($this->_connection, "SELECT * FROM ventas WHERE id_venta=$id");
    if(mysqli_num_rows($res)){
        $data=mysqli_fetch_array($res);
        $ventas = new Venta ($data["id_venta"],$data["id_usuario"],$data["nombre_cliente"],$data["fecha_venta"],$data["ganancia"]);
    }
    return $ventas;
}
function obteneridVentaUS($id){

    $ventas = [];
    $res = mysqli_query($this->_connection, "SELECT * FROM ventas WHERE id_usuario=$id");
    $array = mysqli_fetch_all($res,MYSQLI_BOTH);
    echo "<br/><br/><br/><br/>";

    foreach ($array as $row) {
       // print_r($row);
        $ventas[] = new Venta(
            $row['id_venta'],
            $row['id_usuario'],
            $row['nombre_cliente'],
            $row['fecha_venta'],
            $row['ganancia']
        );
    }
    return $ventas;
}
function obteneridVentaUSaa($id){
    
    $ventas = [];
    $res = mysqli_query($this->_connection,"SELECT * FROM ventas WHERE id_usuario=$id");
    $array = mysqli_fetch_all($res,MYSQLI_BOTH);
    echo "<br/><br/><br/><br/>";

    foreach ($array as $row) {
       // print_r($row);
        $ventas[] = new Venta(
            $row['id_venta'],
            $row['id_usuario'],
            $row['nombre_cliente'],
            $row['fecha_venta'],
            $row['ganancia']
        );
    }
    return $ventas;
}
function actualizarRopa(Ropa $ropa){
    $res = false;
    if($ropa->getId()){
        $query = "UPDATE ropas SET Tipo_de_prenda ='".$ropa->getTipodeprenda()."',".
        "Genero='".$ropa->getGenero()."',".
        "Talla='".$ropa->getTalla()."',".
        "Color='".$ropa->getColor()."',".
        "Precio='".$ropa->getPrecio()."',".
        "Stock='".$ropa->getStock()."',".
        "Fecha_de_entrada='".$ropa->getFechadeentrada()."',".
        "Proveedor='".$ropa->getProveedor()."',".


        "Detalles='".$ropa->getDetalles()."' WHERE id = ".$ropa->getId();
        
        $res = mysqli_query($this->_connection, $query); // Ejecutar la consulta SQL
        
       
    }
    return $res;
}

//borrar usuario
function BorrarUsuario(Usuario $usuario){
    $res = false;
    if($usuario->getId()){
        $query = "DELETE FROM usuarios WHERE id = ".$usuario->getId();
        
        $res = mysqli_query($this->_connection, $query); // Ejecutar la consulta SQL
        
       
    }
    return $res;
}

function BorrarVenta(Venta $venta){
    $res = false;
    if($venta->getIdventa()){
        $query = "DELETE FROM ventas WHERE id_venta = ".$venta->getIdventa();
        
        $res = mysqli_query($this->_connection, $query); // Ejecutar la consulta SQL
        
       
    }
    return $res;
}

//borrar 
function BorrarRopa($id){
    $res = false;
    if($id){
        $query = "DELETE FROM ropas WHERE id = ".$id;
        
        $res = mysqli_query($this->_connection, $query); // Ejecutar la consulta SQL
        
       
    }
    return $res;
}



    
function iniciarseccion($correo){

    $usuarios= null;

    $res = mysqli_query($this->_connection, "SELECT * FROM usuarios WHERE correo='$correo'");


    
    if(mysqli_num_rows($res)){
        $data=mysqli_fetch_array($res);
        $usuarios = new Usuario ($data["id"],$data["nombre"],$data["correo"],$data["contraseña"],$data["rol"]);
    }
    return $usuarios;
}






}
