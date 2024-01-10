<?php
require_once 'Product.php';
require_once 'Category.php';

try {
    $pdo= new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
    $stmt->execute([':id' => 7]);

    $productData = $stmt->fetch(PDO::FETCH_ASSOC);

    if($productData) {
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
    }

    $stmt = $pdo->prepare('SELECT * FROM category WHERE id = :id');
    $stmt->execute([':id' => $productInstance->getCategoryId()]);
    $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

    if($categoryData) {
        $categoryInstance = new Category(
            $categoryData['id'],
            $categoryData['name'],
            $categoryData['description'],
            new DateTime($categoryData['createdAt']),
            new DateTime($categoryData['updatedAt'])
        );

        $productInstance->setCategory($categoryInstance);

        echo "Produit récupéré avec succès:<br>";
        echo "ID: " . $productInstance->getId() . "<br>";
        echo "Nom: " . $productInstance->getName() . "<br>";
        echo "Prix: " . $productInstance->getPrice() . "<br>";

        echo "ID: " . $categoryInstance->getId() . "<br>";
        echo "Nom: " . $categoryInstance->getName() . "<br>";

    } else {
        echo 'La catégorie avec l\'ID ' . $productInstance->getCategoryId() . ' n\'a pas été trouvée.';
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    }
?>
