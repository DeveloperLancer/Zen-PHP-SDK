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
class CustomerCheckoutNotification extends Customer
{
    private ?string $country;

    /**
     * @var null|string
     */
    private ?string $ip = null;

    /**
     * @param string|null $id
     * @param string|null $firstName First name of the buyer
     * @param string|null $lastName Last name of the buyer
     * @param string|null $email Email address of the buyer
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function __construct(?string $id = null, ?string $firstName = null, ?string $lastName = null, ?string $email = null)
    {
        $this->setId($id);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
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
     * @param string|null $email The maximum length is 256 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setEmail(?string $email): void
    {
        if ($email)
            parent::setEmail($email);
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        //todo dodac sprawdzanie $country

        $this->country = $country;
    }

    /**
     * Customer's IPv4 or IPv6
     *
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * Customer's IPv4 or IPv6
     *
     * @param null|string $ip
     */
    public function setIp(?string $ip): void
    {
        $this->ip = $ip;
    }

    public function jsonSerialize(): array
    {
        return [
            //'id' => $this->getId(), //todo w dokumentacji dla notyfikacji nie jest zwracane, ale sprawdzic czy gdy sie to poda w requescie, czy wtedy juz jest
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'email' =>  $this->getEmail(),
            'country' => $this->getCountry(),
            'ip' => $this->getIp()
        ];
    }
}