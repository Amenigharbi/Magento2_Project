<?php

namespace AmeniMage\DealWithDb\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use AmeniMage\DealWithDb\Model\PostFactory;
class InstallData implements  InstallDataInterface
{
    private PostFactory $postFactory;
    public function __construct(PostFactory $postFactory){
        $this->postFactory = $postFactory;
       }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    { $data = [
        'title' => 'this is title',
        'content' => 'this is content'
    ];
        $post=$this->postFactory->create();
        $post->addData($data)->save();
    }


}
