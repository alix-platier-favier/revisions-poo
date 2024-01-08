<?php

include_once 'Product.php';

//test des setters et getter 

$product = new Product(1, 'T-shirt',['http://picsum.photos/200/300'], 1000, 'A beautiful T-shirt', 10, new DateTime(), new DateTime());


var_dump($product->getId());

var_dump($product->getName());

var_dump($product->setDescription('A hideous T-shirt'));

var_dump($product->getDescription());

