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

class WeChat implements PaymentChannelInterface
{
    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_WECHAT;
    }

    /**
     * @return CurrencyEnum
     */
    public static function getCurrencies(): CurrencyEnum
    {
        return CurrencyEnum::CNY;
    }

    /**
     * @return PaymentChannelEnum
     */
    public static function getChannel(): PaymentChannelEnum
    {
        return PaymentChannelEnum::PCL_WECHAT;
    }

    public static function getAmountMin(CurrencyEnum $currency = CurrencyEnum::CNY): ?float
    {
        if ($currency != CurrencyEnum::CNY)
            return null;

        return 0.01; //0.01 CNY
    }

    public static function getAmountMax(CurrencyEnum $currency = CurrencyEnum::CNY): ?float
    {
        if ($currency != CurrencyEnum::CNY)
            return null;

        return 50000 ; //50,000 CNY
    }

    /**
     * @return PaymentSpecificDataTypeEnum
     */
    public static function getPaymentSpecificDataType(): PaymentSpecificDataTypeEnum
    {
        return PaymentSpecificDataTypeEnum::GENERAL;
    }
}