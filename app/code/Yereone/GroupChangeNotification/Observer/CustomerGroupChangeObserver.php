<?php
namespace Yereone\GroupChangeNotification\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\ScopeInterface;
use Psr\Log\LoggerInterface;

class CustomerGroupChangeObserver implements ObserverInterface
{
    protected $transportBuilder;
    protected $groupRepository;
    protected $scopeConfig;

    function __construct(
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Customer\Api\GroupRepositoryInterface $groupRepository,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        LoggerInterface $logger
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->groupRepository = $groupRepository;
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            $customer = $observer->getCustomerDataObject();
            $customerOld = $observer->getOrigCustomerDataObject();
            $newGroupId = $customer->getGroupId();
            $oldGroupId = $customerOld->getGroupId();
            if ($newGroupId !== $oldGroupId) {
                $newGroup = $this->groupRepository->getById($newGroupId);
                $newGroupName = $newGroup->getCode();
                $oldGroup = $this->groupRepository->getById($oldGroupId);
                $oldGroupName = $oldGroup->getCode();
                $firstName = $customer->getFirstName();
                $customerEmail = $customer->getEmail();
                $email = $this->scopeConfig->getValue('trans_email/ident_general/email',ScopeInterface::SCOPE_STORE);
                $name  = $this->scopeConfig->getValue('trans_email/ident_general/name',ScopeInterface::SCOPE_STORE);

                $transport = $this->transportBuilder
                        ->setTemplateIdentifier('change_customer_group')
                        ->setTemplateOptions(
                                [
                                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                                ]
                        )
                        ->setTemplateVars(
                                [
                                        'first_name' => $firstName,
                                        'new_group' => $newGroupName,
                                        'old_group' => $oldGroupName
                                ]
                        )
                        ->setFrom(['name' => $name,'email' => $email])
                        ->addTo($customerEmail)
                        ->getTransport();

                $transport->sendMessage();
            }

            return $this;

        } catch (\Exception $e) {
            $this->logger->critical($e);
        }

    }
}