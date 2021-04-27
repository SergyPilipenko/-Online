<?php
declare(strict_types=1);

namespace DBI\CustomerOnline\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\DataObject;
use Magento\Customer\Model\Session;

class OnlineData extends DataObject implements SectionSourceInterface
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
     * OnlineData constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param array $data
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        Session $customerSession,
        array $data = []
    )
    {
        $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
        parent::__construct($data);
    }

    /**
     * Get customer online status
     *
     * @return string[]
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getSectionData(): array
    {
        $customerId = $this->customerSession->getCustomer()->getId();
        $onlineStatus = '';

        if ($customerId) {
            $customer = $this->customerRepository->getById($customerId);
            $onlineStatus = $customer->getCustomAttribute('online_status')->getValue();
        }

        $isLoggedIn =  $this->customerSession->isLoggedIn();

        return ['status' => $onlineStatus, 'isLoggedIn' => $isLoggedIn];
    }
}
