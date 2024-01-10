<?php
require_once 'Product.php';
require_once 'Category.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=draft-shop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('SELECT * FROM category WHERE id = :id');
    $stmt->execute([':id' => 1]); 

    $categoryData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($categoryData) {
        $categoryInstance = new Category(
            $categoryData['id'],
            $categoryData['name'],
            $categoryData['description'],
            new DateTime($categoryData['createdAt']),
            new DateTime($categoryData['updatedAt'])
        );

        $products = $categoryInstance->getProducts($pdo);

        if (empty($products)) {
            echo "Aucun produit lié à cette catégorie.";
        } else {
            echo "Produits de la catégorie:<br>";
            foreach ($products as $product) {
                echo "- ID: " . $product->getId() . ", Nom: " . $product->getName() . "<br>";
            }
        }

    } else {
        echo 'La catégorie avec l\'ID 1 n\'a pas été trouvée.'; // Remplacez 1 par l'ID de la catégorie
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>
