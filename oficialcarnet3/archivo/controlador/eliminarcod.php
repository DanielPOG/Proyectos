
<?php

require 'vendor/autoload.php'; 

try {
    $pdo = new PDO("mysql:host=localhost;dbname=registrodb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Lógica para eliminar códigos expirados
    $sql = "DELETE FROM codigos WHERE fecha_expiracion < NOW() - INTERVAL 10 MINUTE";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    

} catch (PDOException $e) {
    echo "Error al eliminar códigos: " . $e->getMessage() . "\n";
}



