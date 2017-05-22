<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Functional\Spryker\Zed\Api\Business\Model\Processor\Post\Action;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\ApiMetaTransfer;
use Generated\Shared\Transfer\ApiPaginationTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ApiResponseTransfer;
use Spryker\Zed\Api\ApiConfig;
use Spryker\Zed\Api\Business\Model\Processor\Post\Action\FindActionPostProcessor;

/**
 * @group Functional
 * @group Spryker
 * @group Zed
 * @group Api
 * @group Business
 * @group Model
 * @group Processor
 * @group Post
 * @group Action
 * @group FindActionPostProcessorTest
 */
class FindActionPostProcessorTest extends Test
{

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testProcessWithDefaultsPageOne()
    {
        $config = new ApiConfig();
        $processor = new FindActionPostProcessor($config);

        $apiRequestTransfer = new ApiRequestTransfer();
        $apiRequestTransfer->setResource('users');
        $apiRequestTransfer->setResourceAction(ApiConfig::ACTION_INDEX);

        $apiResponseTransfer = new ApiResponseTransfer();
        $apiResponseTransfer->setData(range(0, 19));
        $pagination = new ApiPaginationTransfer();
        $pagination->setPage(1);
        $pagination->setItemsPerPage(20);
        $pagination->setTotal(200);
        $pagination->setPageTotal(10);
        $apiResponseTransfer->setPagination($pagination);
        $apiResponseTransfer->setMeta(new ApiMetaTransfer());

        $apiResponseTransfer = $processor->process($apiRequestTransfer, $apiResponseTransfer);
        $this->assertSame(ApiConfig::HTTP_CODE_PARTIAL_CONTENT, $apiResponseTransfer->getCode());

        $apiPaginationTransfer = $apiResponseTransfer->getPagination();
        $this->assertSame('/api/rest/users?page=1', $apiPaginationTransfer->getFirst());
        $this->assertSame('/api/rest/users?page=10', $apiPaginationTransfer->getLast());
        $this->assertNull($apiPaginationTransfer->getPrev());
        $this->assertSame('/api/rest/users?page=2', $apiPaginationTransfer->getNext());

        $apiMetaTransfer = $apiResponseTransfer->getMeta();
        $expected = [
            'page' => 1,
            'pages' => 10,
            'records' => 20,
            'records_per_page' => 20,
            'records_total' => 200,
        ];
        $this->assertSame($expected, $apiMetaTransfer->getData());
    }

}