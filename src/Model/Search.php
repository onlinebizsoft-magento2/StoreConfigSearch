<?php

namespace Stroopwafel\StoreConfigSearch\Model;

/**
 * Search the store config for keywords.
 *
 * @package Stroopwafel\StoreConfigSearch\Model
 */
class Search
{

    /**
     * @var \Magento\Config\Model\Config\Structure\Data
     */
    protected $structureData;


    public function __construct(
        \Magento\Config\Model\Config\Structure\Data $structureData
    )
    {
        $this->structureData = $structureData;
    }


    /**
     * Search the config for the given keyword.
     *
     * @param String $keyword
     */
    public function byKeyword($keyword)
    {
        $parser = new ParseConfig($this->structureData->get());

        $labels = $parser->getAllLabels();

        array_filter($labels, function($field) use ($keyword) {
            return (bool)preg_match("/{$keyword}/i", $field['label']);
        });
    }
}
