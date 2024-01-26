<?php declare(strict_types=1);
/**
 * @author Jakub Gniecki <kubuspl@onet.eu>
 * @copyright
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Container;

use DevLancer\Zen\Container\ItemCheckout;
use PHPUnit\Framework\TestCase;

class ItemCheckoutTest extends TestCase
{

    public function testValidationSuccessful()
    {
        $item = new ItemCheckout("name", "0.49", 2, "0.98");
        $validationList = $item->validation();
        $this->assertEquals(0, $validationList->countError());
    }

    public function testValidationTooShortName()
    {
        $item = new ItemCheckout("", "0.49", 2, "0.98");
        $validationList = $item->validation();
        $this->assertCount(1, $validationList->get('name'));
    }
    public function testValidationTooLongName()
    {
        $name = str_repeat("a", 129);
        $item = new ItemCheckout($name, "0.49", 2, "0.98");
        $validationList = $item->validation();
        $this->assertCount(1, $validationList->get('name'));
    }

    public function testValidationPriceEmpty()
    {
        $item = new ItemCheckout("name", "", 2, "0.98");
        $validationList = $item->validation();
        $this->assertCount(1, $validationList->get('price'));
    }
    public function testValidationBadPrice()
    {
        $item = new ItemCheckout("name", "0,49", 2, "0.98");
        $validationList = $item->validation();
        $this->assertCount(1, $validationList->get('price'));
    }


    public function testValidationQuantityEqualZero()
    {
        $item = new ItemCheckout("name", "0.49", 0, "0.98");
        $validationList = $item->validation();
        $this->assertCount(1, $validationList->get('quantity'));
    }

    public function testValidationLineAmountTotalEmpty()
    {
        $item = new ItemCheckout("name", "0.49", 2, "");
        $validationList = $item->validation();
        $this->assertCount(1, $validationList->get('lineAmountTotal'));
    }
    public function testValidationLineAmountTotalPrice()
    {
        $item = new ItemCheckout("name", "0.49", 2, "0,98");
        $validationList = $item->validation();
        $this->assertCount(1, $validationList->get('lineAmountTotal'));
    }
}
