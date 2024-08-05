<?php

declare(strict_types=1);

namespace Macademy\Jumpstart\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    protected PageFactory $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    public function execute(): \Magento\Framework\View\Result\Page
    {
        return $this->pageFactory->create();
    }
}
