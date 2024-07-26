<?php
declare(strict_types=1);
namespace ThemeDev\Checkout\Block;

use Magento\Checkout\Block\Checkout\AttributeMerger;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Customer\Model\AttributeMetadataDataProvider;
use Magento\Eav\Api\Data\AttributeInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\Form\AttributeMapper;

class LayoutProcessor implements  LayoutProcessorInterface
{   /**
      * @var AttributeMerger
   */
     private AttributeMerger $merger;

    /**
     * @var AttributeMapper
     */
    private AttributeMapper $attributeMapper;
    /**
     * @var AttributeMetadataDataProvider
     */
    private AttributeMetadataDataProvider $attributeMetadataDataProvider;
    public function __construct(
        AttributeMetadataDataProvider $attributeMetadataDataProvider,
        AttributeMerger $merger,
        AttributeMapper $attributeMapper
    ){
        $this->attributeMetadataDataProvider = $attributeMetadataDataProvider;
        $this->merger = $merger;
        $this->attributeMapper = $attributeMapper;
    }

    /**
     * @throws LocalizedException
     */
    public function process($jsLayout): array
    {
        //load attributes from database
        $elements=$this->getAddressAttributes();
        //get fields configuration of our step
        $fields=$jsLayout['components']['checkout']['children']['steps']['children']['contact-step']['children']['contact']['children']['contact-fieldset']['children'];
        $fieldCodes=array_keys($fields);
        $elements=array_filter($elements,function($key) use ($fieldCodes){
             return in_array($key, $fieldCodes);
        },ARRAY_FILTER_USE_KEY);
        //merge attribute config and fields config
        $fields=$this->merger->merge(
            $elements,
            "checkoutProvider",
            "contact",
            $fields
        );
        return $jsLayout;
    }

    /**
     * @throws LocalizedException
     */
    private function getAddressAttributes():array{
        /**
         * @var AttributeInterface[] $attributes
         */
        $attributes=$this->attributeMetadataDataProvider->loadAttributesCollection(
              'customer_address',
              'customer_register_address'
        );
        $elements=[];
        foreach($attributes as $attribute){
            $code=$attribute->getAttributeCode();
            $elements[$code]=$this->attributeMapper->map($attribute);
            if(isset($elements[$code]['label'])){
                $label=$elements[$code]['label'];
                $elements[$code]['label']=__($label);
            }
        }
        return $elements;
    }
}
