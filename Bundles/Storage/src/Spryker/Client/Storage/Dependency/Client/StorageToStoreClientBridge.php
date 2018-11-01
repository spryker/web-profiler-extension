<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Storage\Dependency\Client;

class StorageToStoreClientBridge implements StorageToStoreClientInterface
{
    /**
     * @var \Spryker\Shared\Kernel\Store
     */
    protected $storeInstance;

    /**
     * @param \Spryker\Shared\Kernel\Store $storeInstance
     */
    public function __construct($storeInstance)
    {
        $this->storeInstance = $storeInstance;
    }

    /**
     * @return string
     */
    public function getStoreName(): string
    {
        return $this->storeInstance->getStoreName();
    }

    /**
     * @return string
     */
    public function getCurrentLocale(): string
    {
        return $this->storeInstance->getCurrentLocale();
    }
}
