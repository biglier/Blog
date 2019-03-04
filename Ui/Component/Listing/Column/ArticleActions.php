<?php
/**
 * class ArticleActions
 *
 * @category  Slavik\Blog\Component\Ui\Listing\Component\Column;
 * @package   Slavik\Blog
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2019 Stanislav Lelyuk
 */
namespace Slavik\Blog\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class ArticleActions extends Column
{
    const ROW_EDIT_URL = 'slavik_blog/article/edit';
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
    /**
     * Edit Url
     *
     * @var string
     */
    private $_editUrl;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::ROW_EDIT_URL
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->_editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
      /**  if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as $item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'slavik_blog/vendor/edit',
                        ['id' => $item['article_id']]
                    ),
                    'label' =>('Edit'),
                    'hidden' => false,
                ];
                /**      $item[$this->getData('name')]['delete'] = [
                'href' => $this->urlBuilder->getUrl(
                'slavik_elogic/vendor/delete',
                ['id' => $item['vendor_id']]
                ),
                'label' =>('Delete'),
                'hidden' => false,
                ];**/
                //var_dump($item);

          //  }
        //}
        // die();
        //var_dump($dataSource);
        //return $dataSource;
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['article_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl(
                            $this->_editUrl,
                            ['id' => $item['article_id']]
                        ),
                        'label' => __('Edit'),
                    ];
                }
            }
        }
        return $dataSource;
    }
}