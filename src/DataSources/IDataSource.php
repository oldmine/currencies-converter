<?php


namespace oldmine\CurrenciesConverter\DataSources;


use oldmine\CurrenciesConverter\Ticker;

interface IDataSource
{
    /**
     * @return Ticker[]
     * @throws \Exception
     */
    public function getTickers(): array;

    /**
     * @return array
     */
    public function getPrices(): array;
}