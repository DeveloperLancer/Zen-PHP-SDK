<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\Zen\Container;

use DevLancer\Zen\Exception\InvalidArgumentException;

class ItemCheckout implements \JsonSerializable
{
    private string $name;
    private string $price;
    private int $quantity;
    private string $lineAmountTotal;
    private ?string $code = null;
    private ?string $category = null;

    /**
     * @param string $name Name of the sold item
     * @param string $price Unit price of the sold item
     * @param int $quantity Quantity of the sold items
     * @param string $lineAmountTotal Total price of the sold items
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function __construct(string $name, string $price, int $quantity, string $lineAmountTotal)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setQuantity($quantity);
        $this->setLineAmountTotal($lineAmountTotal);
    }


    /**
     * Merchant’s code for the sold item
     *
     * @param string $code The maximum length is 64 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setCode(string $code): void
    {
        if ($code && strlen($code) > 64)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "code", 64));

        $this->code = $code;
    }

    /**
     * Merchant’s category for the sold item
     *
     * @param string $category The maximum length is 64 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setCategory(string $category): void
    {
        if ($category && strlen($category) > 64)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "category", 64));

        $this->category = $category;
    }

    /**
     * Name of the sold item
     *
     * @param string $name The maximum length is 128 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setName(string $name): void
    {
        if ($name && strlen($name) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "name", 128));

        $this->name = $name;
    }

    /**
     * Unit price of the sold item
     *
     * @param string $price
     * @throws InvalidArgumentException When it does not follow the pattern: "^-?(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$"
     */
    public function setPrice(string $price): void
    {
        if (preg_match("/^-?(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$/", $price) === false)
            throw new InvalidArgumentException(sprintf("The value %f is invalid", $price));

        $this->price = $price;
    }

    /**
     * Unit price of the sold item
     *
     * @param int $quantity
     * @throws InvalidArgumentException When the value is less than 1
     */
    public function setQuantity(int $quantity): void
    {
        if ($quantity < 1)
            throw new InvalidArgumentException("The value must be greater than 0");

        $this->quantity = $quantity;
    }

    /**
     * Total price of the sold items
     *
     * @param string $lineAmountTotal
     * @throws InvalidArgumentException When it does not follow the pattern: "^-?(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$"
     */
    public function setLineAmountTotal(string $lineAmountTotal): void
    {
        if (preg_match("/^-?(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$/", $lineAmountTotal) === false)
            throw new InvalidArgumentException(sprintf("The value %f is invalid", $lineAmountTotal));

        $this->lineAmountTotal = $lineAmountTotal;
    }

    /**
     * Name of the sold item
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Unit price of the sold item
     *
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * Unit price of the sold item
     *
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Total price of the sold items
     *
     * @return string
     */
    public function getLineAmountTotal(): string
    {
        return $this->lineAmountTotal;
    }

    /**
     * Merchant’s code for the sold item
     *
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Merchant’s category for the sold item
     *
     * @return string|null
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function jsonSerialize(): array
    {
        return [
            'code' => $this->getCode(),
            'category' => $this->getCategory(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'quantity' => $this->getQuantity(),
            'lineAmountTotal' => $this->getLineAmountTotal()
        ];
    }
}
