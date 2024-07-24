<?php

namespace AmeniMage\DealWithDb\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
   protected function _construct(){
       $this->_init(
           'AmeniMage\DealWithDb\Model\Post',
           'AmeniMage\DealWithDb\Model\ResourceModel\Post'
       );
   }
}
