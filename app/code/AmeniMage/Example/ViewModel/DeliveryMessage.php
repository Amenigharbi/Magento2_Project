<?php
namespace AmeniMage\Example\ViewModel;
class DeliveryMessage implements \Magento\Framework\View\Element\Block\ArgumentInterface{
    public function getDeliveryMessage(){
        $stock=random_int(1,10);
        if($stock<5){
            return "hurry it's running out";
        }
        return "this how it will be delivered";
    }
}
