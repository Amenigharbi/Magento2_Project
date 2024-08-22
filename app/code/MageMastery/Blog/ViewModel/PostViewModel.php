<?php

declare(strict_types=1);

namespace MageMastery\Blog\ViewModel;

use MageMastery\Blog\Model\Post;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\StoreManagerInterface;

class PostViewModel implements ArgumentInterface
{
    public function __construct(
        private UrlInterface $url,
        private StoreManagerInterface $storeManager
    ) {}

    public function getPostUrl(Post $post): string
    {
        return $this->url->getBaseUrl() . 'blog/' . $post->getData('entity_id');
    }
    
    public function getFeaturedImageUrl(Post $post): string
    {
        $fileName = $post->getData('entity_id');

        
        return $fileName;
    }
}
