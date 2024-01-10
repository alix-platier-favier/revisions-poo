<?php

class Product
{
    private int $id;
    private string $name;
    private array $photos;
    private float $price;
    private string $description;
    private int $quantity;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private int $categoryId;

    private $category;

    public function __construct(
        int $id = 0,
        string $name = '',
        array $photos = [],
        float $price = 0.0,
        string $description = '',
        int $quantity = 0,
        DateTime $createdAt = null,
        DateTime $updatedAt = null,
        int $categoryId = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt ?: new DateTime();
        $this->updatedAt = $updatedAt ?: new DateTime();
        $this->categoryId = $categoryId;
    }

    // getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    // setters

    public function setId(int $id): Object
    {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name): Object
    {
        $this->name = $name;
        return $this;
    }

    public function setPhotos(array $photos): Object
    {
        $this->photos = $photos;
        return $this;
    }

    public function setPrice(float $price): Object
    {
        $this->price = $price;
        return $this;
    }

    public function setDescription(string $description): Object
    {
        $this->description = $description;
        return $this;

    }

    public function setQuantity(int $quantity): Object
    {
        $this->quantity = $quantity;
        return $this;

    }

    public function setCreatedAt(DateTime $createdAt): Object
    {
        $this->createdAt = $createdAt;
        return $this;

    }

    public function setUpdatedAt(DateTime $updatedAt): Object
    {
        $this->updatedAt = $updatedAt;
        return $this;

    }

    public function setCategoryId(int $categoryId): Object
    {
        $this->categoryId = $categoryId;
        return $this;

    }

    // methods

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(Category $category): Object
    {
        $this->category = $category;
        return $this;
    }

    public static function findOneById(PDO $pdo, int $id)
{
    try {
        $stmt = $pdo->prepare('SELECT * FROM product WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $productData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($productData) {
            return new Product(
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
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return false;
    }
}


    public static function findAll(PDO $pdo)
    {
        try {
            $stmt = $pdo->query('SELECT * FROM product');
            $productInstances = [];

            while ($productData = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productInstances[] = new Product(
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

            return $productInstances;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function create(PDO $pdo)
    {
        try {
            $sql = 'INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id) 
                    VALUES (:name, :photos, :price, :description, :quantity, :createdAt, :updatedAt, :category_id)';
            
            $stmt = $pdo->prepare($sql);

            $name = $this->getName();
            $photos = json_encode($this->getPhotos());
            $price = $this->getPrice();
            $description = $this->getDescription();
            $quantity = $this->getQuantity();
            $createdAt = $this->getCreatedAt()->format('Y-m-d H:i:s');
            $updatedAt = $this->getUpdatedAt()->format('Y-m-d H:i:s');
            $categoryId = $this->getCategoryId();

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':photos', $photos);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':createdAt', $createdAt);
            $stmt->bindParam(':updatedAt', $updatedAt);
            $stmt->bindParam(':category_id', $categoryId);

            $stmt->execute();

            $newProductId = $pdo->lastInsertId();

            $this->setId($newProductId);

            return $this;
        } catch (PDOException $e) {
            return false;
        }
    }

}
