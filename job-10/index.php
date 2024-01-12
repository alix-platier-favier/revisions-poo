<?php
require_once 'Product.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $product = new Product(0, 'T-shirt 4', ['https://picsum.photos/200/300'], 20, 'Un super t-shirt', 10, new DateTime(), new DateTime());
    $product->create($pdo);

    $product->setName('T-shirt Update')
    ->setQuantity(5);

    $product->update($pdo);    

    if ($product) {
        echo "Produit mis à jour avec succès. Nom: " . $product->getName();
    } else {
        var_dump($result);
        echo "Erreur lors de la création du produit.";
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>
