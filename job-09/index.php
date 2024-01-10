<?php
require_once 'Product.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $newProduct = new Product();
    $newProduct->setName('T-shirt 4')
        ->setPhotos(['https://picsum.photos/200/300'])
        ->setPrice(20)
        ->setDescription('Un super t-shirt')
        ->setQuantity(10)
        ->setCreatedAt(new DateTime())
        ->setUpdatedAt(new DateTime())
        ->setCategoryId(1);

    $result = $newProduct->create($pdo);

    if ($result) {
        echo "Produit créé avec succès. ID: " . $result->getId();
    } else {
        var_dump($result);
        echo "Erreur lors de la création du produit.";
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>
