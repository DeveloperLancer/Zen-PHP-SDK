<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Enum;

enum TransactionTypeEnum: string
{
    case TRT_PURCHASE = "TRT_PURCHASE";
    case TRT_REFUND = "TRT_REFUND";
}
