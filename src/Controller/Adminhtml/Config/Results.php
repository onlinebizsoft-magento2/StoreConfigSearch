<?php
/**
 *
 */

namespace Stroopwafel\StoreConfigSearch\Controller\Adminhtml\Config;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Stroopwafel\StoreConfigSearch\Model\Search;

class Results extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Stroopwafel_StoreConfigSearch::search';

    /**
     * @var Search
     */
    private $search;

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    // TODO: remove after testing
    protected $_publicActions = ['results'];

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        Search $search)
    {
        parent::__construct($context);
        $this->search      = $search;
        $this->jsonFactory = $jsonFactory;
    }


    public function execute()
    {
        $searchTerms   = $this->getRequest()->getParam('search_terms');
        $searchResults = $this->search->byKeyword($searchTerms);
        $results       = [
            'success'     => true,
            'num_results' => count($searchResults),
            'data'        => $searchResults
        ];

        return $this->jsonFactory->create()->setData($results);
    }
}
