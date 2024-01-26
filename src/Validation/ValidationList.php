<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Validation;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationList
{
    /**
     * @var array<string, ConstraintViolationListInterface>
     */
    private array $list = [];

    /**
     * @param string $name
     * @param ConstraintViolationListInterface $item
     * @return void
     */
    public function add(string $name, ConstraintViolationListInterface $item): void
    {
        $this->list[$name] = $item;
    }

    /**
     * @param string $name
     * @return ConstraintViolationListInterface
     */
    public function get(string $name): ConstraintViolationListInterface
    {
        return $this->list[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->list[$name]);
    }

    /**
     * @return array<string, ConstraintViolationListInterface>
     */
    public function all(): array
    {
        return $this->list;
    }

    /**
     * @return int
     */
    public function countError(): int
    {
        $error = 0;
        foreach ($this->all() as $item)
            $error += count($item);

        return $error;
    }

    /**
     * @return array<string, ConstraintViolationListInterface>
     */
    public function getErrors(): array
    {
        $error = [];
        foreach ($this->all() as $key => $item) {
            if (count($item) == 0)
                continue;

            $error[$key] = $item;
        }

        return $error;
    }
}