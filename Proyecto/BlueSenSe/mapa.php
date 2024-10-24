<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueSense</title>
    <?php include "componentes.php"; ?>

    <style>
        #map {
            height: calc(100vh - 60px);
            width: 100%;
        }
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        /* Estilos para los botones de SweetAlert2 según la calidad del agua */
        .swal2-confirm-danger {
            background-color: #d9534f !important;
            color: white !important;
        }
        .swal2-confirm-success {
            background-color: #28a745 !important;
            color: white !important;
        }
        .swal2-confirm-warning {
            background-color: #ffc107 !important;
            color: white !important;
        }
        /* Clase para el botón "Mostrar gráfica" en azul */
        .swal2-confirm-blue {
            background-color: #007bff !important;
            color: white !important;
        }
    </style>
</head>
<body>
    <?php include "menu.php"; ?>
    <div align="center">
        <div id="map" class="container-fluid"></div>

        <script>
            var map = L.map('map').setView([21.5120, -104.8940], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var fuentesDeAgua = [
                {
                    nombre: "Rio San Pedro",
                    coordenadas: [22.226102510029904, -105.00979212636152],
                    calidad: "Moderada",
                    descripcion: "Agua apta solo para riego.",
                    imagen: "https://i.ytimg.com/vi/oeNxdDfUXG0/maxresdefault.jpg"
                },
                {
                    nombre: "Río Mololoa",
                    coordenadas: [21.51585409995925, -104.88884195220137],
                    calidad: "Peligrosa",
                    descripcion: "Agua contaminada, es peligroso su uso.",
                    imagen: "https://i0.wp.com/sonplayas.com/wp-content/uploads/2021/02/Basura-en-el-rio-Mololoa.-Fotografia-de-Gerardo-Espinoza.jpg?resize=700%2C466&ssl=1"
                },
                {
                    nombre: "Rio Grande",
                    coordenadas: [21.264028, -104.343727],
                    calidad: "Peligrosa",
                    descripcion: "Agua contaminada, es peligroso su uso.",
                    imagen: "https://www.ecured.cu/images/d/db/RioSantiago.jpg"
                },
                {
                    nombre: "Laguna de Mora",
                    coordenadas: [21.516758, -104.811909],
                    calidad: "Buena",
                    descripcion: "Agua en óptimas condiciones para su uso.",
                    imagen: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwvN35erbFMqWutaaMFMcdXtA6dVQar08z3Q&s"
                },
                {
                    nombre: "Rio chiquito Amatlan de Cañas",
                    coordenadas: [20.80394858195299, -104.40808974962866],
                    calidad: "Buena",
                    descripcion: "Agua en óptimas condiciones para su uso.",
                    imagen: "https://s0.wklcdn.com/image_240/7222798/101718786/66191580.400x300.jpg"
                },
                {
                    nombre: "Rio Ameca",
                    coordenadas: [20.838401, -104.495727],
                    calidad: "Moderada",
                    descripcion: "Agua apta para riego.",
                    imagen: "https://storage.googleapis.com/tribunabahia/uploads/2023/10/Rio-Ameca-desbordado-905x613.jpg"
                },
                {
                    nombre: "Cascada el Cora",
                    coordenadas: [21.414812193928924, -105.12698881963927],
                    calidad: "Buena",
                    descripcion: "Agua en óptimas condiciones para su uso.",
                    imagen: "https://escapadas.mexicodesconocido.com.mx/wp-content/uploads/2023/08/Cascada-el-Cora-ficha-700x438.png"
                },
                {
                    nombre: "Rio Huicicila",
                    coordenadas: [21.320345002104013, -105.055278545828],
                    calidad: "Buena",
                    descripcion: "Agua en óptimas condiciones para su uso.",
                    imagen: "https://aynedjmv.wordpress.com/wp-content/uploads/2014/04/nayarit_landscape.jpg"
                },
                {
                    nombre: "Rio Huajimic",
                    coordenadas: [21.682471382309757, -104.31890872392408],
                    calidad: "Buena",
                    descripcion: "Agua en óptimas condiciones para su uso.",
                    imagen: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGSypMxMJyUAAFcKTfUVWsRkE42WmlfMFQow&s"
                },
                {
                    nombre: "Laguna de Tepeltitic",
                    coordenadas: [21.273760171607496, -104.68462570269907],
                    calidad: "Buena",
                    descripcion: "Agua en óptimas condiciones para su uso.",
                    imagen: "https://www.meganoticias.mx/uploads/noticias/logran-recuperacion-de-laguna-de-tepetiltic-68002.jpeg"
                },
                {
                    nombre: "Laguna de San Pedro Lagunillas",
                    coordenadas: [21.207092, -104.733817],
                    calidad: "Buena",
                    descripcion: "Agua en óptimas condiciones para su uso.",
                    imagen: "https://www.corazondenayarit.com/wp-content/uploads/2021/02/san-pedro-lagunillas-nayarit2.jpg"
                },
                {
                    nombre: "Presa de Refilion",
                    coordenadas: [21.31053327955347, -104.89369957722249],
                    calidad: "Moderada",
                    descripcion: "Agua apta para riego.",
                    imagen: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQRzcP_47ag_UJVwiD87HNOtmRyhruX1kTfSw&s"
                },
                {
                    nombre: "Laguna Garzas",
                    coordenadas: [22.16928318601648, -105.40931795578376],
                    calidad: "Buena",
                    descripcion: "Agua en óptimas condiciones para su uso.",
                    imagen: "https://www.afmedios.com/wp-content/uploads/2021/07/laguna_valledelas_garzas_festival_101.jpg"
                },
                {
                    nombre: "Rio Acaponeta",
                    coordenadas: [22.16928318601648, -105.40931795578376],
                    calidad: "Buena",
                    descripcion: "Agua en óptimas condiciones para su uso.",
                    imagen: "https://visitnayarit.travel/wp-content/uploads/2023/07/galeria-_0002_puente-acaponeta.jpg"
                }
            ];

            function obtenerColorPorCalidad(calidad) {
                switch (calidad) {
                    case "Buena": return "green";
                    case "Moderada": return "orange";
                    case "Peligrosa": return "red";
                    default: return "blue";
                }
            }

            function obtenerClasePorCalidad(calidad) {
                switch (calidad) {
                    case "Buena": return "badge bg-success";
                    case "Moderada": return "badge bg-warning";
                    case "Peligrosa": return "badge bg-danger";
                    default: return "badge bg-primary";
                }
            }

            function obtenerColorSwal(calidad) {
                switch (calidad) {
                    case "Buena": return "#d4edda";
                    case "Moderada": return "#fff3cd";
                    case "Peligrosa": return "#f8d7da";
                    default: return "#cce5ff";
                }
            }

            fuentesDeAgua.forEach(function(fuente) {
                var marcador = L.circleMarker(fuente.coordenadas, {
                    color: obtenerColorPorCalidad(fuente.calidad),
                    radius: 12
                }).addTo(map);

                marcador.on('click', function() {
                    Swal.fire({
                        title: fuente.nombre,
                        text: fuente.descripcion,
                        imageUrl: fuente.imagen,
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: "Imagen de " + fuente.nombre,
                        background: obtenerColorSwal(fuente.calidad),
                        showCancelButton: true,  // Mostrar el botón de cancelar
                        confirmButtonText: "Mostrar gráfica",
                        cancelButtonText: "Cerrar",
                        customClass: {
                            confirmButton: "swal2-confirm-blue",  // Siempre azul
                            cancelButton: "btn btn-danger"        // Siempre rojo
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirigir a grafica.php con los datos del marcador seleccionados
                            window.location.href = `grafica.php?nombre=${encodeURIComponent(fuente.nombre)}&calidad=${encodeURIComponent(fuente.calidad)}&descripcion=${encodeURIComponent(fuente.descripcion)}`;
                        }
                    });
                });
            });
        </script>
    </div>
</body>
</html>
