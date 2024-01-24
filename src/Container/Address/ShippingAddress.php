<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace DevLancer\Zen\Container\Address;

class ShippingAddress extends Address
{
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
            'phone' => $this->getPhone()
        ];
    }
}