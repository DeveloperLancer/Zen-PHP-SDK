<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Payment\Channel;

use DevLancer\Zen\Enum\PaymentChannelEnum;

class PayByLinkNest extends PayByLink
{

    public static function getChannel(): PaymentChannelEnum
    {
        return PaymentChannelEnum::PCL_PBL_NEST;
    }
}