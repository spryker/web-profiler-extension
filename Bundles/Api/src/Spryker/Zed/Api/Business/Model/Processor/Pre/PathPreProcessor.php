<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Api\Business\Model\Processor\Pre;

use Generated\Shared\Transfer\ApiRequestTransfer;
use Spryker\Zed\Api\ApiConfig;

/**
 * @method \Spryker\Zed\Api\Communication\ApiCommunicationFactory getFactory()
 * @method \Spryker\Zed\Api\Business\ApiFacade getFacade()
 */
class PathPreProcessor implements PreProcessorInterface
{

    const SERVER_DOCUMENT_URI = 'DOCUMENT_URI';

    /**
     * Maps the DOCUMENT_URI to the path omitting the base part.
     *
     * @param \Generated\Shared\Transfer\ApiRequestTransfer $apiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ApiRequestTransfer
     */
    public function process(ApiRequestTransfer $apiRequestTransfer)
    {
        $path = $apiRequestTransfer->getServerData()[static::SERVER_DOCUMENT_URI];
        if (strpos($path, ApiConfig::ROUTE_PREFIX_API_REST) === 0) {
            $path = substr($path, strlen(ApiConfig::ROUTE_PREFIX_API_REST));
        }

        $apiRequestTransfer->setPath($path);

        return $apiRequestTransfer;
    }

}