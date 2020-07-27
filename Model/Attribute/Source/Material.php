<?php
namespace Product\SampleAttribute\Model\Attribute\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Material extends AbstractSource
{
   public function getAllOptions()
   {
       // TODO: Implement getAllOptions() method.
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('Yes'), 'value' => 'Yes'],
                ['label' => __('No'), 'value' => 'No']
            ];
        }
        return $this->_options;
   }
}
