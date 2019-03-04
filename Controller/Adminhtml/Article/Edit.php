<?php
/**
 * class Edit
 *
 * @category  Slavik\Blog\Controller\Adminhtml\Article;
 * @package   Slavik\Blog
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2019 Stanislav Lelyuk
 */

namespace Slavik\Blog\Controller\Adminhtml\Article;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Slavik\Blog\Model\ArticleFactory;
use Slavik\Blog\Model\ArticleRepository;

class Edit extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;
    /**
     * @var Registry
     */
    protected $_registry;
    /**
     * @var ArticleFactory
     */
    protected $articleFactory;
    /**
     * @var ArticleRepository
     */
    protected $articleRepository;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param ArticleFactory $articleFactory
     * @param ArticleRepository $articleRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        ArticleFactory $articleFactory,
        ArticleRepository $articleRepository
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_registry = $registry;
        $this->articleFactory = $articleFactory;
        parent::__construct($context);
        $this->articleRepository = $articleRepository;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Slavik_Blog::Article')
            ->addBreadcrumb(__('Articles'), __('Articles'))
            ->addBreadcrumb(__('Manage Articles'), __('Manage Articles'));
        return $resultPage;
    }
    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $article = $this->articleFactory->create();
        $resultPage = $this->_initAction();
        //var_dump($this->getRequest()->getParam('id'));
        //die();
        $id = $this->getRequest()->getParam('id');
        if($id){
            $article=$this->articleRepository->getById($id);
            if (!$article){
                $this->messageManager->addErrorMessage(__('this article not exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();$resultPage->addBreadcrumb(
                    $id ? __('Edit Article') : __('New Article'),
                    $id ? __('Edit Article') : __('New Article')
                );
                $this->_registry->register('slavik_article', $article);
                $resultPage->getConfig()->getTitle()->prepend(__('Articles'));
                $resultPage->getConfig()->getTitle()->prepend($article->getName());
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_registry->register('slavik_article', $article);
        //var_dump($resultPage);
      // die();
        return $resultPage;
    }
}