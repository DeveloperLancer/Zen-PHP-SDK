<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\Zen\Container\Address;

use DevLancer\Zen\Validation\ValidationList;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

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
     */
    public function setTaxId(?string $taxId): void
    {
        $this->taxId = $taxId;
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

    public function validation(): ValidationList
    {
        $validator = Validation::createValidator();
        $validationList = parent::validation();
        $constraints = [new NotBlank(['allowNull' => true]), new Length(['max' => 128])];
        $validationList->add('taxId', $validator->validate($this->getTaxId(), $constraints));

        return $validationList;
    }
}