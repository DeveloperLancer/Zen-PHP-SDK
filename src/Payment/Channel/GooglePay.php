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

class GooglePay implements PaymentChannelInterface
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
        return [CurrencyEnum::AED, CurrencyEnum::AUD, CurrencyEnum::BGN, CurrencyEnum::CAD, CurrencyEnum::CHF, CurrencyEnum::CNY, CurrencyEnum::CZK, CurrencyEnum::DKK, CurrencyEnum::EUR, CurrencyEnum::GBP, CurrencyEnum::HKD, CurrencyEnum::HUF, CurrencyEnum::ILS, CurrencyEnum::JPY, CurrencyEnum::KES, CurrencyEnum::MXN, CurrencyEnum::NOK, CurrencyEnum::NZD, CurrencyEnum::PLN, CurrencyEnum::QAR, CurrencyEnum::RON, CurrencyEnum::SAR, CurrencyEnum::SEK, CurrencyEnum::SGD, CurrencyEnum::THB, CurrencyEnum::TRY, CurrencyEnum::UGX, CurrencyEnum::USD, CurrencyEnum::ZAR];
    }

    /**
     * @return PaymentChannelEnum
     */
    public static function getChannel(): PaymentChannelEnum
    {
        return PaymentChannelEnum::PCL_GOOGLEPAY;
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
     * @return PaymentSpecificDataTypeEnum
     */
    public static function getPaymentSpecificDataType(): PaymentSpecificDataTypeEnum
    {
        return PaymentSpecificDataTypeEnum::EXTERNAL_PAYMENT_TOKEN;
    }
}