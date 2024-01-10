<?php
require_once 'Product.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $productId = 11; 
    $productInstance = Product::findOneById($pdo, $productId);

    if ($productInstance) {
        echo "Produit trouvé avec succès:<br>";
        echo "ID: " . $productInstance->getId() . "<br>";
        echo "Nom: " . $productInstance->getName() . "<br>";
    } else {
        echo "Aucun produit trouvé avec l'ID $productId.";
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>
