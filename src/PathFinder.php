<?php


namespace oldmine\CurrenciesConverter;


class PathFinder
{
    public $graph;

    public function __construct($graph)
    {
        $this->graph = $graph;
    }

    public function getPath($from, $to)
    {
        $pathFinder = new Dijkstra($this->graph);
        $pathFinder->run($from);
        $path = $pathFinder->get($to);

        return $path['path'];
    }


}