<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\Zen\Container\Customer;

use DevLancer\Zen\Exception\InvalidArgumentException;

/**
 *
 */
abstract class Customer implements \JsonSerializable
{
    private ?string $id = null;

    /**
     * @var string|null
     */
    private ?string $firstName = null;
    /**
     * @var string|null
     */
    private ?string $lastName = null;

    /**
     * @var string|null
     */
    protected ?string $email = null;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * First name of the buyer
     *
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * First name of the buyer
     *
     * @param string|null $firstName The maximum length is 128 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setFirstName(?string $firstName): void
    {
        if ($firstName && strlen($firstName) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "firstName", 128));
        $this->firstName = $firstName;
    }

    /**
     * Last name of the buyer
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Last name of the buyer
     *
     * @param string|null $lastName The maximum length is 128 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setLastName(?string $lastName): void
    {
        if ($lastName && strlen($lastName) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "lastName", 128));

        $this->lastName = $lastName;
    }

    /**
     * Email address of the buyer
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Email address of the buyer
     *
     * @param string $email The maximum length is 256 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setEmail(string $email): void
    {
        if (strlen($email) > 256)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "email", 256));

        //todo warto dodac sprawdzanie czy to email

        $this->email = $email;
    }
}