<?php

use oldmine\CurrenciesConverter\Api;
use oldmine\CurrenciesConverter\GraphBuilder;
use oldmine\CurrenciesConverter\PathFinder;
use oldmine\CurrenciesConverter\PriceCalculator;

require_once 'vendor/autoload.php';

$api = new Api();
$graphBuilder = new GraphBuilder($api);
$graph = $graphBuilder->build();

$pathFinder = new PathFinder($graph);
$priceCalculator = new PriceCalculator($pathFinder);

$price = $priceCalculator->getPrice(1, 'XMR', 'LTC');
var_dump($price);
