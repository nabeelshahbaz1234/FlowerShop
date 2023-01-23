<?php
declare(strict_types=1);


namespace RLTSquare\TrainingTask\Console\Command;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderExport extends Command
{
    const ARG_NAME_CUSTOMER_ID = 'customer-id';

    private CollectionFactory $orderCollectionFactory;

    /**
     * @param string|null $name
     */
    public function __construct(
        CollectionFactory $orderCollectionFactory,
        string            $name = null
    ) {
        parent::__construct($name);
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('customer-order-export:run')
            ->setDescription('Customer Export order to ERP')
            ->addArgument(
                self::ARG_NAME_CUSTOMER_ID,
                InputArgument::REQUIRED,
                "Customer Id"
            );
    }

    /**
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $customerId = (int)$input->getArgument(self::ARG_NAME_CUSTOMER_ID);

        $customerOrder = $this->orderCollectionFactory->create()
            ->addFieldToFilter('customer_id', $customerId);
        $output->writeln(print_r($customerOrder->getData(), true));

        return 0;
    }
}
