<?php
/**
 * class ArticleRepository
 *
 * @category  Slavik\Blog\Model;
 * @package   Slavik\Blog
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2019 Stanislav Lelyuk
 */

namespace Slavik\Blog\Model;

use Slavik\Blog\Api\Data\ArticleInterface;
use Slavik\Blog\Api\ArticleRepositoryInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Slavik\Blog\Model\ResourceModel\Article as ObjectResourceModel;
use Slavik\Blog\Model\ResourceModel\Article\CollectionFactory;

class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * Article Factory
     *
     * @var \Slavik\Blog\Model\ArticleFactory
     */
    protected $objectFactory;

    /**
     * Object Resource Model
     *
     * @var \Slavik\Blog\Model\ResourceModel\Article
     */
    protected $objectResourceModel;

    /**
     * Collection Factory
     *
     * @var \Slavik\Blog\Model\ResourceModel\Article\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Search Result Interface Factory
     *
     * @var \Magento\Framework\Api\SearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * ArticleRepository constructor.
     * @param ArticleFactory $articleFactory
     * @param ObjectResourceModel $objectResourceModel
     * @param CollectionFactory $collectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ArticleFactory $articleFactory,
        ObjectResourceModel $objectResourceModel,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->objectFactory = $articleFactory;
        $this->objectResourceModel = $objectResourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Article to db
     *
     * @param ArticleInterface $object
     * @return mixed|ArticleInterface
     * @throws CouldNotSaveException
     */
    public function save(ArticleInterface $object)
    {
        try {
            $this->objectResourceModel->save($object);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $object;
    }

    /**
     * Return article by it's id
     *
     * @param $id
     * @return mixed Article
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {

        /** @var Article $object */
        $object = $this->objectFactory->create();
        $this->objectResourceModel->load($object, $id);
        if (!$object->getId()) {
            throw new NoSuchEntityException(__('Object with id "%1" does not exist.', $id));
        }
        return $object;
    }

    /**
     * Delete article from db
     *
     * @param ArticleInterface $object
     * @return bool|mixed
     * @throws CouldNotDeleteException
     */
    public function delete(ArticleInterface $object)
    {
        try {
            $this->objectResourceModel->delete($object);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * Delete article from db bi it's id
     *
     * @param $id
     * @return mixed
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * Get list of article instance by searchCriteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {

    }
}