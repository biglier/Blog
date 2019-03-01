<?php
/**
 * interface ArtcileInterface for all Article instances
 *
 * @category  Slavik\Blog\Api;
 * @package   Slavik\Blog
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2019 Stanislav Lelyuk
 */

namespace Slavik\Blog\Api\Data;

interface ArticleInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ARTICLE_ID = 'article_id';
    /**
     *
     */
    const ARTICLE_TITLE = 'title';
    /**
     *
     */
    const ARTICLE_AUTHOR = 'author';
    /**
     *
     */
    const ARTICLE_CONTENT = 'content';
    /**#@-*/

    /**
     * Return article_id
     *
     * @return int/null
     */
    public function getId();

    /**
     * Set article_id
     *
     * @param $id
     * @return ArticleInterface
     */
    public function setId($id);

    /**
     * Return article title
     *
     *
     * @return string/null
     */
    public function getTitle();

    /**
     * Set article title
     *
     *
     * @param $articleTitle
     * @return ArticleInterface
     */
    public function setTitle($articleTitle);

    /**
     * Return article content
     * ription
     *
     * @return string/null
     */
    public function getContent();

    /**
     * Set article content
     *
     * @param $articleContent
     * @return  ArticleInterface
     */
    public function setContent($articleContent);

    /**
     * Return article author
     *
     *
     * @return string/null
     */
    public function getAuthor();

    /**
     * Set article author
     *
     * @param $articleAuthor
     * @return ArticleInterface
     */
    public function setAuthor($articleAuthor);
}
