<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen;

use DevLancer\Zen\Container\CheckoutNotification;
use DevLancer\Zen\Container\CheckoutRequest;
use DevLancer\Zen\Exception\InvalidArgumentException;
use DevLancer\Zen\Helper\HashGenerator;
use DevLancer\Zen\Helper\SignatureGenerator;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Checkout
{
    /**
     * @var string
     */
    public const PROD_REQUEST_URL = "https://secure.zen.com/api/checkouts";

    private HttpClientInterface $httpClient;

    /**
     * @param HttpClientInterface|null $httpClient
     */
    public function __construct(?HttpClientInterface $httpClient = null)
    {
        $this->httpClient = $httpClient ?? HttpClient::create();
    }

    /**
     * @param string $apiKey
     * @param string $paywallSecret
     * @param CheckoutRequest $container
     * @return ResponseInterface
     * @throws InvalidArgumentException
     * @throws TransportExceptionInterface
     */
    public function sendRequest(string $apiKey, string $paywallSecret, CheckoutRequest $container): ResponseInterface
    {
        $signature = SignatureGenerator::generate($paywallSecret, $container);
        $container = SignatureGenerator::removeNullValues($container->jsonSerialize());
        $container['signature'] = $signature;
        return $this->httpClient->request(
            'POST',
            self::PROD_REQUEST_URL,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $apiKey
                ],
                'body' => json_encode($container)
            ]
        );
    }

    /**
     * @param array<string, mixed> $payload
     * @return CheckoutNotification
     * @throws InvalidArgumentException
     */
    public function getNotification(array $payload): CheckoutNotification
    {
        return CheckoutNotification::generate($payload);
    }

    /**
     * @param string $ipnSecret
     * @param CheckoutNotification $container
     * @return bool
     */
    public function notificationIsValid(string $ipnSecret, CheckoutNotification $container): bool
    {
        $hash = HashGenerator::generateFromContainer($ipnSecret, $container);
        return $hash === $container->getHash();
    }
}