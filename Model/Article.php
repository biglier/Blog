<?php
/**
 * class Article
 *
 * @category  Slavik\Blog\Model;
 * @package   Slavik\Blog
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2019 Stanislav Lelyuk
 */

namespace Slavik\Blog\Model;

use Slavik\Blog\Api\Data\ArticleInterface;

class Article extends \Magento\Framework\Model\AbstractModel implements ArticleInterface, \Magento\Framework\DataObject\IdentityInterface
{

    const CACHE_TAG = 'slavik_article';

    /**
     * Init article
     */
    protected function _construct()
    {
        $this->_init('Slavik\Blog\Model\ResourceModel\Article');
    }

    /**
     * Return unique id of article
     *
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Return article title
     *
     * @return string/null
     */
    public function getTitle()
    {
        return $this->getData(self::ARTICLE_TITLE);
    }

    /**
     * Set article title
     *
     * @param $articleTitle
     * @return void
     */
    public function setTitle($articleTitle)
    {
        $this->setData(self::ARTICLE_TITLE, $articleTitle);
    }

    /**
     * Return article content
     *
     * @return string/null
     */
    public function getContent()
    {
        return $this->getData(self::ARTICLE_CONTENT);
    }

    /**
     * Set article content
     *
     * @param $articleContent
     * @return ArticleInterface|void
     */
    public function setContent($articleContent)
    {
        $this->setData(self::ARTICLE_CONTENT, $articleContent);
    }

    /**
     * Return article author
     *
     * @return string/null
     */
    public function getAuthor()
    {
        return $this->getData(self::ARTICLE_AUTHOR);
    }

    /**
     * Set article author
     *
     * @param $author
     * @return void
     */
    public function setAuthor($author)
    {
        $this->setData(self::ARTICLE_AUTHOR, $author);
    }
}