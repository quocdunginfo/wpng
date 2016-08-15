<?php
// bootstrap.php
require_once "plugins/doctrine2/vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("/path/to/entity-files");
$isDevMode = false;

// the connection configuration
$dbParams = array(
	'host'     => 'localhost',
	'port'     => '3306',
	'driver'   => 'pdo_mysql',
	'user'     => 'root',
	'password' => '',
	'dbname'   => 'wpng',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

require_once "models/db/wpng.product.model.class.php";
$product = new WpngProductModel();
$product->name = 'p name';
//$entityManager->persist($product);
//$entityManager->flush();