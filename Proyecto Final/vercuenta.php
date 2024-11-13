<?php

require_once "./modelos/Usuario.php";
require_once "./MySQL/MySQLME.php";

if(isset($_GET)){
    if(isset($_GET["id"])){
        $id =$_GET["id"];
        $mysql=new MySql();
        $usuario = $mysql->obteneridUsuarios($id);
        if($usuario == null){
            header("Location: vercuenta.php");
        }

    }

}

?>




<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mia Bometeria</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="proyecyo.css">



</head>


<body>
  <header>

    <!-- se hace el navbar con sus botones y busqueda -->
        <nav class="navbar navbar-expand-lg " style="background-color: rgb(248, 210, 206);">
          <div class="container-fluid">
    
    
            <a class="navbar-brand" href="proyecto.php">
              <img src="imagenes/boneteria.jpeg" alt="Boneteria" width="200" height="54">
            </a>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <form class="d-flex" role="search"><!-- se hace el buscador -->
                <input id="formulario" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button id="boton" class="btn btn-outline-success" type="button">Buscar</button>
                <div id="cover-ctn-search" >
    
                </div>
              </form>
    
    
              &emsp;&emsp;&emsp;
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Categorias
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Novedades</a></li>
                    <li><a class="dropdown-item" href="niños.php">Niños</a></li>
                    <li><a class="dropdown-item" href="bebes.php">Bebes</a></li>
                    <li><a class="dropdown-item" href="mujer.php">Mujer</a></li>
                    <li><a class="dropdown-item" href="hombre.php">Hombre</a></li>
                    <li><a class="dropdown-item" href="#">En oferta</a></li>
                    <li><a class="dropdown-item" href="">Otros</a></li>
                  </ul>
                </li>
    
                <li class="nav-item">
                <div class="dropdown">

                  <?php
                  if (isset($_SESSION["nombre"])) {
                    echo '<button class="btn dropdown-toggle" type="button" aria-current="page" data-bs-toggle="dropdown" aria-expanded="false" >
                    <img src="./php/images/icons/iconoper3.png" alt="icono-persona" class="icono-persona" style="width: 40px; height: 30px;"> 
                    ' . $_SESSION["nombre"] . 
                    
                    '</button>';
                    ?>
                    <ul class="dropdown-menu" >
      <li><a class="dropdown-item" href="#">Ver cuenta</a></li>
      <li><a class="dropdown-item" href="#">Lista de compras</a></li>
      <li><a class="dropdown-item" href="cerrarseccion.php">Cerrar sesión </a></li>
    </ul>
                  <?php
                  } else {
                    echo '<a class="nav-link active" aria-current="page" href="./php/iniciar_seccion.php">Iniciar sesión</a>';
                  }
                  ?>
                    </div>
    
                </li>
    
    
    
    
                <li class="nav-item"><!-- Ponemos el api aca -->
                  <a class="nav-link" href="mapa.php">Ubicacion</a>
                </li>
    
    
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                <li class="nav-item">
    
    <!-- se hace el icono de la bolsa y compra de la ventanita -->
                  <div class="container-icon">
                    <div class="container-cart-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="icon-cart">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                      </svg>
                      <div class="count-products">
                        <span id="contador-productos">0</span>
    
    
                      </div>
    
                    </div>
    
    
                    <div class="container-cart-products hidden-cart">
                      <div class="row-product">
                        <div class="cart-product">
                          <div class="info-cart-product">
                            <span class="cantidad-producto-carrito"></span>
                            <p class="titulo-producto-carrito"></p>
                            <span class="precio-producto-carrito"></span>
    
                          </div>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="icon-close">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                          </svg>
    
    
                        </div>
    
                      </div>
    
    
                      <div class="cart-total">
                        <h3>Total:</h3>
                        <span class="total-pagar"></span>
    
                      </div>
    
    
    
                    </div>
                </li>
    
              </ul>
    
            </div>
          </div>
        </nav>
      </header><!-- se hace los resultados en un punto y aparte -->
      <div id="resultado" class="hidden-result">
        <ul id="box-search">
    
        </ul>
      </div>
    
      <div id="cover-ctn-search">
    
      </div>



    
    <!-- <td><a href ='borrarUsuario.php?id=".$usuario->getId()."&confirm=true' onclick=\"return confirm('¿Estás seguro de eliminar este usuario?');\">Borrar</a> </td>!-->
<center>


    <table class="table caption-top table-responsive-sm">

    <img src="./php/images/icons/iconoper3.png" alt="icono-persona" class="icono-persona" style="width: 100px; height: 90px;">
    <tr>
              <th>Nombre</th>
             
            <th>Correo</th>
           
            <th>Contra</th>
           
            
    
   
    <tbody>
    
    <?php
            echo "
            <tr>
            <td>".$usuario->getNombre()."</td>
           
            
            <td>".$usuario->getCorreo()."</td>
           
            <td>".$usuario->getContra()."</td>
            </tr>
                "; 

        ?>
    </tbody>
    
    </table>
    <?php
            echo "
            
            <a class='btn btn-warning' href ='./cambiardatos.php?id=".$usuario->getId()."' >Actualizar</a>
            
            "; 
        ?>
    </center>

    <a class="btn btn-primary" href="proyecto.php">regresar</a>

    
    
    
</body>
</html>








 
  
  <script src="proyecto.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>