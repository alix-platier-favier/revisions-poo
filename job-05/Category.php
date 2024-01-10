<?php

class Category
{
    private int $id;
    private string $name;
    private string $description;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(
        int $id = 0,
        string $name = '',
        string $description = '',
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt ?: new DateTime();
        $this->updatedAt = $updatedAt ?: new DateTime();
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

    public function getDescription(): string
    {
    return $this->description;
    }

    public function getCreatedAt(): DateTime
    {
    return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
    return $this->updatedAt;
    }

    // setters

    public function setName(string $name): string
    {
    return $this->name = $name;
    }

    public function setDescription(string $description): string
    {
    return $this->description = $description;
    }

    public function setUpdatedAt(DateTime $updatedAt): DateTime
    {
    return $this->updatedAt = $updatedAt;
    }   

    public function setCreatedAt(DateTime $createdAt): DateTime
    {
    return $this->createdAt = $createdAt;
    }

}