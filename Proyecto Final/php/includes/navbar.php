<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><?php

    echo "Lugar: ";
    echo $db;

    ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="usuarios.php">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="inventario.php">Inventario de ropa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ventas.php">Ventas</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="">Servidores: </a>   
        </li>
        <form action="" method="post">
        <div class="page-header clearfix">
        
            <select  aria-label="" name="DB" id="DB">
            <option  selected disabled >Lugar</option>
                <option value="Mexico">Mexico</option>
                <option value="Colombia">Colombia</option>
            </select>
            <button type="submit" class="btn btn-success">Conectar</button>
        </div>
    </Form>
      </ul>
    </div>
  </div>
</nav>