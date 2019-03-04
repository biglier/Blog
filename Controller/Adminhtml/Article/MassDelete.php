<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 04.03.19
 * Time: 16:17
 */

namespace Slavik\Blog\Controller\Adminhtml\Article;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Slavik\Blog\Model\ArticleRepository;
use Slavik\Blog\Model\ResourceModel\Article\CollectionFactory;

class MassDelete extends\Magento\Backend\App\Action
{
    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    protected $filter;

    /**
     * Collection factory
     *
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ArticleRepository
     */
    protected $articleRepository;

    /**
     * MassDelete constructor.
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param ArticleRepository $articleRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ArticleRepository $articleRepository
    ){
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->articleRepository = $articleRepository;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
       $collection = $this->filter->getCollection($this->collectionFactory->create());
       $articleDeleted = 0;
       foreach ($collection->getItems() as $article)
       {
           $this->articleRepository->delete($article);
           $articleDeleted++;
       }

       if ($articleDeleted){
           $this->messageManager->addSuccessMessage(__('%1 articles was deleted', $articleDeleted));
       }
       return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
    }
}