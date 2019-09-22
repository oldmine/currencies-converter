<?php


namespace oldmine\CurrenciesConverter;


class Api
{
    private $api;

    public function __construct()
    {
        $this->api = new \Binance\API();
    }

    public function getExchangeInfo()
    {
        return $this->api->exchangeInfo();
    }

    public function getPrices()
    {
        return $this->api->prices();
    }
}