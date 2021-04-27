<?php
declare(strict_types=1);

namespace DBI\CustomerOnline\ViewModel;

use DBI\CustomerOnline\Api\OnlineManagementInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CustomerOnline implements ArgumentInterface
{

    /**
     * @return string[]
     */
    public function getConfigData(): array
    {
        return [
            OnlineManagementInterface::STATUS_ONLINE,
            OnlineManagementInterface::STATUS_AWAY,
            OnlineManagementInterface::STATUS_OFFLINE
        ];
    }
}
