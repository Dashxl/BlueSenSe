<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlueSense Navbar</title>
  <?php
    include "componentes.php";
  ?>
  <style>
    /* Estilos personalizados para la temática de colores */
    body {
      background-color: #f5f0e1; /* Color beige claro inspirado en el fondo del logo */
    }

    .navbar {
      background-color: #004c4c; /* Verde oscuro inspirado en el logo */
    }

    .navbar-brand {
      color: #009999; /* Verde azulado */
      font-weight: bold;
    }

    .navbar-nav .nav-link {
      color: #ffffff; /* Blanco para el contraste */
    }

    .navbar-nav .nav-link:hover {
      background-color: #007373; /* Efecto hover con un tono más claro */
      border-radius: 5px;
    }

    .btn-custom {
      background-color: #00cccc; /* Color de botón inspirado en los tonos del logo */
      color: #ffffff;
    }

    .btn-custom:hover {
      background-color: #008f8f; /* Efecto hover del botón */
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <img src="img/Logo.png" width="80" height="80" align="left"><a class="navbar-brand" href="index.php">BlueSense</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="mapa.php"><i class="fa-solid fa-map-location-dot"></i> Mapa de Fuentes de Agua</a>
          </li>
        </ul>
        <a href="login.php">
          <button class="btn btn-custom ms-3">Login</button>
        </a>
      </div>
    </div>
  </nav>

</body>
</html>