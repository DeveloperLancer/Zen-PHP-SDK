<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Container;

use ArrayIterator;

/**
 * @implements \IteratorAggregate<int, ItemCheckout>
 */
class ItemCheckoutCollection  implements \JsonSerializable, \Countable, \IteratorAggregate
{
    /**
     * @var ItemCheckout[] $items
     */
    private array $items = [];

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return array<int, ItemCheckout>
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     * @return ArrayIterator<int, ItemCheckout>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->all());
    }

    /**
     * @param ItemCheckout $itemCheckout
     * @return void
     */
    public function add(ItemCheckout $itemCheckout): void
    {
        $this->items[] = $itemCheckout;
    }

    /**
     * @param int $id
     * @return ItemCheckout|null
     */
    public function get(int $id): ?ItemCheckout
    {
        return $this->items[$id] ?? null;
    }

    /**
     * @param int|array<int> $id
     * @return void
     */
    public function remove(int|array $id): void
    {
        foreach ((array) $id as $n) {
            unset($this->items[$n]);
        }
    }

    /**
     * @return array<int, array<string, string|int|null>>
     */
    public function jsonSerialize(): array
    {
        $result = [];
        foreach ($this->all() as $item)
            $result[] = $item->jsonSerialize();

        return $result;
    }
}