<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Offer\Business\Model\Hydrator;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\OfferTransfer;
use Spryker\Zed\Offer\Dependency\Service\OfferToUtilPriceServiceInterface;
use Spryker\Zed\Offer\OfferConfig;

class OfferSavingAmountHydrator implements OfferSavingAmountHydratorInterface
{
    /**
     * @var \Spryker\Zed\Offer\OfferConfig
     */
    protected $offerConfig;

    /**
     * @var \Spryker\Zed\Offer\Dependency\Service\OfferToUtilPriceServiceInterface
     */
    protected $utilPriceService;

    /**
     * @param \Spryker\Zed\Offer\OfferConfig $offerConfig
     * @param \Spryker\Zed\Offer\Dependency\Service\OfferToUtilPriceServiceInterface $utilPriceService
     */
    public function __construct(
        OfferConfig $offerConfig,
        OfferToUtilPriceServiceInterface $utilPriceService
    ) {
        $this->offerConfig = $offerConfig;
        $this->utilPriceService = $utilPriceService;
    }

    /**
     * @param \Generated\Shared\Transfer\OfferTransfer $offerTransfer
     *
     * @return \Generated\Shared\Transfer\OfferTransfer
     */
    public function hydrate(OfferTransfer $offerTransfer): OfferTransfer
    {
        $quoteTransfer = $offerTransfer->getQuote();

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $savingAmount = $this->getOriginUnitPrice($itemTransfer, $quoteTransfer->getPriceMode());
            $savingAmount -= $this->getUnitPrice($itemTransfer, $quoteTransfer->getPriceMode());
            $savingAmount += ($this->getUnitPrice($itemTransfer, $quoteTransfer->getPriceMode()) / 100 * $itemTransfer->getOfferDiscount());
            $savingAmount -= $itemTransfer->getOfferFee();
            $savingAmount *= $itemTransfer->getQuantity();
            $savingAmount = $this->roundPrice($savingAmount);

            $itemTransfer->setSavingAmount($savingAmount);
        }

        return $offerTransfer;
    }

    /**
     * @param float $price
     *
     * @return int
     */
    protected function roundPrice(float $price): int
    {
        return $this->utilPriceService->roundPrice($price);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param string $priceMode
     *
     * @return int
     */
    protected function getOriginUnitPrice(ItemTransfer $itemTransfer, $priceMode)
    {
        if ($priceMode === $this->offerConfig->getPriceModeGross()) {
            return $itemTransfer->getOriginUnitGrossPrice();
        }

        return $itemTransfer->getOriginUnitNetPrice();
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param string $priceMode
     *
     * @return int
     */
    protected function getUnitPrice(ItemTransfer $itemTransfer, $priceMode)
    {
        if ($priceMode === $this->offerConfig->getPriceModeGross()) {
            return $itemTransfer->getUnitGrossPrice();
        }

        return $itemTransfer->getUnitNetPrice();
    }
}
