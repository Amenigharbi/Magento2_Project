<?php

namespace AmeniMage\Example\Block;

use Magento\Framework\View\Element\Template;
class Example extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }
    public function subTitle():string {
        return "this is the sub title";
    }
    public function welcome():string{
        return "welcome Ameni to magento 2";
    }
    public function getNoteHtml(){
        return $this->getLayout()->createBlock(Note::class)->toHtml();

    }
}
