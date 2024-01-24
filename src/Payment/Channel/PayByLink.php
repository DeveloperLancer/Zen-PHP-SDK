<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Payment\Channel;

use DevLancer\Zen\Enum\CurrencyEnum;
use DevLancer\Zen\Enum\PaymentChannelEnum;
use DevLancer\Zen\Enum\PaymentMethodEnum;
use DevLancer\Zen\Enum\PaymentSpecificDataTypeEnum;
use DevLancer\Zen\Payment\PaymentChannelInterface;

abstract class PayByLink implements PaymentChannelInterface
{
    public static function getMethod(): PaymentMethodEnum
    {
        return PaymentMethodEnum::PME_PBL;
    }

    /**
     * @return CurrencyEnum
     */
    public static function getCurrencies(): CurrencyEnum
    {
        return CurrencyEnum::PLN;
    }

//    /**
//     * @return PaymentChannelEnum[]
//     */
//    public static function getChannel(): array
//    {
//        return [
//            PaymentChannelEnum::PCL_PBL_ALIOR,
//            PaymentChannelEnum::PCL_PBL_BNPPARIBAS,
//            PaymentChannelEnum::PCL_PBL_BOS,
//            PaymentChannelEnum::PCL_PBL_BZWBK,
//            PaymentChannelEnum::PCL_PBL_CITI,
//            PaymentChannelEnum::PCL_PBL_CREDITAGRICOLE,
//            PaymentChannelEnum::PCL_PBL_MILLENNIUM,
//            PaymentChannelEnum::PCL_PBL_NOBLE,
//            PaymentChannelEnum::PCL_PBL_PEKAO24,
//            PaymentChannelEnum::PCL_PBL_IPKO,
//            PaymentChannelEnum::PCL_PBL_GETIN,
//            PaymentChannelEnum::PCL_PBL_INTELIGO,
//            PaymentChannelEnum::PCL_PBL_IDEABANK,
//            PaymentChannelEnum::PCL_PBL_ING,
//            PaymentChannelEnum::PCL_PBL_MTRANSFER,
//            PaymentChannelEnum::PCL_PBL_PBS,
//            PaymentChannelEnum::PCL_PBL_NEST,
//            PaymentChannelEnum::PCL_PBL_PLUS,
//            PaymentChannelEnum::PCL_PBL_BS
//        ];
//    }

    public static function getAmountMin(CurrencyEnum $currency = CurrencyEnum::PLN): ?float
    {
        if ($currency != CurrencyEnum::PLN)
            return null;

        return 1; //1 PLN
    }

    public static function getAmountMax(CurrencyEnum $currency = CurrencyEnum::PLN): ?float
    {
        if ($currency != CurrencyEnum::PLN)
            return null;

        return 100000; //100,000 PLN
    }

    /**
     * @return PaymentSpecificDataTypeEnum
     */
    public static function getPaymentSpecificDataType(): PaymentSpecificDataTypeEnum
    {
        return PaymentSpecificDataTypeEnum::GENERAL;
    }
}