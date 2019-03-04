<?php
/**
 * class Save
 *
 * @category  Slavik\Blog\Controller\Adminhtml\Article;
 * @package   Slavik\Blog
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2019 Stanislav Lelyuk
 */

namespace Slavik\Blog\Controller\Adminhtml\Article;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Slavik\Blog\Model\ArticleFactory;
use Slavik\Blog\Model\ArticleRepository;

class Save extends Action
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;
    /**
     * @var ArticleFactory
     */
    private $articleFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param ArticleRepository $articleRepository
     * @param ArticleFactory $articleFactory
     */
    public function __construct(
        Action\Context $context,
        ArticleRepository $articleRepository,
        ArticleFactory $articleFactory
    ) {
        parent::__construct($context);
        $this->articleRepository = $articleRepository;
        $this->articleFactory = $articleFactory;
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
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            return $resultRedirect->setPath('*/*/');
        }
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $article = $this->articleRepository->getById($id);
        }
        else{
            $article=$this->articleFactory->create();
        }
        $article->setTitle($data['article_title']);
        $article->setContent($data['article_content']);
        $article->setAuthor($data['article_author']);
        try{
            $this->articleRepository->save($article);
            $this->messageManager->addSuccessMessage(__('Article saved'));
            if ($this->getRequest()->getParam('back')){
                return $resultRedirect->setPath("*/*/edit",['id' => $article->getId(),'_current'=>true]);
            }
            return $resultRedirect->setPath('*/*/');
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\RuntimeException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __('Something went wrong while saving the vendor'));
        }
        $this->_getSession()->setFormData($data);

        return $resultRedirect->setPath('*/*/edit', ['article_id' => $this->getRequest()->getParam('id')]);
    }
}