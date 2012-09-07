<?php



/**
  * @package Bedrock
  */
  
/**
  * @package Bedrock
  */
includePackage('DataModel');
class BedrockDataModel extends ItemListDataModel
{
    protected $DEFAULT_RETRIEVER_CLASS = 'BedrockDataRetriever';

    public function executeQuery(BedrockQuery $query) {
        $items = $this->retriever->executeQuery($query->getFilters());
        if (isset($items["@total_resources"])) {
            $this->setTotalItems($items["@total_resources"]);
        }
        
        return $items;
    }
}
