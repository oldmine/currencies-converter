<?php


namespace oldmine\CurrenciesConverter;


use GraphDS\Graph\DirectedGraph;

class GraphBuilder
{
    private $api;
    private $graph;

    public function __construct($api)
    {
        $this->api = $api;
        $this->graph = new DirectedGraph();
    }

    public function build()
    {
        $exchangeInfo = $this->api->getExchangeInfo();
        $prices = $this->api->getPrices();

        $symbols = $exchangeInfo['symbols'];

        foreach ($symbols as $symbol) {
            $changeWay = $symbol['symbol'];
            $baseCurrency = $symbol['baseAsset'];
            $quoteCurrency = $symbol['quoteAsset'];
            $price = $prices[$changeWay];

            $this->graph->addVertex($baseCurrency);
            $this->graph->addVertex($quoteCurrency);
            $this->graph->addEdge($baseCurrency, $quoteCurrency, $price);
            $this->graph->addEdge($quoteCurrency, $baseCurrency, 1.0 / $price);
        }

        return $this->graph;
    }
}