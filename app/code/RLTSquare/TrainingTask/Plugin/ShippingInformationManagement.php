<?php
declare(strict_types=1);

namespace RLTSquare\TrainingTask\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;

/**
 * @class ShippingInformationManagement
 */
class ShippingInformationManagement
{
    /**
     * @var CartRepositoryInterface
     */
    public CartRepositoryInterface $cartRepository;

    /**
     * ShippingInformationManagement constructor.
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(
        CartRepositoryInterface $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Save custom field data to quote object
     * @param $subject
     * @param $cartId
     * @param $addressInformation
     * @return array
     * @throws NoSuchEntityException
     */
    public function beforeSaveAddressInformation($subject, $cartId, $addressInformation): array
    {
        $quote = $this->cartRepository->getActive($cartId);
        $deliveryNote = $addressInformation->getShippingAddress()->getExtensionAttributes()->getDeliveryNote();
        $quote->setDeliveryNote($deliveryNote);
        $this->cartRepository->save($quote);
        return [$cartId, $addressInformation];
    }
}
