<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Enum;

use DevLancer\Zen\Payment\SpecificData\General;
use DevLancer\Zen\Payment\SpecificData\Unscheduled;

enum PaymentSpecificDataTypeEnum: string
{
    case GENERAL = General::class;
    case EXTERNAL_PAYMENT_TOKEN = "";
    case BLIK = "";
    case ONETIME = "";
    case ONECLICK = "";
    case AUTH_CHECK = "";
    case RECURRING_FULLDATA = "";
    case RECURRING_TOKEN = "";
    case UNSCHEDULED = Unscheduled::class;
    case DRAGON = "";
    case TRUSTLY = "";
}
