<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Enum;

enum PaymentChannelEnum: string
{
    case PCL_APPLEPAY = "PCL_APPLEPAY";
    case PCL_BANCONTACT = "PCL_BANCONTACT";
    case PCL_BLIK_REDIRECT = "PCL_BLIK_REDIRECT";
    case PCL_BLIK = "PCL_BLIK";
    case PCL_GOOGLEPAY = "PCL_GOOGLEPAY";
    case PCL_IDEAL = "PCL_IDEAL";
    case PCL_CARD = "PCL_CARD"; //todo visa i mastercard mają takie samo
    case PCL_NEOSURF = "PCL_NEOSURF";
    case PCL_NETELLER_WALLET = "PCL_NETELLER_WALLET";
    case PCL_PBL_ALIOR = "PCL_PBL_ALIOR";
    case PCL_PBL_BNPPARIBAS = "PCL_PBL_BNPPARIBAS";
    case PCL_PBL_BOS = "PCL_PBL_BOS";
    case PCL_PBL_BZWBK = "PCL_PBL_BZWBK";
    case PCL_PBL_CITI = "PCL_PBL_CITI";
    case PCL_PBL_CREDITAGRICOLE = "PCL_PBL_CREDITAGRICOLE";
    case PCL_PBL_MILLENNIUM = "PCL_PBL_MILLENNIUM";
    case PCL_PBL_NOBLE = "PCL_PBL_NOBLE";
    case PCL_PBL_PEKAO24 = "PCL_PBL_PEKAO24";
    case PCL_PBL_IPKO = "PCL_PBL_IPKO";
    case PCL_PBL_GETIN = "PCL_PBL_GETIN";
    case PCL_PBL_INTELIGO = "PCL_PBL_INTELIGO";
    case PCL_PBL_IDEABANK = "PCL_PBL_IDEABANK";
    case PCL_PBL_ING = "PCL_PBL_ING";
    case PCL_PBL_MTRANSFER = "PCL_PBL_MTRANSFER";
    case PCL_PBL_PBS = "PCL_PBL_PBS";
    case PCL_PBL_NEST = "PCL_PBL_NEST";
    case PCL_PBL_PLUS = "PCL_PBL_PLUS";
    case PCL_PBL_BS = "PCL_PBL_BS";
    case PCL_PBZ = "PCL_PBZ";
    case PCL_PAYPAL = "PCL_PAYPAL";
    case PCL_PAYSAFECARD_WALLET = "PCL_PAYSAFECARD_WALLET";
    case PCL_PAYSAFECARD_PINCODE = "PCL_PAYSAFECARD_PINCODE";
    case PCL_PAYSAFECASH = "PCL_PAYSAFECASH";
    case PCL_SKRILL_WALLET = "PCL_SKRILL_WALLET";
    case PCL_DRAGON = "PCL_DRAGON";
    case PCL_TRUSTLY = "PCL_TRUSTLY";
    case PCL_UPI = "PCL_UPI";
    case PCL_WEBMONEY = "PCL_WEBMONEY";
    case PCL_WECHAT = "PCL_WECHAT";
}
