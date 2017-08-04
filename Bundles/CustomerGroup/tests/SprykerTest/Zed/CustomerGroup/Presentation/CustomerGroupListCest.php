<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\CustomerGroup\Presentation;

use SprykerTest\Zed\CustomerGroup\PageObject\CustomerGroupListPage;
use SprykerTest\Zed\CustomerGroup\PresentationTester;

/**
 * Auto-generated group annotations
 * @group SprykerTest
 * @group Zed
 * @group CustomerGroup
 * @group Presentation
 * @group CustomerGroupListCest
 * Add your own group annotations below this line
 */
class CustomerGroupListCest
{

    /**
     * @param \SprykerTest\Zed\CustomerGroup\PresentationTester $i
     *
     * @return void
     */
    public function breadcrumbIsVisible(PresentationTester $i)
    {
        $i->amOnPage(CustomerGroupListPage::URL);

        $i->seeBreadcrumbNavigation('Dashboard / Customers / Customer Groups');
    }

    /**
     * @param \SprykerTest\Zed\CustomerGroup\PresentationTester $i
     *
     * @return void
     */
    public function showListOfCustomerGroup(PresentationTester $i)
    {
        $i->amOnPage(CustomerGroupListPage::URL);
        $i->seeElement(CustomerGroupListPage::SELECTOR_TABLE);
    }

}