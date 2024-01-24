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

class PayByZen implements PaymentChannelInterface
{
    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_PBZ;
    }

    /**
     * @return CurrencyEnum[]
     */
    public static function getCurrencies(): array
    {
        return [CurrencyEnum::EUR,CurrencyEnum::GBP,CurrencyEnum::PLN,CurrencyEnum::USD];
    }

    /**
     * @return PaymentChannelEnum
     */
    public static function getChannel(): PaymentChannelEnum
    {
        return PaymentChannelEnum::PCL_PBZ;
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

        return 1000000; //1,000,000 EUR
    }

    /**
     * @return PaymentSpecificDataTypeEnum
     */
    public static function getPaymentSpecificDataType(): PaymentSpecificDataTypeEnum
    {
        return PaymentSpecificDataTypeEnum::GENERAL;
    }
}