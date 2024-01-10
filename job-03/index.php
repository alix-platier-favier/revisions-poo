<?php

include_once 'Product.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "draft-shop";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id) VALUES 
    ('T-shirt 1', '[\"https://i.ebayimg.com/images/g/3n4AAOSwIyJjuah~/s-l1600.jpg\"]', 19.99, 'Un t-shirt', 10, NOW(), NOW(), 1),
    ('T-shirt 2', '[\"https://i.ebayimg.com/images/g/X-MAAOSw3PVkFiXc/s-l1600.jpg\"]', 23.99, 'Un autre t-shirt', 25, NOW(), NOW(), 1),
    ('T-shirt 3', '[\"https://i.ebayimg.com/images/g/4fkAAOSwDgBiUaRR/s-l1600.jpg\"]', 20.99, 'Un dernier t-shirt', 15, NOW(), NOW(), 1),
    ('Pull 1', '[\"https://i.ebayimg.com/images/g/J0MAAOSwQENgfaRh/s-l1600.jpg\"]', 30.99, 'Un pull', 35, NOW(), NOW(), 2),
    ('Pull 2', '[\"https://i.ebayimg.com/images/g/01IAAOSwpABjilad/s-l1600.jpg\"]', 35.99, 'Un autre pull', 10, NOW(), NOW(), 2),
    ('Pull 3', '[\"https://i.ebayimg.com/images/g/HWoAAOSwaGJjlgVx/s-l1600.jpg\"]', 34.99, 'Un dernier pull', 15, NOW(), NOW(), 2),
    ('Bonnet 1', '[\"https://i.ebayimg.com/images/g/J0MAAOSwQENgfaRh/s-l1600.jpg\"]', 9.99, 'Un bonnet', 10, NOW(), NOW(), 3),
    ('Bonnet 2', '[\"https://i.ebayimg.com/images/g/J0MAAOSwQENgfaRh/s-l1600.jpg\"]', 9.99, 'Un autre bonnet', 12, NOW(), NOW(), 3)";

    $conn->exec($sql);
    echo "Enregistrements ajoutés avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de l'ajout des enregistrements : " . $e->getMessage();
}

$conn = null;

?>
