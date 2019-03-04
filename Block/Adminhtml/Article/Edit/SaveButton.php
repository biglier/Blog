<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 04.03.19
 * Time: 12:41
 */

namespace Slavik\Blog\Block\Adminhtml\Article\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save Post'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
        //var_dump($a);
    }
}