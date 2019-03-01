<?php
/**
 * interface ArticleRepositoryInterface for all Article Repositories
 *
 * @category  Slavik\Blog\Api;
 * @package   Slavik\Blog
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2019 Stanislav Lelyuk
 */

namespace Slavik\Blog\Api;

use Slavik\Blog\Api\Data\ArticleInterface;

interface ArticleRepositoryInterface
{
    /**
     * Save article to db
     *
     * @param ArticleInterface $page
     * @return mixed
     */
    public function save(ArticleInterface $page);

    /**
     * Return article by it's id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * Delete article from db
     *
     * @param ArticleInterface $page
     * @return mixed
     */
    public function delete(ArticleInterface $page);

    /**
     * Delete article from db by it id
     *
     * @param $id
     * @return mixed
     */
    public function deleteById($id);

    /**
     * Get list of article instance bu searchCriteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
