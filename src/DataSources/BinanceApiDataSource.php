<?php


namespace oldmine\CurrenciesConverter\DataSources;


use oldmine\CurrenciesConverter\Ticker;

class BinanceApiDataSource implements IDataSource
{
    private $api;

    public function __construct(...$params)
    {
        $this->api = new \Binance\API(...$params);
    }

    /**
     * @return Ticker[]
     * @throws \Exception
     */
    public function getTickers(): array
    {
        $symbols = $this->api->exchangeInfo()['symbols'];

        return array_map(static function ($symbol) {
            $name = $symbol['symbol'];
            $fromCurrency = $symbol['baseAsset'];
            $toCurrency = $symbol['quoteAsset'];

            return new Ticker($name, $fromCurrency, $toCurrency);
        }, $symbols);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getPrices(): array
    {
        return $this->api->prices();
    }
}