<?php
declare(strict_types=1);

namespace RLTSquare\TrainingTask\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * @class Data
 */
class Data extends AbstractHelper
{
    /**
     * @return string
     */
    public function getCustomerGroup(): string
    {
        return (string)$this->scopeConfig->getValue(
            'customer_shop/flower/get_customer_list',
            ScopeInterface::SCOPE_STORE
        );
    }
}
