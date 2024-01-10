<?php
require_once 'Product.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $allProducts = Product::findAll($pdo);

    if (!empty($allProducts)) {
        echo "Produits trouvés avec succès:<br>";
        foreach ($allProducts as $product) {
            echo "ID: " . $product->getId() . "<br>";
            echo "Nom: " . $product->getName() . "<br>";
            echo "<br>";
        }
    } else {
        echo "Aucun produit trouvé.";
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>
