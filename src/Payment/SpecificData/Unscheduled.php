<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Payment\SpecificData;

use DevLancer\Zen\Enum\ScaExemptionsEnum;

class Unscheduled implements \DevLancer\Zen\Payment\PaymentSpecificDataInterface
{
    /**
     * @var string Card token created in the process of saving credit card
     */
    private string $cardToken;

    /**
     * <= 24 characters ^[a-zA-Z0-9 _\-.;|]+$
    Text that will appear on customer Bank Statement. Can be used only for Credit Card payments.
     * @var string
     */
    private string $descriptor;
    private string $firstTransactionId;

    /**
     * @var string Type of transaction
     */
    private string $type = "unscheduled";

    private ?ScaExemptionsEnum $scaExemptions = null;

}