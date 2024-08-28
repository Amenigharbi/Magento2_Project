<?php
namespace Magento\Sales\Api\Data;

/**
 * Extension class for @see \Magento\Sales\Api\Data\OrderItemInterface
 */
class OrderItemExtension extends \Magento\Framework\Api\AbstractSimpleObject implements OrderItemExtensionInterface
{
    /**
     * @return \Magento\GiftMessage\Api\Data\MessageInterface|null
     */
    public function getGiftMessage()
    {
        return $this->_get('gift_message');
    }

    /**
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @return $this
     */
    public function setGiftMessage(\Magento\GiftMessage\Api\Data\MessageInterface $giftMessage)
    {
        $this->setData('gift_message', $giftMessage);
        return $this;
    }

    /**
     * @return \Magento\Tax\Api\Data\OrderTaxItemInterface[]|null
     */
    public function getItemizedTaxes()
    {
        return $this->_get('itemized_taxes');
    }

    /**
     * @param \Magento\Tax\Api\Data\OrderTaxItemInterface[] $itemizedTaxes
     * @return $this
     */
    public function setItemizedTaxes($itemizedTaxes)
    {
        $this->setData('itemized_taxes', $itemizedTaxes);
        return $this;
    }
}
