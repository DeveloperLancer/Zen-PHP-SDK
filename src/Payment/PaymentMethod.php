<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Payment;

use DevLancer\Zen\Enum\PaymentChannelEnum;
use DevLancer\Zen\Enum\PaymentMethodEnum;
use DevLancer\Zen\Payment\Method\ApplePay;
use DevLancer\Zen\Payment\Method\Bancontact;
use DevLancer\Zen\Payment\Method\Blik;
use DevLancer\Zen\Payment\Method\Card;
use DevLancer\Zen\Payment\Method\Dragon;
use DevLancer\Zen\Payment\Method\GooglePay;
use DevLancer\Zen\Payment\Method\Ideal;
use DevLancer\Zen\Payment\Method\Neosurf;
use DevLancer\Zen\Payment\Method\Neteller;
use DevLancer\Zen\Payment\Method\PayByLink;
use DevLancer\Zen\Payment\Method\PayByZen;
use DevLancer\Zen\Payment\Method\PayPal;
use DevLancer\Zen\Payment\Method\Paysafecard;
use DevLancer\Zen\Payment\Method\Paysafecash;
use DevLancer\Zen\Payment\Method\Skrill;
use DevLancer\Zen\Payment\Method\Trustly;
use DevLancer\Zen\Payment\Method\UnionPay;
use DevLancer\Zen\Payment\Method\Webmoney;
use DevLancer\Zen\Payment\Method\WeChat;

class PaymentMethod
{
    public static function getMethods(): array
    {
        return [
            PaymentMethodEnum::PME_APPLEPAY->value => new ApplePay(),
            PaymentMethodEnum::PME_BANCONTACT->value => new Bancontact(),
            PaymentMethodEnum::PME_BLIK->value => new Blik(),
//            PaymentMethodEnum::PME_GOOGLEPAY->value => new GooglePay(), //todo dopisany jest do PME_CARD
            PaymentMethodEnum::PME_IDEAL->value => new Ideal(),
            PaymentMethodEnum::PME_CARD->value => new Card(), //todo visa i mastercard mają taki sam channel
            PaymentMethodEnum::PME_NEOSURF->value => new Neosurf(),
            PaymentMethodEnum::PME_NETELLER_WALLET->value => new Neteller(),
            PaymentMethodEnum::PME_PBL->value => new PayByLink(),
            PaymentMethodEnum::PME_PBZ->value => new PayByZen(),
            PaymentMethodEnum::PME_PAYPAL->value => new PayPal(),
            PaymentMethodEnum::PME_PAYSAFECARD->value => new Paysafecard(), //todo ma dwa kanały, sprawdzić czy należą do tej samej metody
            PaymentMethodEnum::PME_PAYSAFECASH->value => new Paysafecash(),
            PaymentMethodEnum::PME_SKRILL_WALLET->value => new Skrill(),
            PaymentMethodEnum::PME_DRAGON->value => new Dragon(),
            PaymentMethodEnum::PME_TRUSTLY->value => new Trustly(),
            PaymentMethodEnum::PME_UPI->value => new UnionPay(),
            PaymentMethodEnum::PME_WEBMONEY->value => new Webmoney(),
            PaymentMethodEnum::PME_WECHAT->value => new WeChat(),
        ];
    }
    public static function getMethod(PaymentMethodEnum $method): PaymentMethodInterface
    {
        return self::getMethods()[$method->value];
    }

    public static function getMethodByChannel(PaymentChannelEnum $channelEnum): PaymentMethodInterface
    {
        if ($channelEnum == PaymentChannelEnum::PCL_NETELLER_WALLET)
            return self::getMethod(PaymentMethodEnum::PME_NETELLER_WALLET);

        if ($channelEnum == PaymentChannelEnum::PCL_SKRILL_WALLET)
            return self::getMethod(PaymentMethodEnum::PME_SKRILL_WALLET);

        if ($channelEnum == PaymentChannelEnum::PCL_GOOGLEPAY)
            return self::getMethod(PaymentMethodEnum::PME_CARD);

        $value = explode("_", $channelEnum->value);
        $method = PaymentMethodEnum::from("PME_" . $value[1]);
        return self::getMethod($method);
    }
}