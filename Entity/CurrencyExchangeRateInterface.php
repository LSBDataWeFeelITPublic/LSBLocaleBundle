<?php
declare(strict_types=1);

namespace LSB\LocaleBundle\Entity;

use DateTime;

/**
 * Interface CurrencyExchangeRateInterface
 * @package LSB\LocaleBundle\Entity
 */
interface CurrencyExchangeRateInterface
{
    /**
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function setCurrency(CurrencyInterface $currency): self;

    /**
     * @return string
     */
    public function getCurrencyIsoCode(): string;

    /**
     * @param string $currencyIsoCode
     * @return $this
     */
    public function setCurrencyIsoCode(string $currencyIsoCode): self;

    /**
     * @return CurrencyInterface
     */
    public function getTargetCurrency(): CurrencyInterface;

    /**
     * @param CurrencyInterface $targetCurrency
     * @return $this
     */
    public function setTargetCurrency(CurrencyInterface $targetCurrency): self;

    /**
     * @return string
     */
    public function getTargetCurrencyIsoCode(): string;

    /**
     * @param string $targetCurrencyIsoCode
     * @return $this
     */
    public function setTargetCurrencyIsoCode(string $targetCurrencyIsoCode): self;

    /**
     * @return float|string
     */
    public function getExchangeRate();

    /**
     * @param float|string $exchangeRate
     * @return $this
     */
    public function setExchangeRate($exchangeRate);

    /**
     * @return DateTime
     */
    public function getExchangeRateDate(): DateTime;

    /**
     * @param DateTime $exchangeRateDate
     * @return $this
     */
    public function setExchangeRateDate(DateTime $exchangeRateDate): self;

    /**
     * @return int
     */
    public function getType(): int;

    /**
     * @param int $type
     * @return $this
     */
    public function setType(int $type): self;

    /**
     * @param string|null $dataSource
     * @return $this
     */
    public function setDataSource(?string $dataSource): self;

    /**
     * @return string|null
     */
    public function getDataSource(): ?string;
}