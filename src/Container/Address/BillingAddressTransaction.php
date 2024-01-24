<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Container\Address;

use DevLancer\Zen\Exception\InvalidArgumentException;

class BillingAddressTransaction extends BillingAddress
{
    private ?string $userId = null;

    /**
     * User's ID as provided by the merchant
     *
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * User's ID as provided by the merchant
     *
     * @param string|null $userId The maximum length is 64 characters
     * @throws InvalidArgumentException When you exceed the maximum length, or it does not follow the pattern: "^[a-zA-Z0-9_-]+$"
     */
    public function setUserId(?string $userId): void
    {
        if ($userId && strlen($userId) > 64)
            throw new InvalidArgumentException(sprintf("The maximum length of the %s variable is %d characters", "userId", 64));

        if ($userId && preg_match("/^[a-zA-Z0-9_-]+$/", $userId) === false)
            throw new InvalidArgumentException(sprintf("The value %s is invalid", $userId));

        $this->userId = $userId;
    }

    public function jsonSerialize(): array
    {
        $result = parent::jsonSerialize();
        $result['userId'] = $this->getUserId();
        return $result;
    }
}