<?php
require_once 'Product.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
    $stmt->execute([':id' => 7]);

    $productData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($productData) {
        $productInstance = new Product(
            $productData['id'],
            $productData['name'],
            json_decode($productData['photos'], true),
            $productData['price'],
            $productData['description'],
            $productData['quantity'],
            new DateTime($productData['createdAt']),
            new DateTime($productData['updatedAt']),
            $productData['category_id']
        );

        echo "Produit récupéré avec succès:<br>";
        echo "ID: " . $productInstance->getId() . "<br>";
        echo "Nom: " . $productInstance->getName() . "<br>";
        echo "Prix: " . $productInstance->getPrice() . "<br>";
        echo "Photos: " . implode(', ', $productInstance->getPhotos()) . "<br>";

    } else {
        echo 'Le produit avec l\'ID 7 n\'a pas été trouvé.';
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>
