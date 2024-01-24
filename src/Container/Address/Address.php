<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\Zen\Container\Address;

use DevLancer\Zen\Exception\InvalidArgumentException;

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
     * @throws InvalidArgumentException When you exceed the maximum length, or it does not follow the pattern: "^[a-zA-Z0-9_-]+$"
     */
    public function setId(?string $id): void
    {
        if ($id && strlen($id) > 64)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "id", 64));

        if ($id && preg_match("/^[a-zA-Z0-9_-]+$/", $id) === false)
            throw new InvalidArgumentException(sprintf("The value %s is invalid", $id));

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
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setFirstName(?string $firstName): void
    {
        if ($firstName && strlen($firstName) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "firstName", 128));

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
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setLastName(?string $lastName): void
    {
        if ($lastName && strlen($lastName) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "lastName", 128));

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
     * @throws InvalidArgumentException When it does not follow the pattern: "^[A-Z]{2}$"
     */
    public function setCountry(?string $country): void
    {
        if ($country && preg_match("/^[A-Z]{2}$/", $country) === false)
            throw new InvalidArgumentException(sprintf("The value %s is invalid", $country));

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
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setCity(?string $city): void
    {
        if ($city && strlen($city) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "city", 128));

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
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setCountryState(?string $countryState): void
    {
        if ($countryState && strlen($countryState) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "countryState", 128));

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
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setProvince(?string $province): void
    {
        if ($province && strlen($province) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "province", 128));

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
     * @param string|null $buildingNumber The maximum length is 128 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setBuildingNumber(?string $buildingNumber): void
    {
        if ($buildingNumber && strlen($buildingNumber) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "buildingNumber", 128));

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
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setRoomNumber(?string $roomNumber): void
    {
        if ($roomNumber && strlen($roomNumber) > 32)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "roomNumber", 32));

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
     * @throws InvalidArgumentException When you exceed the maximum length, or it does not follow the pattern: "^[a-zA-Z0-9\s\-]+$"
     */
    public function setPostcode(?string $postcode): void
    {
        if ($postcode && strlen($postcode) > 10)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "postcode", 10));

        if ($postcode && (preg_match("/^[a-zA-Z0-9\s\-]+$/", $postcode) === false || strlen($postcode) < 1))
            throw new InvalidArgumentException(sprintf("The value %s is invalid", $postcode));


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
     * @throws InvalidArgumentException When you exceed the maximum length, or it does not follow the pattern: "^[a-zA-Z0-9\s\-]+$"
     */
    public function setCompanyName(?string $companyName): void
    {
        if ($companyName && strlen($companyName) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "companyName", 128));

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
     * @throws InvalidArgumentException When you exceed the maximum length, or it does not follow the pattern: "^[a-zA-Z0-9\s\-]+$"
     */
    public function setPhone(?string $phone): void
    {
        if ($phone && strlen($phone) > 64)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "phone", 64));

        if ($phone && (preg_match("/^[0-9\+]+$/", $phone) === false || strlen($phone) < 2))
            throw new InvalidArgumentException(sprintf("The value %s is invalid", $phone));

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
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setStreet(?string $street): void
    {
        if ($street && strlen($street) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "street", 128));


        $this->street = $street;
    }
}