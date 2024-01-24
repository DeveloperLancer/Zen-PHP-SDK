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

class BlikRedirect implements PaymentChannelInterface
{
    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_BLIK;
    }

    /**
     * @return PaymentChannelEnum
     */
    public static function getChannel(): PaymentChannelEnum
    {
        return PaymentChannelEnum::PCL_BLIK_REDIRECT;
    }

    /**
     * @return CurrencyEnum
     */
    public static function getCurrencies(): CurrencyEnum
    {
        return CurrencyEnum::PLN;
    }

    public static function getAmountMin(CurrencyEnum $currency = CurrencyEnum::PLN): ?float
    {
        if ($currency != CurrencyEnum::PLN)
            return null;

        return 0.01; //0.01 PLN
    }

    public static function getAmountMax(CurrencyEnum $currency = CurrencyEnum::PLN): ?float
    {
        if ($currency != CurrencyEnum::PLN)
            return null;

        return 100000; //100,000 PLN
    }

    /**
     * @return PaymentSpecificDataTypeEnum
     */
    public static function getPaymentSpecificDataType(): PaymentSpecificDataTypeEnum
    {
        return PaymentSpecificDataTypeEnum::GENERAL;
    }
}