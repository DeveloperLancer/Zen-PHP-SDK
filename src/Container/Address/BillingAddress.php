<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\Zen\Container\Address;

use DevLancer\Zen\Exception\InvalidArgumentException;

class BillingAddress extends Address
{
    /**
     * @var string|null
     */
    private ?string $taxId = null;

    /**
     * @return string|null
     */
    public function getTaxId(): ?string
    {
        return $this->taxId;
    }

    /**
     * @param string|null $taxId The maximum length is 128 characters
     * @throws InvalidArgumentException When you exceed the maximum length
     */
    public function setTaxId(?string $taxId): void
    {
        if ($taxId && strlen($taxId) > 128)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "taxId", 128));


        $this->taxId = $taxId;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'country' =>  $this->getCountry(),
            'street' => $this->getStreet(),
            'city' => $this->getCity(),
            'countryState' => $this->getCountryState(),
            'province' => $this->getProvince(),
            'buildingNumber' => $this->getBuildingNumber(),
            'roomNumber' => $this->getRoomNumber(),
            'postcode' => $this->getPostcode(),
            'companyName' => $this->getCompanyName(),
            'phone' => $this->getPhone(),
            'taxId' => $this->getTaxId()
        ];
    }
}