<?php

namespace AmeniMage\Example\Block\Widget;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
class ExampleTitle extends Template implements BlockInterface
{
   protected $_template = 'widget/exampletitle.phtml';
}
