<?php


namespace oldmine\CurrenciesConverter;


class PriceCalculator
{
    private $graph;
    private $pathFinder;

    public function __construct($pathFinder)
    {
        $this->pathFinder = $pathFinder;
        $this->graph = $pathFinder->graph;
    }

    public function getPrice($amount, $from, $to)
    {
        $price = $amount;
        $path = $this->pathFinder->getPath($from, $to);
        $pathCount = count($path);

        for ($i = 0; $i <= $pathCount - 1; $i++) {
            $pathChunk = array_slice($path, $i, 2);

            if (count($pathChunk) !== 2) {
                break;
            }

            [$from, $to] = $pathChunk;

            $price *= $this->graph->edge($from, $to)->getValue();
        }

        return $price;
    }
}