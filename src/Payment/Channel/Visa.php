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

class Visa implements PaymentChannelInterface
{
    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_CARD;
    }

    /**
     * @return CurrencyEnum[]
     */
    public static function getCurrencies(): array
    {
        return [CurrencyEnum::AED, CurrencyEnum::AUD, CurrencyEnum::GBP, CurrencyEnum::BGN, CurrencyEnum::CAD, CurrencyEnum::CZK, CurrencyEnum::DKK, CurrencyEnum::EUR, CurrencyEnum::HKD, CurrencyEnum::HUF, CurrencyEnum::ILS, CurrencyEnum::JPY, CurrencyEnum::KES, CurrencyEnum::MXN, CurrencyEnum::NZD, CurrencyEnum::NOK, CurrencyEnum::PLN, CurrencyEnum::QAR, CurrencyEnum::CNY, CurrencyEnum::RON, CurrencyEnum::SAR, CurrencyEnum::SGD, CurrencyEnum::ZAR, CurrencyEnum::SEK, CurrencyEnum::CHF, CurrencyEnum::THB, CurrencyEnum::TRY, CurrencyEnum::UGX, CurrencyEnum::USD];
    }

    /**
     * @return PaymentChannelEnum
     */
    public static function getChannel(): PaymentChannelEnum
    {
        return PaymentChannelEnum::PCL_CARD;
    }

    public static function getAmountMin(CurrencyEnum $currency = CurrencyEnum::EUR): ?float
    {
        if ($currency != CurrencyEnum::EUR)
            return null;

        return 0.01; //0.01 EUR
    }

    public static function getAmountMax(CurrencyEnum $currency = CurrencyEnum::EUR): ?float
    {
        if ($currency != CurrencyEnum::EUR)
            return null;

        return 100000; //100,000 EUR
    }

    /**
     * @return PaymentSpecificDataTypeEnum[]
     */
    public static function getPaymentSpecificDataType(): array
    {
        return [
            PaymentSpecificDataTypeEnum::ONETIME,
            PaymentSpecificDataTypeEnum::ONECLICK,
            PaymentSpecificDataTypeEnum::AUTH_CHECK,
            PaymentSpecificDataTypeEnum::RECURRING_FULLDATA,
            PaymentSpecificDataTypeEnum::RECURRING_TOKEN,
            PaymentSpecificDataTypeEnum::UNSCHEDULED
        ];
    }
}