<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\Zen\Container\Customer;

use DevLancer\Zen\Validation\ValidationList;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

class CustomerCheckoutRequest implements \JsonSerializable
{
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
     * @param string|null $id
     * @param string|null $firstName First name of the buyer
     * @param string|null $lastName Last name of the buyer
     * @param string|null $email Email address of the buyer
     */
    public function __construct(?string $id = null, ?string $firstName = null, ?string $lastName = null, ?string $email = null)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
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
     * @param string $firstName The maximum length is 128 characters
     */
    public function setFirstName(string $firstName): void
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
     * @param string $lastName The maximum length is 128 characters
     */
    public function setLastName(string $lastName): void
    {
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
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return array<string, string|null>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'email' =>  $this->getEmail(),
        ];
    }

    public function validation(): ValidationList
    {
        $validator = Validation::createValidator();
        $validationList = new ValidationList();

        $constraints = [new NotBlank(['allowNull' => true])];
        $validationList->add('id', $validator->validate($this->getId(), $constraints));

        $constraints = [new NotBlank(['allowNull' => true]), new Email(), new Length(['max' => 256])];
        $validationList->add('email', $validator->validate($this->getEmail(), $constraints));

        $constraints = [new NotBlank(['allowNull' => true]), new Length(['max' => 256])];
        $validationList->add('firstName', $validator->validate($this->getFirstName(), $constraints));
        $validationList->add('lastName', $validator->validate($this->getLastName(), $constraints));

        return $validationList;
    }
}