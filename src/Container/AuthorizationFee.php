<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Container;

use DevLancer\Zen\Enum\CurrencyEnum;

class AuthorizationFee implements \JsonSerializable
{
    private string $amount;
    private CurrencyEnum $currency;
    private string $fee;

    public function __construct(string $amount, string|CurrencyEnum $currency, string $fee)
    {
        if (is_string($currency))
            $currency = CurrencyEnum::from($currency);

        $this->setAmount($amount);
        $this->setCurrency($currency);
        $this->setFee($fee);
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return CurrencyEnum
     */
    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    /**
     * @param CurrencyEnum $currency
     */
    public function setCurrency(CurrencyEnum $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getFee(): string
    {
        return $this->fee;
    }

    /**
     * @param string $fee
     */
    public function setFee(string $fee): void
    {
        $this->fee = $fee;
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            "amount" => $this->getAmount(),
            "currency" => $this->getCurrency()->value,
            "fee" => $this->getFee(),
        ];
    }
}