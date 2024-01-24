<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevLancer\Zen;

use DevLancer\Zen\Container\TerminalRequest;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Terminal
{
    /**
     * @var string
     */
    public const PROD_REQUEST_URL = "https://api.zen.com/v2/terminals";

    private HttpClientInterface $httpClient;

    /**
     * @param HttpClientInterface|null $httpClient
     */
    public function __construct(?HttpClientInterface $httpClient = null)
    {
        if (!$httpClient)
            $this->httpClient = HttpClient::create();
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendRequest(string $apiKey, TerminalRequest $container): ResponseInterface
    {
        $query = $container->jsonSerialize();
        unset($query['request-id']);

        return $this->httpClient->request(
            'GET',
            self::PROD_REQUEST_URL,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'request-id' => $container->getRequestId(),
                ],
                'query' => $query
            ]
        );
    }
}