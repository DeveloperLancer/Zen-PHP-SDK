<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Container;

use DevLancer\Zen\Enum\CurrencyEnum;
use DevLancer\Zen\Enum\SortEnum;
use DevLancer\Zen\Enum\TransactionTypeEnum;
use DevLancer\Zen\Validation\ValidationList;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;

class TerminalRequest implements \JsonSerializable
{
    private string $requestId;
    private TransactionTypeEnum $transactionType;
    private string $amount;
    private CurrencyEnum $currency;
    private string $itemsPerPage = "10";
    private string $page = "1";
    private SortEnum $direction = SortEnum::ASC;

    public function __construct(string $requestId, string|TransactionTypeEnum $transactionType, string $amount, string|CurrencyEnum $currency)
    {
        if (is_string($transactionType))
            $transactionType = TransactionTypeEnum::from($transactionType);

        if (is_string($currency))
            $currency = CurrencyEnum::from($currency);

        $this->transactionType = $transactionType;
        $this->currency = $currency;
        $this->setRequestId($requestId);
        $this->setAmount($amount);
    }

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     */
    public function setRequestId(string $requestId): void
    {
        $this->requestId = $requestId;
    }

    /**
     * @return TransactionTypeEnum
     */
    public function getTransactionType(): TransactionTypeEnum
    {
        return $this->transactionType;
    }

    /**
     * @param TransactionTypeEnum $transactionType
     */
    public function setTransactionType(TransactionTypeEnum $transactionType): void
    {
        $this->transactionType = $transactionType;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return CurrencyEnum
     */
    public function getCurrency(): CurrencyEnum
    {
        return $this->currency;
    }

    /**
     * @param CurrencyEnum $currency
     */
    public function setCurrency(CurrencyEnum $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getItemsPerPage(): string
    {
        return $this->itemsPerPage;
    }

    /**
     * @param string $itemsPerPage
     */
    public function setItemsPerPage(string $itemsPerPage): void
    {
        $this->itemsPerPage = $itemsPerPage;
    }

    /**
     * @return string
     */
    public function getPage(): string
    {
        return $this->page;
    }

    /**
     * @param string $page
     */
    public function setPage(string $page): void
    {
        $this->page = $page;
    }

    /**
     * @return SortEnum
     */
    public function getDirection(): SortEnum
    {
        return $this->direction;
    }

    /**
     * @param SortEnum $direction
     */
    public function setDirection(SortEnum $direction): void
    {
        $this->direction = $direction;
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            'request-id' => $this->getRequestId(),
            'transactionType' => $this->getTransactionType()->value,
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency()->value,
            'direction' => $this->getDirection()->value,
            'itemsPerPage' => $this->getItemsPerPage(),
            'page' => $this->getPage()
        ];
    }

    public function validation(): ValidationList
    {
        $validator = Validation::createValidator();
        $validationList = new ValidationList();

        $constraints = [new NotBlank(), new Length(['min' => 38, 'max' => 1024]), new Regex("/^[a-zA-Z0-9?&:_|\-\/=+.,#\s]+$/")];
        $validationList->add('request-id', $validator->validate($this->getRequestId(), $constraints));

        $constraints = [new NotBlank(), new Regex("/^(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$/")];
        $validationList->add('amount', $validator->validate($this->getAmount(), $constraints));

        $constraints = [new NotBlank(), new Regex("/^[1-9][0-9]*$/")];
        $validationList->add('itemsPerPage', $validator->validate($this->getItemsPerPage(), $constraints));
        $validationList->add('page', $validator->validate($this->getPage(), $constraints));

        return $validationList;
    }
}