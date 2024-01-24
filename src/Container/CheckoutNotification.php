<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Container;

use DevLancer\Zen\Container\Customer\CustomerCheckoutNotification;
use DevLancer\Zen\Container\Customer\CustomerCheckoutRequest;
use DevLancer\Zen\Enum\CurrencyEnum;
use DevLancer\Zen\Enum\StatusEnum;
use DevLancer\Zen\Enum\TransactionTypeEnum;
use DevLancer\Zen\Exception\InvalidArgumentException;

class CheckoutNotification
{
    private ?TransactionTypeEnum $type = null;
    private ?string $transactionId = null;
    private string $merchantTransactionId;
    private string $amount;
    private CurrencyEnum $currency;
    private StatusEnum $status;
    private string $hash;
    private ?string $signature = null;
    private ?PaymentMethod $paymentMethod = null;
    private ?CustomerCheckoutNotification $customer = null;
    private ?string $securityStatus = null;
    private ?AuthorizationFee $authorization = null;
    private array $riskData = [];
    private ?string $email = null;

    /**
     * @param string $merchantTransactionId
     * @param string|CurrencyEnum $currency
     * @param string $amount
     * @param string|StatusEnum $status
     * @param string $hash
     */
    public function __construct(string $merchantTransactionId, string|CurrencyEnum $currency, string $amount, string|StatusEnum $status, string $hash)
    {
        if (is_string($currency))
            $currency = CurrencyEnum::from($currency);

        if (is_string($status))
            $status = StatusEnum::from($status);

        $this->merchantTransactionId = $merchantTransactionId;
        $this->currency              = $currency;
        $this->amount                = $amount;
        $this->status                = $status;
        $this->hash                  = $hash;
    }

    /**
     * @param array $payload
     * @return self
     * @throws InvalidArgumentException
     */
    public static function generate(array $payload): self
    {
        if (TransactionTypeEnum::tryFrom($payload['type']) != TransactionTypeEnum::TRT_PURCHASE)
            throw new InvalidArgumentException("Incorrect notification type");

        $merchantTransactionId = $payload['merchantTransactionId'];
        $currency              = CurrencyEnum::from($payload['currency']);
        $status                = StatusEnum::from($payload['status']);
        $amount                = $payload['amount'];
        $hash                  = $payload['hash'];

        $notification = new self($merchantTransactionId, $currency, $amount, $status, $hash);
        $notification->setType(TransactionTypeEnum::from($payload['type']));
        $notification->setTransactionId($payload['transactionId']);
        $notification->setSignature($payload['signature']);

        $notification->setCustomer($payload['customer']);
        $notification->setSecurityStatus($payload['securityStatus']);
        $notification->setRiskData($payload['riskData'] ?? []);
        $notification->setEmail($payload['email']);

        if (isset($payload['paymentMethod']))
            $notification->setPaymentMethod($payload['paymentMethod']);

        if (isset($payload['authorization']) && count($payload['authorization']) == 3)
            $notification->setAuthorization($payload['authorization']);

        return $notification;
    }

    /**
     * @return TransactionTypeEnum|null
     */
    public function getType(): ?TransactionTypeEnum
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    /**
     * @return string
     */
    public function getMerchantTransactionId(): string
    {
        return $this->merchantTransactionId;
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
     * @return StatusEnum
     */
    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return string|null
     */
    public function getSignature(): ?string
    {
        return $this->signature;
    }

    /**
     * @return PaymentMethod|null
     */
    public function getPaymentMethod(): ?PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @return \DevLancer\Zen\Helper\CustomerCheckout|null
     */
    public function getCustomer(): ?CustomerCheckoutRequest
    {
        return $this->customer;
    }

    /**
     * @return string|null
     */
    public function getSecurityStatus(): ?string
    {
        return $this->securityStatus;
    }

    /**
     * @return array
     */
    public function getRiskData(): array
    {
        return $this->riskData;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param TransactionTypeEnum $type
     */
    public function setType(TransactionTypeEnum $type): void
    {
        $this->type = $type;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId(string $transactionId): void
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @param string $signature
     */
    public function setSignature(string $signature): void
    {
        $this->signature = $signature;
    }

    /**
     * @param PaymentMethod|array $paymentMethod
     */
    public function setPaymentMethod(PaymentMethod|array $paymentMethod): void
    {
        if (is_array($paymentMethod))
            $paymentMethod = new PaymentMethod($paymentMethod['name'], $paymentMethod['channel'], $paymentMethod['parameters']);

        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @param CustomerCheckoutNotification|array $customer
     * @throws InvalidArgumentException
     */
    public function setCustomer(CustomerCheckoutNotification|array $customer): void
    {
        if (is_array($customer)) {
            if ($customer == [])
                return;

            $customerCheckout = new CustomerCheckoutNotification($customer['id'] ?? null, $customer['firstName'] ?? null, $customer['lastName'] ?? null, $customer['email'] ?? null);

            if (isset($customer['ip']))
                $customerCheckout->setIp($customer['ip']);

            if (isset($customer['country']))
                $customerCheckout->setCountry($customer['country']);

            $customer = $customerCheckout;
        }
        $this->customer = $customer;
    }

    /**
     * @param string $securityStatus
     */
    public function setSecurityStatus(string $securityStatus): void
    {
        $this->securityStatus = $securityStatus;
    }

    /**
     * @param array $riskData
     */
    public function setRiskData(array $riskData): void
    {
        $this->riskData = $riskData;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return AuthorizationFee|null
     */
    public function getAuthorization(): ?AuthorizationFee
    {
        return $this->authorization;
    }

    /**
     * @param AuthorizationFee|array $authorization
     * @throws InvalidArgumentException
     */
    public function setAuthorization(AuthorizationFee|array $authorization): void
    {
        if (is_array($authorization))
            $authorization = new AuthorizationFee($authorization['amount'], $authorization['currency'], $authorization['fee']);

        $this->authorization = $authorization;
    }


}