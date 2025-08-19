<?php
// db.php - conexión a PostgreSQL con PDO

$host = "localhost";      // o la IP del server, si corrés desde otro equipo
$port = "5432";           // puerto por defecto de Postgres
$dbname = "sig";     // reemplazá por el nombre de tu base
$user = "postgres";       // tu usuario de Postgres
$password = "Qatarairways"; // tu contraseña

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    // Modo de errores: excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
