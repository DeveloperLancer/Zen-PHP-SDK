<?php declare(strict_types=1);

/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


use DevLancer\Zen\Checkout;
use DevLancer\Zen\Container\CheckoutNotification;
use DevLancer\Zen\Container\CheckoutRequest;
use DevLancer\Zen\Container\ItemCheckout;
use DevLancer\Zen\Enum\CurrencyEnum;
use DevLancer\Zen\Enum\StatusEnum;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\JsonMockResponse;

class CheckoutTest extends TestCase
{
    public function test__constructWithNull()
    {
        $checkout = new Checkout(null);
        $this->assertInstanceOf(Checkout::class, $checkout);
    }

    public function test__constructEmpty()
    {
        $checkout = new Checkout();
        $this->assertInstanceOf(Checkout::class, $checkout);
    }

    public function testSendRequestSuccessful()
    {
        $item = new ItemCheckout('name', "1", 1, "1.00");
        $container = new CheckoutRequest( '19b692d0-00b9-48f7-92ca-1509f055df2e', "1.00", 'PLN', 'merchantTransactionId', $item);
        $response = ['redirectUrl' => 'localhost'];
        $apiKey = "apiKey";
        $paywallSecret = "paywallSecret";

        $mockResponse = new JsonMockResponse($response);
        $mockHttpClient = new MockHttpClient($mockResponse);
        $checkout = new Checkout($mockHttpClient);
        $mockResponse = $checkout->sendRequest($apiKey, $paywallSecret, $container);

        $this->assertEquals($response, $mockResponse->toArray());
    }

    public static function NotificationIsValidProvider(): array
    {
        return [
            [
                new CheckoutNotification(
                    "feb78e88-47bc-428a-8ea4-806535aaf2de",
                    "PLN",
                    "100",
                    "PENDING",
                    "28EE6604A8A40ACC8B8CE0B8DE9AAC87A4E24BBF0388A48ED164E512C8073C7E"
                ),
            ],
            [
                new CheckoutNotification(
                    "feb78e88-47bc-428a-8ea4-806535aaf2de",
                    CurrencyEnum::from("PLN"),
                    "100",
                    StatusEnum::from("PENDING"),
                    "28EE6604A8A40ACC8B8CE0B8DE9AAC87A4E24BBF0388A48ED164E512C8073C7E"
                ),
            ]
        ];
    }

    /**
     * @dataProvider NotificationIsValidProvider
     */
    public function testNotificationIsValidSuccessful(CheckoutNotification $notification)
    {
        $mockResponse = new JsonMockResponse([]);
        $mockHttpClient = new MockHttpClient($mockResponse);
        $checkout = new Checkout($mockHttpClient);
        $result = $checkout->notificationIsValid("aeb8e7bf-0009-4f30-b521-1136fd336ae6", $notification);
        $this->assertTrue($result);
    }

    /**
     * @dataProvider NotificationIsValidProvider
     */
    public function testNotificationIsValidFail(CheckoutNotification $notification)
    {
        $mockResponse = new JsonMockResponse([]);
        $mockHttpClient = new MockHttpClient($mockResponse);
        $checkout = new Checkout($mockHttpClient);
        $result = $checkout->notificationIsValid("ipnSecret", $notification);
        $this->assertFalse($result);
    }
}
