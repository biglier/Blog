<?php
/**
 * class Collection
 *
 * @category  Slavik\Blog\Model\Article\ResourceModel\Article;
 * @package   Slavik\Blog
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2019 Stanislav Lelyuk
 */

namespace Slavik\Blog\Model\ResourceModel\Article;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'article_id';
    /**
     * Init Article
     */
    protected function _construct()
    {
        $this->_init('Slavik\Blog\Model\Article',
            'Slavik\Blog\Model\ResourceModel\Article');
    }
}
