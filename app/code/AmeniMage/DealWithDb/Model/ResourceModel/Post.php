<?php

namespace AmeniMage\DealWithDb\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    protected function _construct(){
        $this->_init('AmeniMage_post','post_id');
    }
}
