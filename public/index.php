<?php

require __DIR__.'/../vendor/autoload.php';

use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;

use App\Format\FormatInterface;

use App\Format\FromStringInterface;
use App\Format\NamedFormatInterface;
use App\Service\Serializer;
use App\Controller\IndexController;
use App\Container;

$data = [
	"name" => "salma", 
	"surname" => "BHA",
];
//TODO Dependency Injection
$serializer = new Serializer(new JSON());
var_dump($serializer->serialize($data));

//TODO Serive Container
$indexController = new IndexController($serializer);
var_dump($indexController->index());

$container = new Container();
$container->addService('format.json', function () use ($container) {
	return new JSON();
});
$container->addService('format', function () use ($container) {
	return $container->getService('format.json');
}, FormatInterface::class);

$container->loadServices('App\\Service');
$container->loadServices('App\\Controller');

var_dump($container->getServices());

var_dump($container->getService('App\\Controller\\IndexController')->index());
var_dump($container->getService('App\\Controller\\PostController')->index());





