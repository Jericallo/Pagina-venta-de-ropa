
<?php

require_once "./modelos/Usuario.php";
    

    require_once "./MySQL/MySQLME.php";

// Definir un array con algunos productos ficticios
$allProducts = array(
    array(
        'name' => 'Vestido navideño dulcesitos',
        'quantity' => 1,
        'price' => '330'
    ),
    array(
        'name' => 'Vestido navideño pinguinos',
        'quantity' => 1,
        'price' => '299'
    ),
    array(
        'name' => 'Vestido navideño reno torera',
        'quantity' => 1,
        'price' => '299'
    ),
    // Agrega más productos aquí si lo necesitas
);

$total = 0;
foreach ($allProducts as $product) {
    $total += $product['quantity'] * intval(substr($product['price'], 0)); // Parsea el precio y multiplica por cantidad
}

// Guardar el total en la sesión
$_SESSION['total_pagar'] = $total;


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


echo "<li><a class='dropdown-item' href='./php/listadecompras.php?id=".$_SESSION["id"]."'>Lista de compras</a></li>"
?>

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
    <table>

      <tr>

        <th>
<!-- Ponemos los productos de las personas com una tabla para orden -->

          <div class="card " style="width: 18rem;">
            <img src="imagenes/dulces.jpg" class="card-img-top cartas " alt="...">

            <div class="card-body">
              <h5 class="card-title">Vestido navideño dulcesitos </h5>
              <p class="card-text"> Vestido de niña con estampado y con caramelitos, con tallas ch, M, G y EXG. </p>

              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">CH $330</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">MD $330</a>

                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">GD $330 </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">EG $345</a>
                  </li>
                </ul>
              </div>

            </div>
          </div>
        </th>

        <th>

          <div class="card" style="width: 18rem;">
            <img src="imagenes/pinguinos.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title ">Vestido navideño pinguinos</h5>
              <p class="card-text ">Vestido de niña con estampado y gorro de santa clous con tallas ch, M y G. </p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">Ch $299</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">MD $299</a>

                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">GD $299 </a>
                  </li>

                </ul>
              </div>
            </div>
          </div>


        </th>

        <th>

          <div class="card" style="width: 18rem;">
            <img src="imagenes/renotorera.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title">Vestido navideño reno torera</h5>
              <p class="card-text">Vestido de niña con tol y tallas ch, M y G. </p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">Ch $299</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">MD $299</a>


                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">GD $299</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </th>

        <th>

          <div class="card" style="width: 18rem;">

            <img src="imagenes/renoverdemanga.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title">Vestido navideño reno </h5>
              <p class="card-text">Vestido de niña con estampado de reno y diadema con tallas ch, M y G. </p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">CH $299</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">MD $299</a>

                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">GD $299</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </th>
      </tr>
      <th>
        <br>
      </th>
      <tr>

        <th>

          <div class="card" style="width: 18rem;">
            <img src="imagenes/renoverdemangasbebe.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title">Vestido navideño reno bebe</h5>
              <p class="card-text">Vestido de niña con estampado de reno y diadema con tallas 1, 2 y 3.</p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">1ñ $259</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">2ñ $259</a>

                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">3ñ $259</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </th>

        <th>

          <div class="card" style="width: 18rem;">
            <img src="imagenes/santaazulmangas.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title">Vestido navideño santa clous azul</h5>
              <p class="card-text">Vestido de niña con estampado y gorro con tallas CH, M y G. </p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">CH $299</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">MD $299</a>

                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">GD $299</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>

        </th>
        <th>

          <div class="card" style="width: 18rem;">
            <img src="imagenes/santaconmangasbebe.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title">Vestido navideño santa clous bebe</h5>
              <p class="card-text">Vestido de niña con mangas, gorro y fajo con tallas 1, 2 y 3.</p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">1ñ $259</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">2ñ $259</a>

                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">3ñ $259</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </th>

        <th>

          <div class="card" style="width: 18rem;">
            <img src="imagenes/santamangas.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title">Vestido navideño santa clous</h5>
              <p class="card-text">Vestido de niña con mangas, gorro y fajo con tallas CH, M y G.</p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">CH $299</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">MD $299</a>

                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">GD $299</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </th>
      </tr>

      </tr>
      <th>
        <br>
      </th>
      <tr>

      <tr>

        <th>

          <div class="card" style="width: 18rem;">
            <img src="imagenes/santasinmagas.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title"> Vestido navideño santa clous con tul</h5>
              <p class="card-text">Vestido de niña y fajo con tallas CH, M, G y EX. </p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">CH $330</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">MD $330</a>

                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">GD $330</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">EG $349</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </th>

        <th>

          <div class="card" style="width: 18rem;">
            <img src="imagenes/santaverdemangabebe.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title">Vestido navideño santa clous bebe (Verde)</h5>
              <p class="card-text">Vestido de niña de verde, gorro y fajo con tallas 1, 2 y 3.</p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">1ñ $259</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">2ñ $259</a>

                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">3ñ $259</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>

        </th>
        <th>

          <div class="card" style="width: 18rem;">
            <img src="imagenes/santaverdemangas.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title">Vestido navideño santa clous bebe</h5>
              <p class="card-text">Vestido de niña verde, gorro y fajo de talla CH, M y G.</p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">CH $299</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">MD $299</a>

                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">GD $299</a>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </th>

        <th>

          <div class="card" style="width: 18rem;">
            <img src="imagenes/snatamangaextragrande.jpg" class="card-img-top cartas" alt="...">
            <div class="card-body">
              <h5 class="card-title">Vestido navideño santa clous con tul</h5>
              <p class="card-text">Vestido de niña con goro y fajo con tallas CH, M, G y EX.</p>
              <div class="btn">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Elije y añade
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">CH $369</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">MD $369</a>

                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">GD $369</a>
                  </li>
                  <li>
                    <a class="dropdown-item price btn-add-cart" href="#">EG $379</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </th>
      </tr>



    </table>


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