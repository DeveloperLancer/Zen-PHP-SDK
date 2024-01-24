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

class Neosurf implements PaymentChannelInterface
{
    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_NEOSURF;
    }

    /**
     * @return CurrencyEnum[]
     */
    public static function getCurrencies(): array
    {
        return [CurrencyEnum::AUD, CurrencyEnum::BGN, CurrencyEnum::BRL, CurrencyEnum::CAD, CurrencyEnum::CHF, CurrencyEnum::CNY, CurrencyEnum::CZK, CurrencyEnum::DKK, CurrencyEnum::EUR, CurrencyEnum::GBP, CurrencyEnum::HKD, CurrencyEnum::HUF, CurrencyEnum::IDR, CurrencyEnum::ILS, CurrencyEnum::INR, CurrencyEnum::JPY, CurrencyEnum::KRW, CurrencyEnum::MXN, CurrencyEnum::MYR, CurrencyEnum::NOK, CurrencyEnum::NZD, CurrencyEnum::PHP, CurrencyEnum::PLN, CurrencyEnum::RON, CurrencyEnum::RUB, CurrencyEnum::SEK, CurrencyEnum::SGD, CurrencyEnum::THB, CurrencyEnum::TRY, CurrencyEnum::USD, CurrencyEnum::XOF, CurrencyEnum::ZAR];
    }

    /**
     * @return PaymentChannelEnum
     */
    public static function getChannel(): PaymentChannelEnum
    {
        return PaymentChannelEnum::PCL_NEOSURF;
    }

    public static function getAmountMin(CurrencyEnum $currency = CurrencyEnum::EUR): ?float
    {
        if ($currency != CurrencyEnum::EUR)
            return null;

        return 1; //1 EUR
    }

    public static function getAmountMax(CurrencyEnum $currency = CurrencyEnum::EUR): ?float
    {
        if ($currency != CurrencyEnum::EUR)
            return null;

        return 10000; //10,000 EUR
    }

    /**
     * @return PaymentSpecificDataTypeEnum
     */
    public static function getPaymentSpecificDataType(): PaymentSpecificDataTypeEnum
    {
        return PaymentSpecificDataTypeEnum::GENERAL;
    }
}