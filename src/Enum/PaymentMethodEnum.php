<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Enum;

enum PaymentMethodEnum: string
{
    case PME_APPLEPAY = "PME_APPLEPAY";
    case PME_BANCONTACT	= "PME_BANCONTAC";
    case PME_BLIK = "PME_BLIK";
//    case PME_GOOGLEPAY = "PME_GOOGLEPAY";
    case PME_IDEAL = "PME_IDEAL";
    case PME_CARD = "PME_CARD";
    case PME_NEOSURF = "PME_NEOSURF";
    case PME_NETELLER_WALLET = "PME_NETELLER_WALLET";
    case PME_PBL = "PME_PBL"; //todo ma duzo kanałów, sprawdzić czy każda należy do tej samej metody czyli PME_PBL
    case PME_PBZ = "PME_PBZ";
    case PME_PAYPAL = "PME_PAYPAL";
    case PME_PAYSAFECARD = "PME_PAYSAFECARD"; //todo ma dwa kanały, sprawdzić czy należą do tej samej metody
    case PME_PAYSAFECASH = "PME_PAYSAFECASH";
    case PME_SKRILL_WALLET = "PME_SKRILL_WALLET";
    case PME_DRAGON = "PME_DRAGON";
    case PME_TRUSTLY = "PME_TRUSTLY";
    case PME_UPI = "PME_UPI";
    case PME_WEBMONEY = "PME_WEBMONEY";
    case PME_WECHAT = "PME_WECHAT";
}
