<?php

use oldmine\CurrenciesConverter\DataSources\BinanceApiDataSource;
use oldmine\CurrenciesConverter\Graph\GraphBuilder;
use oldmine\CurrenciesConverter\Graph\PathFinder;
use oldmine\CurrenciesConverter\PriceCalculator;

require_once 'vendor/autoload.php';

$dataSource = new BinanceApiDataSource();
$graphBuilder = new GraphBuilder($dataSource);
$graph = $graphBuilder->build();

$pathFinder = new PathFinder($graph);
$priceCalculator = new PriceCalculator($pathFinder);

$price = $priceCalculator->getPrice(1, 'XMR', 'LTC');
var_dump($price);
