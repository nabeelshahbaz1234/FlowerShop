<?php
declare(strict_types=1);

namespace RLTSquare\TrainingTask\Block\Adminhtml;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;

class Attributes extends \Magento\Backend\Block\Template
{
    /**
     * @var OrderRepositoryInterface
     */
    public OrderRepositoryInterface $orderRepository;

    /**
     * Attributes constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param OrderRepositoryInterface $orderRepository
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        OrderRepositoryInterface                $orderRepository,
        array                                   $data = []
    ) {
        $this->orderRepository = $orderRepository;
        parent::__construct($context, $data);
    }

    /**
     * Returns current order object
     * @return bool|OrderInterface
     */
    public function getOrder(): bool|OrderInterface
    {
        try {
            $orderId = $this->getRequest()->getParam('order_id');
            return $this->orderRepository->get($orderId);
        } catch (NoSuchEntityException $e) {
            return false;
        }
    }
}
