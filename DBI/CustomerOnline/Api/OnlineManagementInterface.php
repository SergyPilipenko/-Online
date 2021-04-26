<?php
declare(strict_types=1);

namespace DBI\CustomerOnline\Api;

interface OnlineManagementInterface
{
    const STATUS_ONLINE = 'Online';
    const STATUS_AWAY = 'Away';
    const STATUS_OFFLINE = 'Offline';

    /**
     * @param string $status
     * @return mixed
     */
    public function saveCustomerOnlineStatus(string $status);
}
