<?php

require __DIR__.'/../vendor/autoload.php';

use App\Kernel;

$kernel = (new Kernel())->boot();
$kernel->handleRequest();
