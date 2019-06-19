<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductQuantityStorage\Dependency\Service;

use Generated\Shared\Transfer\ProductQuantityTransfer;

class ProductQuantityStorageToProductQuantityServiceBridge implements ProductQuantityStorageToProductQuantityServiceInterface
{
    /**
     * @var \Spryker\Service\ProductQuantity\ProductQuantityServiceInterface
     */
    protected $productQuantityService;

    /**
     * @param \Spryker\Service\ProductQuantity\ProductQuantityServiceInterface $productQuantityService
     */
    public function __construct($productQuantityService)
    {
        $this->productQuantityService = $productQuantityService;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductQuantityTransfer $productQuantityTransfer
     * @param float $quantity
     *
     * @return float
     */
    public function getNearestQuantity(ProductQuantityTransfer $productQuantityTransfer, float $quantity): float
    {
        return $this->productQuantityService
            ->getNearestQuantity($productQuantityTransfer, $quantity);
    }

    /**
     * @return float
     */
    public function getDefaultMinimumQuantity(): float
    {
        return $this->productQuantityService->getDefaultMinimumQuantity();
    }

    /**
     * @return float
     */
    public function getDefaultInterval(): float
    {
        return $this->productQuantityService->getDefaultInterval();
    }
}
