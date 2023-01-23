<?php
declare(strict_types=1);

namespace RLTSquare\TrainingTask\Block;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use RLTSquare\TrainingTask\Helper\Data;

/**
 * @class LayoutProcessor
 */
class LayoutProcessor implements LayoutProcessorInterface
{
    /**
     * @var Data
     */
    public Data $data;

    /**
     * @param Data $data
     */
    public function __construct(
        Data $data
    ) {
        $this->data = $data;
    }

    /**
     * Add custom field to checkout layout
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout): array
    {
        if ($this->data->getCustomerGroup() == 1) {
            $attributeCode = 'delivery_note';
            $fieldConfiguration = ['component' => 'Magento_Ui/js/form/element/textarea', 'config' => ['customScope' => 'shippingAddress.extension_attributes', 'customEntry' => null, 'template' => 'ui/form/field', 'elementTmpl' => 'ui/form/element/textarea', 'tooltip' => ['description' => 'Here you can leave delivery notes',],], 'dataScope' => 'shippingAddress.extension_attributes' . '.' . $attributeCode, 'label' => 'Flower Bucket Notes', 'provider' => 'checkoutProvider', 'sortOrder' => 1000, 'validation' => ['required-entry' => true], 'options' => [], 'filterBy' => null, 'customEntry' => null, 'visible' => true, 'value' => ''];

            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['shipping-address-fieldset']
            ['children'][$attributeCode] = $fieldConfiguration;
        }
        return $jsLayout;
    }
}
