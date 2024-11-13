<?php
require_once "../modelos/Usuario.php";
require_once "../MySQL/MySQLME.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../proyecyo.css">

</head>
<body>
<header>

<!-- se hace el navbar con sus botones y busqueda -->
    <nav class="navbar navbar-expand-lg " style="background-color: rgb(248, 210, 206);">
      <div class="container-fluid">


        <a class="navbar-brand" href="../proyecto.php">
          <img src="../imagenes/boneteria.jpeg" alt="Boneteria" width="200" height="54">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form action=""class="d-flex" role="search"><!-- se hace el buscador -->
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
                <li><a class="dropdown-item" href="../niños.php">Niños</a></li>
                <li><a class="dropdown-item" href="../bebes.php">Bebes</a></li>
                <li><a class="dropdown-item" href="../mujer.php">Mujer</a></li>
                <li><a class="dropdown-item" href="../hombre.php">Hombre</a></li>
                <li><a class="dropdown-item" href="#">En oferta</a></li>
                <li><a class="dropdown-item" href="">Otros</a></li>
              </ul>
            </li>

            <li class="nav-item">

              <a class="nav-link active" aria-current="page" href="./iniciar_seccion.php">Iniciar seccion</a>
            </li>




            <li class="nav-item"><!-- Ponemos el api aca -->
              <a class="nav-link" href="../mapa.php">Ubicacion</a>
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
  <div class="limiter">
		<div class="container-login100" style="background-image: url('images/fondoa.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form class="login100-form validate-form flex-sb flex-w" action="./Controladores/comprobarini.php" method="post">
					<span class="login100-form-title p-b-53">
						Iniciar seccion
					</span>

					<a href="#" class="btn-face m-b-20">
						<i class="fa fa-facebook-official"></i>
						Facebook
					</a>

					<a href="#" class="btn-google m-b-20">
						<img src="images/icons/icon-google.png" alt="GOOGLE">
						Google
					</a>
					
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Correo electronico
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input  class="input100" type="email" name="correo" required >
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Contraseña
						</span>
           
						<a href="#" class="txt2 bo1 m-l-5">
							¿Olvidado?
						</a>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="contraseña" required >
						<span class="focus-input100"></span>
					</div>
          
          <div class="wrap-input100 validate-input" >
          <select  name="DB" required>
            <option  selected disabled >Lugar</option>
                <option value="Mexico">Mexico</option>
                <option value="Colombia">Colombia</option>
            </select>
						<span class="focus-input100"></span>
					</div>
       

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							Iniciar seccion
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							¿No eres miembro?
						</span>

						<a href="crearcuenta.php" class="txt2 bo1">
							Crear nueva cuenta
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

  <script src="../proyecto.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
  crossorigin="anonymous"></script>
    
</body>
</html>