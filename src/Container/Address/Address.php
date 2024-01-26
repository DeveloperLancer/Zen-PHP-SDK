<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\Zen\Container\Address;

use DevLancer\Zen\Validation\ValidationList;
use Symfony\Component\Validator\Constraints\Country;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;

abstract class Address implements \JsonSerializable
{
    /**
     * @var string|null
     */
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
    private ?string $street = null;

    /**
     * @var string|null
     */
    private ?string $country = null;

    /**
     * @var string|null
     */
    private ?string $city = null;

    /**
     * @var string|null
     */
    private ?string $countryState = null;

    /**
     * @var string|null
     */
    private ?string $province = null;

    /**
     * @var string|null
     */
    private ?string $buildingNumber = null;

    /**
     * @var string|null
     */
    private ?string $roomNumber = null;

    /**
     * @var string|null
     */
    private ?string $postcode = null;

    /**
     * @var string|null
     */
    private ?string $companyName = null;

    /**
     * @var string|null
     */
    private ?string $phone = null;

    /**
     * Customer's ID as provided by the merchant
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Customer's ID as provided by the merchant
     *
     * @param string|null $id The maximum length is 128 characters
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * Customer's firstname
     *
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Customer's firstname
     *
     * @param string|null $firstName The maximum length is 128 characters
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * Customer's lastname
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Customer's lastname
     *
     * @param string|null $lastName The maximum length is 128 characters
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * Country code
     *
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * Country code
     *
     * @param string|null $country
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * City name
     *
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * City name
     *
     * @param string|null $city The maximum length is 128 characters
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * Country state
     *
     * @return string|null
     */
    public function getCountryState(): ?string
    {
        return $this->countryState;
    }

    /**
     * Country state
     *
     * @param string|null $countryState The maximum length is 128 characters
     */
    public function setCountryState(?string $countryState): void
    {
        $this->countryState = $countryState;
    }

    /**
     * Province name
     *
     * @return string|null
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * Province name
     *
     * @param string|null $province The maximum length is 128 characters
     */
    public function setProvince(?string $province): void
    {
        $this->province = $province;
    }

    /**
     * Building number
     *
     * @return string|null
     */
    public function getBuildingNumber(): ?string
    {
        return $this->buildingNumber;
    }

    /**
     * Building number
     *
     * @param string|null $buildingNumber The maximum length is 32 characters
     */
    public function setBuildingNumber(?string $buildingNumber): void
    {
        $this->buildingNumber = $buildingNumber;
    }

    /**
     * Room number
     *
     * @return string|null
     */
    public function getRoomNumber(): ?string
    {
        return $this->roomNumber;
    }

    /**
     * Room number
     *
     * @param string|null $roomNumber The maximum length is 32 characters
     */
    public function setRoomNumber(?string $roomNumber): void
    {
        $this->roomNumber = $roomNumber;
    }

    /**
     * Post code
     *
     * @return string|null
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * Post code
     *
     * @param string|null $postcode The maximum length is 10 characters and minimum length is 1 character
     */
    public function setPostcode(?string $postcode): void
    {
        $this->postcode = $postcode;
    }

    /**
     * Company name
     *
     * @return string|null
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * Company name
     *
     * @param string|null $companyName The maximum length is 128 characters
     */
    public function setCompanyName(?string $companyName): void
    {
        $this->companyName = $companyName;
    }

    /**
     * Phone number
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Phone number
     *
     * @param string|null $phone The maximum length is 64 characters and minimum length is 2 characters
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * Street name
     *
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * Street name
     *
     * @param string|null $street The maximum length is 128 characters
     */
    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function validation(): ValidationList
    {
        $validator = Validation::createValidator();
        $validationList = new ValidationList();
        $constraints = [new NotBlank(['allowNull' => true]), new Length(['max' => 64]), new Regex("/^[a-zA-Z0-9_-]+$/")];
        $validationList->add('id', $validator->validate($this->getId(), $constraints));

        $constraints = [new NotBlank(['allowNull' => true]), new Length(['max' => 128])];
        $validationList->add('firstName', $validator->validate($this->getFirstName(), $constraints));
        $validationList->add('lastName', $validator->validate($this->getLastName(), $constraints));
        $validationList->add('street', $validator->validate($this->getStreet(), $constraints));
        $validationList->add('city', $validator->validate($this->getCity(), $constraints));
        $validationList->add('countryState', $validator->validate($this->getCountryState(), $constraints));
        $validationList->add('province', $validator->validate($this->getProvince(), $constraints));
        $validationList->add('companyName', $validator->validate($this->getCompanyName(), $constraints));

        $constraints = [new NotBlank(['allowNull' => true]), new Country()];
        $validationList->add('country', $validator->validate($this->getCountry(), $constraints));

        $constraints = [new NotBlank(['allowNull' => true]), new Length(['max' => 32])];
        $validationList->add('buildingNumber', $validator->validate($this->getBuildingNumber(), $constraints));
        $validationList->add('roomNumber', $validator->validate($this->getRoomNumber(), $constraints));

        $constraints = [new Length(['min' => 5, 'max' => 6])];
        $validationList->add('postcode', $validator->validate($this->getPostcode(), $constraints));

        $constraints = [new Length(['min' => 2, 'max' => 64]), new Regex("/^[0-9\+]+$/")];
        $validationList->add('phone', $validator->validate($this->getPhone(), $constraints));

        return $validationList;
    }
}