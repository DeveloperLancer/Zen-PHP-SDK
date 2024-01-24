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
use DevLancer\Zen\Payment\Channel\PayByLinkAlior;
use DevLancer\Zen\Payment\Channel\PayByLinkBNParibas;
use DevLancer\Zen\Payment\Channel\PayByLinkBOS;
use DevLancer\Zen\Payment\Channel\PayByLinkBS;
use DevLancer\Zen\Payment\Channel\PayByLinkBZWBK;
use DevLancer\Zen\Payment\Channel\PayByLinkCITI;
use DevLancer\Zen\Payment\Channel\PayByLinkCreditAgricole;
use DevLancer\Zen\Payment\Channel\PayByLinkGETIN;
use DevLancer\Zen\Payment\Channel\PayByLinkIdeaBank;
use DevLancer\Zen\Payment\Channel\PayByLinkING;
use DevLancer\Zen\Payment\Channel\PayByLinkInteligo;
use DevLancer\Zen\Payment\Channel\PayByLinkIPKO;
use DevLancer\Zen\Payment\Channel\PayByLinkMillenium;
use DevLancer\Zen\Payment\Channel\PayByLinkMTRANSFER;
use DevLancer\Zen\Payment\Channel\PayByLinkNest;
use DevLancer\Zen\Payment\Channel\PayByLinkNoble;
use DevLancer\Zen\Payment\Channel\PayByLinkPBS;
use DevLancer\Zen\Payment\Channel\PayByLinkPekao24;
use DevLancer\Zen\Payment\Channel\PayByLinkPLUS;
use DevLancer\Zen\Payment\PaymentMethodInterface;

class PayByLink implements PaymentMethodInterface
{

    public static function getName(): string
    {
        return "Pay By Link";
    }

    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_PBL;
    }

    /**
     * @return PaymentChannelEnum[]
     */
    public static function getChannels(): array
    {
        return [
            PaymentChannelEnum::PCL_PBL_ALIOR->value => new PayByLinkAlior(),
            PaymentChannelEnum::PCL_PBL_BNPPARIBAS->value => new PayByLinkBNParibas(),
            PaymentChannelEnum::PCL_PBL_BOS->value => new PayByLinkBOS(),
            PaymentChannelEnum::PCL_PBL_BZWBK->value => new PayByLinkBZWBK(),
            PaymentChannelEnum::PCL_PBL_CITI->value => new PayByLinkCITI(),
            PaymentChannelEnum::PCL_PBL_CREDITAGRICOLE->value => new PayByLinkCreditAgricole(),
            PaymentChannelEnum::PCL_PBL_MILLENNIUM->value => new PayByLinkMillenium(),
            PaymentChannelEnum::PCL_PBL_NOBLE->value => new PayByLinkNoble(),
            PaymentChannelEnum::PCL_PBL_PEKAO24->value => new PayByLinkPekao24(),
            PaymentChannelEnum::PCL_PBL_IPKO->value => new PayByLinkIPKO(),
            PaymentChannelEnum::PCL_PBL_GETIN->value => new PayByLinkGETIN(),
            PaymentChannelEnum::PCL_PBL_INTELIGO->value => new PayByLinkInteligo(),
            PaymentChannelEnum::PCL_PBL_IDEABANK->value => new PayByLinkIdeaBank(),
            PaymentChannelEnum::PCL_PBL_ING->value => new PayByLinkING(),
            PaymentChannelEnum::PCL_PBL_MTRANSFER->value => new PayByLinkMTRANSFER(),
            PaymentChannelEnum::PCL_PBL_PBS->value => new PayByLinkPBS(),
            PaymentChannelEnum::PCL_PBL_NEST->value => new PayByLinkNest(),
            PaymentChannelEnum::PCL_PBL_PLUS->value => new PayByLinkPLUS(),
            PaymentChannelEnum::PCL_PBL_BS->value => new PayByLinkBS()
        ];
    }
}