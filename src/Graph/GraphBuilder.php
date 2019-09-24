<?php


namespace oldmine\CurrenciesConverter\Graph;


use GraphDS\Graph\DirectedGraph;
use GraphDS\Graph\Graph;
use oldmine\CurrenciesConverter\DataSources\IDataSource;

class GraphBuilder
{
    private $api;
    private $graph;

    public function __construct(IDataSource $api)
    {
        $this->api = $api;
        $this->graph = new DirectedGraph();
    }

    public function build(): Graph
    {
        $tickers = $this->api->getTickers();
        $prices = $this->api->getPrices();

        foreach ($tickers as $ticker) {
            $this->graph->addVertex($ticker->from);
            $this->graph->addVertex($ticker->to);

            if (empty($prices[$ticker->name])) {
                continue;
            }

            $price = $prices[$ticker->name];
            $this->graph->addEdge($ticker->from, $ticker->to, $price);
            $this->graph->addEdge($ticker->to, $ticker->from, 1.0 / $price);
        }

        return $this->graph;
    }
}