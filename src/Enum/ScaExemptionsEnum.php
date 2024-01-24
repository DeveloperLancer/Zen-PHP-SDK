<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Enum;

enum ScaExemptionsEnum: string
{
    case LOW_VALUE_PAYMENT = "LOW_VALUE_PAYMENT";
    case TRANSACTION_RISK_ANALYSIS = "TRANSACTION_RISK_ANALYSIS";
    case WHITELISTED_MERCHANT = "WHITELISTED_MERCHANT";
}
