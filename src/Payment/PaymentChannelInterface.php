<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Payment;

use DevLancer\Zen\Enum\CurrencyEnum;
use DevLancer\Zen\Enum\PaymentChannelEnum;
use DevLancer\Zen\Enum\PaymentMethodEnum;
use DevLancer\Zen\Enum\PaymentSpecificDataTypeEnum;

interface PaymentChannelInterface
{
    public static function getMethod(): PaymentMethodEnum;

    public static function getChannel(): PaymentChannelEnum;

    /**
     * @return CurrencyEnum|CurrencyEnum[]
     */
    public static function getCurrencies(): CurrencyEnum|array;
    public static function getAmountMin(CurrencyEnum $currency = CurrencyEnum::EUR): ?float;
    public static function getAmountMax(CurrencyEnum $currency = CurrencyEnum::EUR): ?float;

    /**
     * @return PaymentSpecificDataTypeEnum|PaymentSpecificDataTypeEnum[]
     */
    public static function getPaymentSpecificDataType(): PaymentSpecificDataTypeEnum|array;
}