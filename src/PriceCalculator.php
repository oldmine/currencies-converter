<?php


namespace oldmine\CurrenciesConverter;


use oldmine\CurrenciesConverter\Exceptions\NotSupportedConversion;
use oldmine\CurrenciesConverter\Graph\PathFinder;

class PriceCalculator
{
    private $pathFinder;

    public function __construct(PathFinder $pathFinder)
    {
        $this->pathFinder = $pathFinder;
    }

    public function getPrice(float $amount, string $from, string $to): float
    {
        $price = $amount;
        $path = $this->pathFinder->getPath($from, $to);
        $pathCount = count($path);

        if ($pathCount === 0) {
            throw new NotSupportedConversion();
        }

        for ($i = 0; $i <= $pathCount - 1; $i++) {
            $pathChunk = array_slice($path, $i, 2);

            if (count($pathChunk) !== 2) {
                break;
            }

            [$from, $to] = $pathChunk;

            $price *= $this->pathFinder->getEdge($from, $to)->getValue();
        }

        return $price;
    }
}