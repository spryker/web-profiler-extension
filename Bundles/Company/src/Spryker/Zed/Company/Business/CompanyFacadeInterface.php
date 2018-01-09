<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Company\Business;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyFacadeInterface
{
    /**
     * Specification:
     * - Creates a company
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return int
     */
    public function create(CompanyTransfer $companyTransfer);

    /**
     * Specification:
     * - Finds a company by CompanyTransfer::idCompany in the transfer
     * - Updates fields in a company entity
     * - Updates relation to stores
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function update(CompanyTransfer $companyTransfer);

    /**
     * Specification:
     * - Finds a company by CompanyTransfer::idCompany in the transfer
     * - Deletes the company
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function delete(CompanyTransfer $companyTransfer);
}
