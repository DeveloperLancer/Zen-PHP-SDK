<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Payment\Method;

use DevLancer\Zen\Enum\CurrencyEnum;
use DevLancer\Zen\Enum\PaymentChannelEnum;
use DevLancer\Zen\Enum\PaymentMethodEnum;
use DevLancer\Zen\Enum\PaymentSpecificDataTypeEnum;
use DevLancer\Zen\Payment\Channel\PaysafecardPincode;
use DevLancer\Zen\Payment\Channel\PaysafecardWallet;
use DevLancer\Zen\Payment\PaymentMethodInterface;

class Paysafecard implements PaymentMethodInterface
{

    public static function getName(): string
    {
        return "Paysafecard";
    }

    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_PAYSAFECARD;
    }

    public static function getChannels(): array
    {
        return [
            PaymentChannelEnum::PCL_PAYSAFECARD_WALLET->value => new PaysafecardWallet(),
            PaymentChannelEnum::PCL_PAYSAFECARD_PINCODE->value => new PaysafecardPincode(),
        ];
    }
}