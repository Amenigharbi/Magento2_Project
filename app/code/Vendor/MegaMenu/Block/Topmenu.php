<?php
namespace Vendor\MegaMenu\Block;

use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory; 
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Helper\Image as ImageHelper;

class Topmenu extends Template
{
    protected $_categoryFactory;
    protected $_categoryCollectionFactory;
    protected $_productCollectionFactory;
    protected $_imageHelper;

    public function __construct(
        Template\Context $context,
        CategoryFactory $categoryFactory,
        CategoryCollectionFactory $categoryCollectionFactory,
        ProductCollectionFactory $productCollectionFactory,
        ImageHelper $imageHelper, // Inject the ImageHelper
        array $data = []
    ) {
        $this->_categoryFactory = $categoryFactory;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_imageHelper = $imageHelper; // Assign ImageHelper
        parent::__construct($context, $data);
    }

    public function getCategories()
    {
        $category = $this->_categoryFactory->create();
        $rootCategoryId = 2; 
        return $category->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('is_active', 1)
            ->addAttributeToFilter('parent_id', $rootCategoryId)
            ->setOrder('position', 'ASC');
    }

    public function getCategoryProducts($categoryId)
    {
        $category = $this->_categoryFactory->create()->load($categoryId);
        $collection = $this->_productCollectionFactory->create(); 
        $collection->addCategoryFilter($category);
        $collection->addAttributeToSelect('*');
        $collection->setOrder('created_at', 'DESC'); 
        $collection->setPageSize(3); 
        return $collection;
    }

    public function getImageUrl($product)
    {
        return $this->_imageHelper->init($product, 'product_base_image')->getUrl();
    }
}
