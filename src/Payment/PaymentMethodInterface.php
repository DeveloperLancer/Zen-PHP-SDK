<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Payment;

use DevLancer\Zen\Enum\PaymentMethodEnum;

interface PaymentMethodInterface
{
    public static function getName(): string;
    public static function getMethod(): PaymentMethodEnum;

    /**
     * @return PaymentChannelInterface[]
     */
    public static function getChannels(): array;
}