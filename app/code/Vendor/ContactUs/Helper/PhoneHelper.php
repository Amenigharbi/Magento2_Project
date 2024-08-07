<?php
namespace Vendor\ContactUs\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\NumberParseException;

class PhoneHelper extends AbstractHelper
{
    protected $phoneNumberUtil;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
        $this->phoneNumberUtil = PhoneNumberUtil::getInstance();
    }

    public function isValidNumber($phoneNumber, $regionCode = 'TN')
    {
        try {
            $parsedNumber = $this->phoneNumberUtil->parse($phoneNumber, $regionCode);
            return $this->phoneNumberUtil->isValidNumber($parsedNumber);
        } catch (NumberParseException $e) {
            return false;
        }
    }
}
