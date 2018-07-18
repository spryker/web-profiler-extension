<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MinimumOrderValueGui\Communication\Form;

use Generated\Shared\Transfer\GlobalThresholdTransfer;
use Symfony\Component\HttpFoundation\Request;

interface FormDataProviderInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\GlobalThresholdTransfer
     */
    public function getData(Request $request): GlobalThresholdTransfer;

    /**
     * @return array
     */
    public function getOptions();
}
