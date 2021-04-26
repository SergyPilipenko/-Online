<?php
declare(strict_types=1);

namespace DBI\CustomerOnline\Model;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;

class OnlineManagement implements \DBI\CustomerOnline\Api\OnlineManagementInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;

    /**
     * @var Session
     */
    private Session $customerSession;

    /**
     * OnlineManagement constructor.
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        Session $customerSession
    )
    {
        $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
    }

    /**
     * Save customer attribute
     *
     * @param string $status
     */
    public function saveCustomerOnlineStatus(string $status): void
    {
        $customerId = $this->customerSession->getCustomer()->getId();

        if ($customerId) {
            $customer = $this->customerRepository->getById($customerId);
            $customer->setCustomAttribute('online_status', $status);
            $this->customerRepository->save($customer);
        }
    }
}
