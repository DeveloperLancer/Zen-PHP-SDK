<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Container\Customer;

use DevLancer\Zen\Exception\InvalidArgumentException;

class CustomerTransaction extends Customer
{
    /**
     * @var string|null
     */
    private ?string $phone;

    /**
     * @param string $email Email address of the buyer
     * @param string $ip Customer's IPv4 or IPv6
     * @param string|null $firstName First name of the buyer
     * @param string|null $lastName Last name of the buyer
     * @param string|null $phone Customer's phone number
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function __construct(string $email, string $ip, ?string $firstName = null, ?string $lastName = null, ?string $phone = null)
    {
        $this->setEmail($email);
        $this->setIp($ip);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setPhone($phone);
    }

    /**
     * Email address of the buyer
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Customer's IPv4 or IPv6
     *
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * Customer's IPv4 or IPv6
     *
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * Customer's phone number
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Customer's phone number
     *
     * @param string|null $phone The maximum length is 64 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setPhone(?string $phone): void
    {
        if (strlen($phone) > 64)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "phone", 64));

        $this->phone = $phone;
    }

    public function jsonSerialize(): array
    {
        return [
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'email' =>  $this->getEmail(),
            'phone' => $this->getPhone(),
            'ip' => $this->getIp(),
        ];
    }
}