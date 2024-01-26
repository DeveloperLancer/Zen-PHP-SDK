<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\Zen\Container;

use DevLancer\Zen\Validation\ValidationList;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;

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
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * Merchant’s category for the sold item
     *
     * @param string $category The maximum length is 64 characters
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * Name of the sold item
     *
     * @param string $name The maximum length is 128 characters
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Unit price of the sold item
     *
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * Unit price of the sold item
     *
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * Total price of the sold items
     *
     * @param string $lineAmountTotal
     */
    public function setLineAmountTotal(string $lineAmountTotal): void
    {
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

    /**
     * @return array<string, string|int|null>
     */
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

    public function validation(): ValidationList
    {
        $validator = Validation::createValidator();
        $validationList = new ValidationList();

        $constraints = [new NotBlank(['allowNull' => true]), new Length([ "max" => 64])];
        $validationList->add('code', $validator->validate($this->getCode(), $constraints));
        $validationList->add('category', $validator->validate($this->getCategory(), $constraints));

        $constraints = [new NotBlank(), new Length([ "max" => 128])];
        $validationList->add('name', $validator->validate($this->getName(), $constraints));

        $constraints = [new NotBlank(), new Positive()];
        $validationList->add('quantity', $validator->validate($this->getQuantity(), $constraints));

        $constraints = [
            new NotBlank(),
            new Regex("/^-?(?=.*[0-9])\d{1,16}(?:\.\d{1,12})?$/") //In the regex documentation it allows a negative value, why?
        ];
        $validationList->add('price', $validator->validate($this->getPrice(), $constraints));
        $validationList->add('lineAmountTotal', $validator->validate($this->getLineAmountTotal(), $constraints)); //todo Verify that lineAmountTotal must be equal to price * quantity
        return $validationList;
    }
}
