<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de Calidad del Agua</title>
    <?php
     include "componentes.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            max-width: 800px; /* Ancho máximo para la gráfica */
            width: 100%; /* Ancho del canvas al 100% */
            height: 600px; /* Altura fija para la gráfica */
            margin: 0 auto; /* Centra el canvas */
        }
    </style>
</head>
<body>
    <?php
        include "menu.php";
    ?>
    <br>
    <div align = "center">
        <h1>Gráfica de Calidad del Agua</h1>
    </div>

    <?php
    // Recibir los datos de la URL
    $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : 'Fuente Desconocida';
    $calidad = isset($_GET['calidad']) ? $_GET['calidad'] : 'No especificada';
    $descripcion = isset($_GET['descripcion']) ? $_GET['descripcion'] : 'Sin descripción';
    ?>
    <div align = "center">
        <h2><?php echo htmlspecialchars($nombre); ?></h2>
        <p>Calidad del Agua: <strong><?php echo htmlspecialchars($calidad); ?></strong></p>
        <p>Descripción: <?php echo htmlspecialchars($descripcion); ?></p>
    </div>
    <canvas id="myChart"></canvas>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'radar',  // Tipo de gráfico
            data: {
                labels: ['PH', 'Turbidez', 'Oxígeno', 'Temperatura'],  // Etiquetas
                datasets: [{
                    label: 'Calidad del Agua en ' + "<?php echo $nombre; ?>",
                    data: [7.5, 4.2, 8.1, 23],  // Datos de ejemplo
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true // Empieza en cero
                    }
                }
            }
        });
    </script>
</body>
</html>
