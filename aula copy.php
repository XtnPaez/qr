<?php
require_once "db.php"; // conexión PDO

// Tomar parámetros de la URL
$cui  = isset($_GET['cui']) ? $_GET['cui'] : null;
$aula = isset($_GET['aula']) ? $_GET['aula'] : null;

if (!$cui || !$aula) {
    die("Parámetros inválidos. Debe indicar cui y aula.");
}

try {
    // Preparar consulta
    $stmt = $pdo->prepare('SELECT id, cui, aula FROM "aulas"."aula" WHERE cui = :cui AND aula = :aula');
    $stmt->execute([
        ':cui'  => $cui,
        ':aula' => $aula
    ]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Información del Aula</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 40px; margin: 20px; }
                .card {
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    padding: 20px;
                    max-width: 900px;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                }
                .card h2 { margin-top: 0; }
            </style>
        </head>
        <body>
            <div class="card">
                <h2>Aula <?= htmlspecialchars($row['aula']) ?></h2>
                <p><strong>ID:</strong> <?= htmlspecialchars($row['id']) ?></p>
                <p><strong>CUI:</strong> <?= htmlspecialchars($row['cui']) ?></p>
                <p><strong>Código Aula:</strong> <?= htmlspecialchars($row['aula']) ?></p><BR>
                <p>Esta información viene desde la base de datos</p>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "No se encontró el aula con CUI $cui y código $aula.";
    }
} catch (PDOException $e) {
    die("Error en la consulta: " . $e->getMessage());
}
