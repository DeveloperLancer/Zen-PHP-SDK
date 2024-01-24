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
     * @return \DevLancer\Zen\Container\Address\ShippingAddress|null
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
     * @return \DevLancer\Zen\Container\Address\BillingAddress|null
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
     * @param string $urlRedirect The maximum length is 256 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setUrlRedirect(string $urlRedirect): void
    {
        if ($urlRedirect && strlen($urlRedirect) > 256)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "urlRedirect", 256));

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
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setUrlSuccess(string $urlSuccess): void
    {
        if ($urlSuccess && strlen($urlSuccess) > 256)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "urlRedirect", 256));

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
     * @param string $urlFailure The maximum length is 256 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setUrlFailure(string $urlFailure): void
    {
        if ($urlFailure && strlen($urlFailure) > 256)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "urlFailure", 256));

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
     * @param string $customIpnUrl The maximum length is 256 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setCustomIpnUrl(string $customIpnUrl): void
    {
        if ($customIpnUrl && strlen($customIpnUrl) > 256)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "customIpnUrl", 256));

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
     * @return array
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
}