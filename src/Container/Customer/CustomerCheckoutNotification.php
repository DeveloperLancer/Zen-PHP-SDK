<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\Zen\Container\Customer;

class CustomerCheckoutNotification implements \JsonSerializable
{
    /**
     * @var string|null
     */
    private ?string $id;

    /**
     * @var string|null
     */
    private ?string $firstName;
    /**
     * @var string|null
     */
    private ?string $lastName;

    /**
     * @var string|null
     */
    private ?string $email;

    /**
     * @var string|null
     */
    private ?string $country;

    /**
     * @var null|string
     */
    private ?string $ip;

    public function __construct(?string $id = null, ?string $firstName = null, ?string $lastName = null, ?string $email = null, ?string $country = null, ?string $ip = null)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->country = $country;
        $this->ip = $ip;
    }

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
     */
    public function setFirstName(?string $firstName): void
    {
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
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * Email address of the buyer
     *
     * @param string $email The maximum length is 256 characters
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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

    /**
     * @return array<string, string|null>
     */
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