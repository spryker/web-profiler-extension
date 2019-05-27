<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\SalesMerchantConnector\Business;

use Codeception\Test\Unit;
use Generated\Shared\DataBuilder\ItemBuilder;
use Generated\Shared\Transfer\SpySalesOrderItemEntityTransfer;

/**
 * Auto-generated group annotations
 * @group SprykerTest
 * @group Zed
 * @group SalesMerchantConnector
 * @group Business
 * @group Facade
 * @group SalesMerchantConnectorFacadeTest
 * Add your own group annotations below this line
 */
class SalesMerchantConnectorFacadeTest extends Unit
{
    /**
     * @var \SprykerTest\Zed\SalesMerchantConnector\SalesMerchantConnectorBusinessTester
     */
    protected $tester;

    /**
     * @return void
     */
    public function testAddOrderReferencesAddsOrderItemReference(): void
    {
        //arrange
        $idSalesOrderItem = 1;
        $itemTransfer = (new ItemBuilder())->build();
        $salesOrderItemEntityTransfer = (new SpySalesOrderItemEntityTransfer())->setIdSalesOrderItem($idSalesOrderItem);

        //act
        $newSalesOrderItemEntityTransfer =
            $this->getFacade()->addOrderReferencesToSalesOrderItem($salesOrderItemEntityTransfer, $itemTransfer);

        //assert
        $this->assertEquals(md5($idSalesOrderItem), $newSalesOrderItemEntityTransfer->getOrderItemReference());
    }

    /**
     * @return void
     */
    public function testAddOrderReferencesDoesNotAddMerchantReferenceWhenNull(): void
    {
        //arrange
        $itemTransfer = (new ItemBuilder(['merchantReference' => null]))->build();
        $salesOrderItemEntityTransfer = new SpySalesOrderItemEntityTransfer();

        //act
        $newSalesOrderItemEntityTransfer =
            $this->getFacade()->addOrderReferencesToSalesOrderItem($salesOrderItemEntityTransfer, $itemTransfer);

        //assert
        $this->assertNull($newSalesOrderItemEntityTransfer->getMerchantReference());
    }

    /**
     * @return void
     */
    public function testAddOrderReferencesToSalesOrderItemAddsValueToDatabaseEntity(): void
    {
        //arrange
        $idSalesOrderItem = 1;
        $merchantReference = 'MER-12';
        $itemTransfer = (new ItemBuilder(['merchantReference' => $merchantReference]))->build();
        $salesOrderItemEntityTransfer = (new SpySalesOrderItemEntityTransfer())->setIdSalesOrderItem($idSalesOrderItem);

        //act
        $newSalesOrderItemEntityTransfer =
            $this->getFacade()->addOrderReferencesToSalesOrderItem($salesOrderItemEntityTransfer, $itemTransfer);

        //assert
        $this->assertEquals($merchantReference, $newSalesOrderItemEntityTransfer->getMerchantReference());
        $this->assertEquals(md5($idSalesOrderItem), $newSalesOrderItemEntityTransfer->getOrderItemReference());
    }

    /**
     * @return \Spryker\Zed\Kernel\Business\AbstractFacade|\Spryker\Zed\SalesMerchantConnector\Business\SalesMerchantConnectorFacadeInterface
     */
    protected function getFacade()
    {
        return $this->tester->getFacade();
    }
}
