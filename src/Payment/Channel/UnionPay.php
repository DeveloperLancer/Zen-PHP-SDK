<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Payment\Channel;

use DevLancer\Zen\Enum\CurrencyEnum;
use DevLancer\Zen\Enum\PaymentChannelEnum;
use DevLancer\Zen\Enum\PaymentMethodEnum;
use DevLancer\Zen\Enum\PaymentSpecificDataTypeEnum;
use DevLancer\Zen\Payment\PaymentChannelInterface;

class UnionPay implements PaymentChannelInterface
{
    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_UPI;
    }

    /**
     * @return CurrencyEnum[]
     */
    public static function getCurrencies(): array
    {
        return [CurrencyEnum::EUR, CurrencyEnum::BGN, CurrencyEnum::HRK, CurrencyEnum::CZK, CurrencyEnum::HUF, CurrencyEnum::DKK, CurrencyEnum::ISK, CurrencyEnum::CHF, CurrencyEnum::NOK, CurrencyEnum::PLN, CurrencyEnum::RON, CurrencyEnum::SEK, CurrencyEnum::GBP];
    }

    /**
     * @return PaymentChannelEnum
     */
    public static function getChannel(): PaymentChannelEnum
    {
        return PaymentChannelEnum::PCL_UPI;
    }

    public static function getAmountMin(CurrencyEnum $currency = CurrencyEnum::EUR): ?float
    {
        if ($currency != CurrencyEnum::EUR && $currency != CurrencyEnum::MYR && $currency != CurrencyEnum::CNY)
            return null;

        return 0.01; //0.01 MYR/CNY/EUR
    }

    /**
     * Single Transaction Limit USD – $300.000
     * Single Card Limit Per Day USD  – $500.000
     *
     * @param CurrencyEnum $currency
     * @return float|null
     */
    public static function getAmountMax(CurrencyEnum $currency = CurrencyEnum::USD): ?float
    {
        if ($currency != CurrencyEnum::USD)
            return 300.000; //300.000 //todo 300 000?

        if ($currency == CurrencyEnum::EUR || $currency == CurrencyEnum::MYR || $currency == CurrencyEnum::CNY)
            return 100000; //100,000 MYR/CNY/EUR

        return null;
    }

    /**
     * @return PaymentSpecificDataTypeEnum
     */
    public static function getPaymentSpecificDataType(): PaymentSpecificDataTypeEnum
    {
        return PaymentSpecificDataTypeEnum::GENERAL;
    }
}