<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . '/../vendor/autoload.php';

$config = ORMSetup::createAttributeMetadataConfiguration(
    $paths = [__DIR__ . '/../src/Model'],
    $isDevMode = true,
);

$dbParams = [
    'driver'   => 'pdo_pgsql',
    'host'     => 'db',
    'user'     => 'postgres',
    'password' => 'admin',
    'dbname'   => 'desafio-backend',
];

$connection = DriverManager::getConnection($dbParams, $config);

$entityManager = new EntityManager($connection, $config);

return $entityManager;