<?php


namespace oldmine\CurrenciesConverter;


class Ticker
{
    public $name;
    public $from;
    public $to;

    public function __construct(string $name, string $from, string $to)
    {
        $this->name = $name;
        $this->from = $from;
        $this->to = $to;
    }
}