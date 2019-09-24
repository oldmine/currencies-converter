<?php


namespace oldmine\CurrenciesConverter\DataSources;


use oldmine\CurrenciesConverter\Ticker;

class CombinedDataSource implements IDataSource
{
    /**
     * @var IDataSource[]
     */
    private $dataSources;

    public function __construct(IDataSource ...$dataSources)
    {
        $this->dataSources = $dataSources;
    }

    /**
     * @return Ticker[]
     * @throws \Exception
     */
    public function getTickers(): array
    {
        $tickers = [];

        foreach ($this->dataSources as $dataSource) {
            $tickers = array_merge($tickers, $dataSource->getTickers());
        }

        return $tickers;
    }

    /**
     * @return array
     */
    public function getPrices(): array
    {
        $prices = [];

        foreach ($this->dataSources as $dataSource) {
            $prices = array_merge($prices, $dataSource->getPrices());
        }

        return $prices;
    }
}
