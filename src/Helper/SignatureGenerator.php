<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen\Helper;

use DevLancer\Zen\Container\CheckoutRequest;
use DevLancer\Zen\Exception\InvalidArgumentException;

/**
 *
 */
class SignatureGenerator
{
    /**
     * @param string $paywallSecret
     * @param CheckoutRequest $container
     * @return string
     * @throws InvalidArgumentException
     */
    public static function generate(string $paywallSecret, CheckoutRequest $container): string
    {
        $data = $container->jsonSerialize();
        $data = self::removeNullValues($data);

        $result = self::parse($data);
        $result .= $paywallSecret;
        $algo = "sha256";
        $hash = hash($algo, $result);

        return sprintf("%s;%s", $hash, $algo);
    }

    /**
     * @param array $data
     * @return array
     */
    public static function removeNullValues(array $data): array
    {
        foreach ($data as $item => &$value) {
            if (is_null($value)) {
                unset($data[$item]);
                continue;
            }

            if (is_array($value)) {
                $value = self::removeNullValues($value);

                if ($value == [])
                    unset($data[$item]);
            }
        }

        return $data;
    }

    /**
     * @param array $data
     * @return string
     */
    public static function parse(array $data): string
    {
        $result = [];
        foreach ($data as $key => $item) {
            if (!is_array($item)) {
                $result[] = strtolower(sprintf('%s=%s', $key, $item));
                continue;
            }

            foreach ($item as $index => $value) {
                if (!is_array($value)) {
                    $result[] = strtolower(sprintf('%s.%s=%s', $key, $index, $value));
                    continue;
                }

                foreach ($value as $name => $val)
                    $result[] = strtolower(sprintf('%s[%s].%s=%s', $key, $index, $name, $val));
            }
        }


        sort($result);
        return implode("&", $result);
    }
}