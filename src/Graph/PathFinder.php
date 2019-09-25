<?php


namespace oldmine\CurrenciesConverter\Graph;


use GraphDS\Edge\Edge;
use GraphDS\Graph\DirectedGraph;
use GraphDS\Graph\Graph;
use GraphDS\Graph\UndirectedGraph;

class PathFinder
{
    /**
     * @var Graph|DirectedGraph|UndirectedGraph
     */
    private $graph;
    private $pathFinder;

    public function __construct(Graph $graph)
    {
        $this->graph = $graph;
        $this->pathFinder = new Dijkstra($this->graph);
    }

    /**
     * @param string $from
     * @param string $to
     * @return string[]
     */
    public function getPath(string $from, string $to): array
    {
        if ($this->pathFinder->start !== $from) {
            $this->pathFinder->run($from);
        }

        $path = $this->pathFinder->get($to);

        return $path['path'];
    }

    public function getEdge(string $from, string $to): Edge
    {
        return $this->graph->edge($from, $to);
    }
}