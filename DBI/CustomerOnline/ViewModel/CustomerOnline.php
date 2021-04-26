<?php
declare(strict_types=1);

namespace DBI\CustomerOnline\ViewModel;

use DBI\CustomerOnline\Api\OnlineManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CustomerOnline implements ArgumentInterface
{
    /**
     * @var Session
     */
    private Session $customerSession;

    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;

    /**
     * OnlineManagement constructor.
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        Session $customerSession
    ) {
        $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
    }

    /**
     * Get customer online status
     *
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCustomerOnlineStatus(): string
    {
        $customerId = $this->customerSession->getCustomer()->getId();
        $onlineStatus = '';

        if ($customerId) {
            $customer = $this->customerRepository->getById($customerId);
            $onlineStatus = $customer->getCustomAttribute('online_status')->getValue();
        }

        return $onlineStatus;
    }

    /**
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return $this->customerSession->isLoggedIn();
    }

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
