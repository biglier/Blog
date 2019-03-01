<?php
/**
 * class Article
 *
 * @category  Slavik\Blog\Model\Vendor\ResourceModel;
 * @package   Slavik\Blog
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2019 Stanislav Lelyuk
 */

namespace Slavik\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Article extends AbstractDb
{
    /**
     *  Init Vendor
     */
    protected  function  _construct()
    {
        $this->_init('slavik_article','article_id');
    }
}