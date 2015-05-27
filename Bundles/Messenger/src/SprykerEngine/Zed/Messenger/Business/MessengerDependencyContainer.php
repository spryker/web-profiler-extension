<?php

namespace SprykerEngine\Zed\Messenger\Business;

use SprykerEngine\Zed\Kernel\Business\AbstractDependencyContainer;
use SprykerEngine\Zed\Messenger\Business\Model\MessengerInterface;

class MessengerDependencyContainer extends AbstractDependencyContainer
{

    /**
     * @return MessengerInterface
     */
    public function getMessenger()
    {
        return $this->messenger = $this->getFactory()->createModelMessenger();
    }

}
