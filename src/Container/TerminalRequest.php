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
use DevLancer\Zen\Exception\InvalidArgumentException;

class TerminalRequest implements \JsonSerializable
{
    private string $requestId;
    private TransactionTypeEnum $transactionType;
    private string $amount;
    private CurrencyEnum $currency;
    private string $itemsPerPage = "10";
    private string $page = "1";
    private SortEnum $direction = SortEnum::ASC;

    /**
     * @throws InvalidArgumentException
     */
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
     * @param string $requestId Length [38 .. 1024] characters
     * @throws InvalidArgumentException When it does not follow the pattern: "^-?(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$"
     */
    public function setRequestId(string $requestId): void
    {
        if (preg_match("/^[a-zA-Z0-9?&:_|\-\/=+.,#\s]+$/", $requestId) === false)
            throw new InvalidArgumentException(sprintf("The value %f is invalid", $requestId));

        if (strlen($requestId) < 38 || strlen($requestId) > 1024)
            throw new InvalidArgumentException("The length of the string must be between 38 and 1024 characters.");


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
     * @throws InvalidArgumentException When it does not follow the pattern: "^(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$"
     */
    public function setAmount(string $amount): void
    {
        if (preg_match("/^(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$/", $amount) === false)
            throw new InvalidArgumentException(sprintf("The value %f is invalid", $amount));

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
     * @throws InvalidArgumentException When it does not follow the pattern: "^[1-9][0-9]*$"
     */
    public function setItemsPerPage(string $itemsPerPage): void
    {
        if (preg_match("/^[1-9][0-9]*$/", $itemsPerPage) === false)
            throw new InvalidArgumentException(sprintf("The value %f is invalid", $itemsPerPage));

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
     * @throws InvalidArgumentException When it does not follow the pattern: "^[1-9][0-9]*$"
     */
    public function setPage(string $page): void
    {
        if (preg_match("/^[1-9][0-9]*$/", $page) === false)
            throw new InvalidArgumentException(sprintf("The value %f is invalid", $page));

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
}