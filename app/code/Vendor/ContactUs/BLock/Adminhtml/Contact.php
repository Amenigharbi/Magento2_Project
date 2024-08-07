<?php
namespace Vendor\ContactUs\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Contact extends Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_contact';
        $this->_blockGroup = 'Vendor_ContactUs';
        $this->_headerText = __('Contact Us');
        $this->buttonList->add(
            'export_csv',
            [
                'label' => __('Export to CSV'),
                'onclick' => "setLocation('" . $this->getUrl('contactus/export/export') . "')",
                'class' => 'export'
            ]
        );
        parent::_construct();
    }
}
