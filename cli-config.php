<?php

require 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use DB\Connection;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = new PhpFile('migrations.php'); // Or use one of    the Doctrine\Migrations\Configuration\Configuration\* loaders

$paths = [__DIR__ . '/src/Entities'];
$isDevMode = true;

$ORMconfig = Setup::createAttributeMetadataConfiguration($paths, $isDevMode);
$entityManager = (new Connection)->getEntityManager();

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));