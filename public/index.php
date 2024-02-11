<?php

use App\Kernel;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;

require __DIR__ . '/../vendor/autoload.php';

define('APP_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

$kernel = new Kernel();
$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
  $psr17Factory, // ServerRequestFactory
  $psr17Factory, // UriFactory
  $psr17Factory, // UploadedFileFactory
  $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$kernel->handleRequest($request);
