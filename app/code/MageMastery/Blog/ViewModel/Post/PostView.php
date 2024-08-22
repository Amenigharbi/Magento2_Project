<?php declare(strict_types=1);

namespace MageMastery\Blog\ViewModel\Post;

use MageMastery\Blog\Model\Post;
use MageMastery\Blog\Model\ResourceModel\Post\Collection;
use MageMastery\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\StoreManagerInterface;

class PostView implements ArgumentInterface
{
    public function __construct(
        private RequestInterface $request,
        private CollectionFactory $collectionFactory,
        private StoreManagerInterface $storeManager
    ) {
    }

    public function getPost(): Post
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('entity_id', (int)$this->request->getParam('entity_id'));

        return $collection->getFirstItem();
    }

    public function getFeaturedImageUrl(Post $post): string
    {
        $fileName = $post->getData('entity_id');

        

        return $fileName;
    }
}
