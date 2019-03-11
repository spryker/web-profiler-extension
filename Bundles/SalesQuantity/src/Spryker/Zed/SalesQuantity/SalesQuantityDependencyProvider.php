<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SalesQuantity;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\SalesQuantity\Dependency\Facade\SalesQuantityToProductFacadeBridge;

/**
 * @method \Spryker\Zed\SalesQuantity\SalesQuantityConfig getConfig()
 */
class SalesQuantityDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';
    public const SERVICE_SALES_QUANTITY = 'SERVICE_SALESQ_QUANTITY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addProductFacade($container);
        $container = $this->addSalesQuantityService($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT] = function (Container $container) {
            return new SalesQuantityToProductFacadeBridge($container->getLocator()->product()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesQuantityService(Container $container): Container
    {
        $container[static::SERVICE_SALES_QUANTITY] = function (Container $container) {
            return $container->getLocator()->salesQuantity()->service();
        };

        return $container;
    }
}
