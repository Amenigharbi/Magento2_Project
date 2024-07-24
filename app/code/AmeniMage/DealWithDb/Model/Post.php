<?php

namespace AmeniMage\DealWithDb\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
   public function _construct()
   {
       parent::_construct();
       $this->_init('AmeniMage\DealWithDb\Model\ResourceModel\Post');
   }


}
