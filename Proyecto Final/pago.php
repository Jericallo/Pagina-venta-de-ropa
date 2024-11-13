<?php
require_once "./modelos/Usuario.php";
require_once "./MySQL/MySQLME.php";

// Verificar si se recibió el dato 'total_pagar' mediante POST
if(isset($_POST['total_pagar'])) {
    // Obtener el total a pagar desde el formulario
    $total_pagar = $_POST['total_pagar'];

    // Aquí puedes realizar cualquier otra acción necesaria con el total a pagar,
    // como registrar la transacción en una base de datos, enviar un correo electrónico de confirmación, etc.

    // Por ejemplo, podrías mostrar un mensaje de confirmación al usuario
} else {
    // Si no se recibió el dato 'total_pagar', mostrar un mensaje de error o redirigir a otra página
}

setlocale(LC_TIME, 'es_MX.UTF-8');

// Obtener la fecha actual en formato mexicano
$fecha_actual_mexico = strftime("%Y-%m-%d");
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

<?php
echo "<li><a class='dropdown-item' href ='./vercuenta.php?id=".$_SESSION["id"]."' >Ver cuenta</a></li> ";
?>

<li><a class="dropdown-item" href="./php/listadecompras.php">Lista de compras</a></li>
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
                   <span class="total-pagar"><?php echo $_SESSION['total_pagar']; ?></span> 
                   <?php
if (isset($_SESSION["nombre"])) {

  

echo '<form action="./pago.php" method="post">';
    echo '<input type="hidden" name="total_pagar" value="'.$_SESSION['total_pagar'].'">';
    echo '<button type="submit" class="btn btn-primary">Comprar</button>';
    echo '</form>';  ?>

<?php
} else {
  echo 'Inicia seccion para comprar';
}
?>
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
  <center>

    <br>
    <h3 class="text-center">Crear Venta</h3>

<form action="./php/Controladores/insertarVentaUS.php" method="post">
<div class="container">
<input type="text" class="form-control" name="id_usuario" id="" value="<?php echo $_SESSION["id"]; ?>" hidden>              

        <div class="row">
            <div class="col-3">

                <label for="">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="" value="<?php echo $_SESSION["nombre"]; ?>" readonly>              
            </div>
           
            <div class="col-3">
    <label for="">Dia</label>
    <input type="date" name="fecha_venta" id="" class="form-control" value="<?php echo $fecha_actual_mexico; ?>" readonly>
    </div>
    <div class="col-3">
    <label for="">Pagar</label>
    <input type="number" name="ganancia" id="" class="form-control" value="<?php echo $total_pagar; ?>" readonly>
    </div>
           
            <div class="col-3">
                <button class="btn btn-success" type="sumbit">Guardar</button>
                <button class="btn btn-danger" type="button" onclick="window.history.back()">Regresar</button>

            </div>
            
    </div>
    </div>


</form>
    


  </center>





  <center>
    <br><br>
    <br>
    <footer>

      <table> <!-- aui hacemos la parte de abajo con sus iconos -->
        <tr>

          <th>

            <a href="https://www.facebook.com/profile.php?id=61550237064245&mibextid=LQQJ4d"><img
                src="imagenes/face.png" alt="" class="icono"></a>
            &emsp;
          </th>

          <th>

            <a href="https://www.facebook.com/profile.php?id=61550237064245&mibextid=LQQJ4d"><img
                src="imagenes/logomessenger.png" alt="" class="icono"></a>
            &emsp;
          </th>
          <th>

            <a href="https://api.whatsapp.com/send?phone=%2B523311094944&text=hola,%20quiero%20comprar%20algo%20"><img
                src="imagenes/whatsapicono.png" alt="" class="icono"></a>
            &emsp;
          </th>

          <th>

            <a href="https://instagram.com/mariaguadalupenavarrolimon?igshid=NGVhN2U2NjQ0Yg=="><img
                src="imagenes/insta.png" alt="" class="icono"></a>
            &emsp;
          </th>
        </tr>


      </table>
    </footer>


  </center>



  <script src="proyecto.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>