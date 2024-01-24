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

class Ideal implements PaymentMethodInterface
{
    public static function getName(): string
    {
        return "Ideal";
    }

    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_IDEAL;
    }

    public static function getChannels(): array
    {
        return [PaymentChannelEnum::PCL_IDEAL->value => new \DevLancer\Zen\Payment\Channel\Ideal()];
    }
}