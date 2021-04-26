<?php
declare(strict_types=1);

namespace DBI\CustomerOnline\Observer;

use Magento\Framework\Event\ObserverInterface;
use DBI\CustomerOnline\Api\OnlineManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class CustomerLogin implements ObserverInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;

    /**
     * CustomerLogin constructor.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Set online status after customer is login
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\State\InputMismatchException
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $customerId = $customer->getId();

        if ($customerId) {
            $customer = $this->customerRepository->getById($customerId);
            $customer->setCustomAttribute
            (
                'online_status',
                OnlineManagementInterface::STATUS_ONLINE
            );
            $this->customerRepository->save($customer);
        }
    }
}
