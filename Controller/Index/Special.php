<?php
namespace Product\SampleAttribute\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class Special extends Action
{
    protected $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        // Tạo tiêu đề
        $resultPage->getConfig()->getTitle()->set(__('Special Products'));

        // Tạo breadcrumb
        /** @var \Magento\Theme\Block\Html\Breadcrumbs */
        if($resultPage->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbs = $resultPage->getLayout()->getBlock('breadcrumbs');
            $breadcrumbs->addCrumb('Home',
                [
                    'label' => __('Home'),
                    'title' => __('Home'),
                    'link' => $this->_url->getUrl('')
                ]
            );
            $breadcrumbs->addCrumb('Special Products',
                [
                    'label' => __('Special Products'),
                    'title' => __('Special Products')
                ]
            );
        }
        return $resultPage;
    }
}
