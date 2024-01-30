<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Container;

use DevLancer\Zen\Container\Address\BillingAddress;
use DevLancer\Zen\Container\Address\ShippingAddress;
use DevLancer\Zen\Container\Customer\CustomerCheckoutRequest;
use DevLancer\Zen\Enum\CurrencyEnum;
use DevLancer\Zen\Enum\PaymentChannelEnum;
use DevLancer\Zen\Enum\PaymentMethodEnum;
use DevLancer\Zen\Exception\InvalidArgumentException;
use DevLancer\Zen\Validation\ValidationList;
use Symfony\Component\Validator\Constraints\Language;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validation;

class CheckoutRequest implements \JsonSerializable
{
    /**
     * @var string
     */
    private string $terminalUuid;

    /**
     * @var string
     */
    private string $amount;

    /**
     * @var CurrencyEnum
     */
    private CurrencyEnum $currency;

    /**
     * @var string
     */
    private string $merchantTransactionId;

    /**
     * @var ItemCheckoutCollection
     */
    private ItemCheckoutCollection $items;

    private ?CustomerCheckoutRequest $customer = null;

    /**
     * @var ShippingAddress|null
     */
    private ?ShippingAddress $shippingAddress = null;

    /**
     * @var BillingAddress|null
     */
    private ?BillingAddress $billingAddress = null;

    /**
     * @var string|null
     */
    private ?string $urlRedirect = null;

    /**
     * @var string|null
     */
    private ?string $urlSuccess = null;

    /**
     * @var string|null
     */
    private ?string $urlFailure = null;

    /**
     * @var string|null
     */
    private ?string $customIpnUrl = null;

    /**
     * @var string|null
     */
    private ?string $language = null;

    private ?PaymentMethodEnum $specifiedPaymentMethod = null;
    private ?PaymentChannelEnum $specifiedPaymentChannel = null;

    /**
     * @param string $terminalUuid
     * @param string $amount
     * @param string|CurrencyEnum $currency
     * @param string $merchantTransactionId
     * @param ItemCheckout|ItemCheckoutCollection $item
     */
    public function __construct(string $terminalUuid, string $amount, string|CurrencyEnum $currency, string $merchantTransactionId, ItemCheckout|ItemCheckoutCollection $item)
    {
        $this->terminalUuid          = $terminalUuid;
        $this->amount                = $amount;
        $this->merchantTransactionId = $merchantTransactionId;
        $this->currency              = (is_string($currency))? CurrencyEnum::from($currency) : $currency;

        if ($item instanceof ItemCheckout) {
            $this->items = new ItemCheckoutCollection();
            $this->items->add($item);
        } else {
            $this->items = $item;
        }
    }

    /**
     * @return CustomerCheckoutRequest|null
     */
    public function getCustomer(): ?CustomerCheckoutRequest
    {
        return $this->customer;
    }

    /**
     * @param CustomerCheckoutRequest $customer
     */
    public function setCustomer(CustomerCheckoutRequest $customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return ShippingAddress|null
     */
    public function getShippingAddress(): ?ShippingAddress
    {
        return $this->shippingAddress;
    }

    /**
     * @param ShippingAddress $shippingAddress
     */
    public function setShippingAddress(ShippingAddress $shippingAddress): void
    {
        $this->shippingAddress = $shippingAddress;
    }

    /**
     * @return BillingAddress|null
     */
    public function getBillingAddress(): ?BillingAddress
    {
        return $this->billingAddress;
    }

    /**
     * @param BillingAddress $billingAddress
     */
    public function setBillingAddress(BillingAddress $billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * URL for redirection after transaction. Used if "urlSuccess" and "urlFailure" were not specified
     *
     * @return string|null
     */
    public function getUrlRedirect(): ?string
    {
        return $this->urlRedirect;
    }

    /**
     * URL for redirection after transaction. Used if "urlSuccess" and "urlFailure" were not specified
     *
     * @param string $urlRedirect
     */
    public function setUrlRedirect(string $urlRedirect): void
    {
        $this->urlRedirect = $urlRedirect;
    }

    /**
     * URL for redirection after successful transaction
     *
     * @return string|null
     */
    public function getUrlSuccess(): ?string
    {
        return $this->urlSuccess;
    }

    /**
     * URL for redirection after successful transaction
     *
     * @param string $urlSuccess The maximum length is 256 characters
     */
    public function setUrlSuccess(string $urlSuccess): void
    {
        $this->urlSuccess = $urlSuccess;
    }

    /**
     * URL for redirection after successful transaction
     *
     * @return string|null
     */
    public function getUrlFailure(): ?string
    {
        return $this->urlFailure;
    }

    /**
     * URL for redirection after successful transaction
     *
     * @param string $urlFailure
     */
    public function setUrlFailure(string $urlFailure): void
    {
        $this->urlFailure = $urlFailure;
    }

    /**
     * @return string|null
     */
    public function getCustomIpnUrl(): ?string
    {
        return $this->customIpnUrl;
    }

    /**
     * @param string $customIpnUrl
     */
    public function setCustomIpnUrl(string $customIpnUrl): void
    {
        $this->customIpnUrl = $customIpnUrl;
    }

    /**
     * @return string
     */
    public function getTerminalUuid(): string
    {
        return $this->terminalUuid;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return CurrencyEnum
     */
    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getMerchantTransactionId(): string
    {
        return $this->merchantTransactionId;
    }

    /**
     * @return ItemCheckout[]
     */
    public function getItems(): array
    {
        return $this->items->all();
    }

    /**
     * @param ItemCheckout $item
     * @return void
     */
    public function addItem(ItemCheckout $item): void
    {
        $this->items->add($item);
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return PaymentMethodEnum|null
     */
    public function getSpecifiedPaymentMethod(): ?PaymentMethodEnum
    {
        return $this->specifiedPaymentMethod;
    }

    /**
     * @param PaymentMethodEnum|null $specifiedPaymentMethod
     */
    public function setSpecifiedPaymentMethod(?PaymentMethodEnum $specifiedPaymentMethod): void
    {
        $this->specifiedPaymentMethod = $specifiedPaymentMethod;
    }

    /**
     * @return PaymentChannelEnum|null
     */
    public function getSpecifiedPaymentChannel(): ?PaymentChannelEnum
    {
        return $this->specifiedPaymentChannel;
    }

    /**
     * @param PaymentChannelEnum|null $specifiedPaymentChannel
     */
    public function setSpecifiedPaymentChannel(?PaymentChannelEnum $specifiedPaymentChannel): void
    {
        $this->specifiedPaymentChannel = $specifiedPaymentChannel;
//        $pme = PaymentMethod::getMethodByChannel($specifiedPaymentChannel);
//        $this->setSpecifiedPaymentMethod($pme::getMethod());
    }

    /**
     * @return array<string, mixed>
     * @throws InvalidArgumentException
     */
    public function jsonSerialize(): array
    {
        if (count($this->getItems()) == 0)
            throw new InvalidArgumentException('The list of items is empty');

        $result = [
            'terminalUuid' => $this->getTerminalUuid(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency()->value,
            'merchantTransactionId' => $this->getMerchantTransactionId(),
            'customer' => null,
            'shippingAddress' => null,
            'billingAddress' => null,
            'urlFailure' => $this->getUrlFailure(),
            'urlRedirect' => $this->getUrlRedirect(),
            'urlSuccess' => $this->getUrlSuccess(),
            'customIpnUrl' => $this->getCustomIpnUrl(),
            'language' => $this->getLanguage(),
            'items' => $this->items->jsonSerialize(),
            'specifiedPaymentMethod' => null,
            'specifiedPaymentChannel' => null
        ];

        if ($this->getCustomer())
            $result['customer'] = $this->getCustomer()->jsonSerialize();

        if ($this->getShippingAddress())
            $result['shippingAddress'] = $this->getShippingAddress()->jsonSerialize();

        if ($this->getBillingAddress())
            $result['billingAddress'] = $this->getBillingAddress()->jsonSerialize();

        if ($this->getSpecifiedPaymentMethod())
            $result['specifiedPaymentMethod'] = $this->getSpecifiedPaymentMethod()->value;

        if ($this->getSpecifiedPaymentChannel())
            $result['specifiedPaymentChannel'] = $this->getSpecifiedPaymentChannel()->value;

        return $result;
    }

    public function validation(): ValidationList
    {
        $validator = Validation::createValidator();
        $validationList = new ValidationList();

        $constraints = [new NotBlank(), new Uuid()];
        $validationList->add('terminalUuid', $validator->validate($this->getTerminalUuid(), $constraints));
        $constraints = [new NotBlank(), new Regex("/^(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$/")];
        $validationList->add('amount', $validator->validate($this->getAmount(), $constraints));
        $constraints = [new NotBlank(), new Length(['max' => 128]), new Regex("/^[a-zA-Z0-9?&:\-\/=.,#]+$/")];
        $validationList->add('merchantTransactionId', $validator->validate($this->getMerchantTransactionId(), $constraints));

        if ($this->getCustomer()) {
            foreach ($this->getCustomer()->validation()->all() as $key => $value)
                $validationList->add('customer.' . $key, $value);
        }

        if ($this->getShippingAddress()) {
            foreach ($this->getShippingAddress()->validation()->all() as $key => $value)
                $validationList->add('shippingAddress.' . $key, $value);
        }

        if ($this->getBillingAddress()) {
            foreach ($this->getBillingAddress()->validation()->all() as $key => $value)
                $validationList->add('billingAddress.' . $key, $value);
        }

        $constraints = [new NotBlank(['allowNull' => true]), new Length(['max' => 256]), new Url()];
        $validationList->add('urlFailure', $validator->validate($this->getUrlFailure(), $constraints));
        $validationList->add('urlRedirect', $validator->validate($this->getUrlRedirect(), $constraints));
        $validationList->add('urlSuccess', $validator->validate($this->getUrlSuccess(), $constraints));
        $validationList->add('customIpnUrl', $validator->validate($this->getCustomIpnUrl(), $constraints));


        $constraints = [new NotBlank(['allowNull' => true]), new Language()]; //todo new Locale() ?
        $validationList->add('language', $validator->validate($this->getLanguage(), $constraints));

        foreach ($this->getItems() as $id => $item) {
            foreach ($item->validation()->all() as $key => $value)
                $validationList->add('items[' . $id . '].' . $key, $value);
        }

        if ($this->getSpecifiedPaymentChannel()) {
            //todo sprawdzanie czy channel pasuje do method
            //todo sprawdzanie czy currency pasuje do wybranego channel
        }

        return $validationList;
    }
}