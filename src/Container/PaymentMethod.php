<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Container;

use DevLancer\Zen\Enum\PaymentChannelEnum;
use DevLancer\Zen\Enum\PaymentMethodEnum;

class PaymentMethod implements \JsonSerializable
{
    private PaymentMethodEnum $name;
    private PaymentChannelEnum $channel;

    /**
     * @var array<string, mixed>
     */
    private array $parameters;

    /**
     * @param string|PaymentMethodEnum $name
     * @param string|PaymentChannelEnum $channel
     * @param array<string, mixed> $parameters
     */
    public function __construct(string|PaymentMethodEnum $name, string|PaymentChannelEnum $channel, array $parameters = [])
    {
        if (is_string($name))
            $name = PaymentMethodEnum::from($name);

        if (is_string($channel))
            $channel = PaymentChannelEnum::from($channel);

        $this->name = $name;
        $this->channel = $channel;
        $this->parameters = $parameters;
    }

    /**
     * @return PaymentMethodEnum
     */
    public function getName(): PaymentMethodEnum
    {
        return $this->name;
    }

    /**
     * @return PaymentChannelEnum
     */
    public function getChannel(): PaymentChannelEnum
    {
        return $this->channel;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return array<string, string|array<string, mixed>>
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName()->value,
            'channel' => $this->getChannel()->value,
            'parameters' => $this->getParameters(),
        ];
    }
}