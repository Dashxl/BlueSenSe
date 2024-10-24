<?php
// Conexion a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bluesense";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para simular IA y ajustar la calidad del agua
function actualizarCalidad($calidad_actual) {
    $calidades = ["Buena", "Moderada", "Peligrosa"];
    
    // Simulación de un cambio en la calidad
    $indice_actual = array_search($calidad_actual, $calidades);
    $cambio = rand(-1, 1);  // Cambiar aleatoriamente: -1, 0, o 1
    $nuevo_indice = max(0, min(2, $indice_actual + $cambio));  // Limitar entre 0 y 2
    
    return $calidades[$nuevo_indice];
}

// Consulta para obtener las fuentes de agua y actualizar la calidad
$sql = "
    SELECT 
        Fuentes.pk_fuentes,
        Calidades.nombre_calidad AS calidad_actual
    FROM Fuentes
    INNER JOIN Calidades ON Fuentes.calidad_id = Calidades.pk_calidades
";

$result = $conn->query($sql);

$actualizaciones = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nueva_calidad = actualizarCalidad($row["calidad_actual"]);

        // Actualizar la calidad en la base de datos
        $sql_update = "
            UPDATE Fuentes 
            SET calidad_id = (SELECT pk_calidades FROM Calidades WHERE nombre_calidad = '$nueva_calidad') 
            WHERE pk_fuentes = {$row['pk_fuentes']}
        ";
        $conn->query($sql_update);

        // Añadir al array de resultados la nueva calidad
        $actualizaciones[] = [
            'fuente_id' => $row['pk_fuentes'],
            'nueva_calidad' => $nueva_calidad
        ];
    }
}

// Devolver los cambios como JSON
echo json_encode($actualizaciones);

$conn->close();
?>
