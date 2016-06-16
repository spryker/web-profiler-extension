<?php
/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOptionDiscountConnector\Communication\Plugin\Calculator;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Calculation\Dependency\Plugin\CalculatorPluginInterface;
use Spryker\Zed\Discount\Communication\Plugin\AbstractDiscountPlugin;

/**
 * @method \Spryker\Zed\ProductOptionDiscountConnector\Business\ProductOptionDiscountConnectorFacade getFacade()
 */
class DiscountTotalsWithProductOptionsCalculatorPlugin extends AbstractDiscountPlugin implements CalculatorPluginInterface
{

    /**
     * This plugin makes calculations based on the given quote. The result is added to the quote.
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function recalculate(QuoteTransfer $quoteTransfer)
    {
        $this->getFacade()->recalculateDiscountTotalsWithProductOptions($quoteTransfer);
    }

}
