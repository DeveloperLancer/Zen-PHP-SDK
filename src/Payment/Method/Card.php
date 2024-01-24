<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Payment\Method;

use DevLancer\Zen\Enum\PaymentChannelEnum;
use DevLancer\Zen\Enum\PaymentMethodEnum;
use DevLancer\Zen\Payment\PaymentMethodInterface;

class Card implements PaymentMethodInterface
{

    public static function getName(): string
    {
        return "Card";
    }

    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_CARD;
    }

    /**
     * @inheritDoc
     */
    public static function getChannels(): array
    {
        return [
            "PCL_CARD_MASTERCARD" => new \DevLancer\Zen\Payment\Channel\Mastercard(),
            "PCL_CARD_VISA" => new \DevLancer\Zen\Payment\Channel\Visa(),
            PaymentChannelEnum::PCL_GOOGLEPAY->value => new \DevLancer\Zen\Payment\Channel\GooglePay()
        ];
    }
}