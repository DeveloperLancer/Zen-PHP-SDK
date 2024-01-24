<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Helper;

use DevLancer\Zen\Container\CheckoutNotification;
use DevLancer\Zen\Enum\CurrencyEnum;
use DevLancer\Zen\Enum\StatusEnum;

class HashGenerator
{
    public static function generate(string $ipnSecret, string $merchantTransactionId, CurrencyEnum|string $currency, string $amount, StatusEnum|string $status): string
    {
        if ($currency instanceof CurrencyEnum)
            $currency = $currency->value;

        if($status instanceof StatusEnum)
            $status = $status->value;

        $args = [
            $merchantTransactionId,
            $currency,
            $amount,
            $status,
            $ipnSecret
        ];

        return strtoupper(hash("sha256", implode("", $args)));
    }

    public static function generateFromContainer(string $ipnSecret, CheckoutNotification $container): string
    {
        return self::generate($ipnSecret, $container->getMerchantTransactionId(), $container->getCurrency(), $container->getAmount(), $container->getStatus());
    }
}