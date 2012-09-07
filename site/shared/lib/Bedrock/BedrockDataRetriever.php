<?php

class BedrockDataRetriever extends URLDataRetriever implements ItemDataRetriever, SearchDataRetriever
{
    protected $DEFAULT_PARSER_CLASS = 'JSONDataParser';


    public function getItem($id, &$response = NULL) {
        $this->setUrl($this->baseUrl() .'/'.$id);
        $data = $this->getData();
        return $data;
    }
    public function search($searchString, &$response=null) {
        KurogoDebug::debug("not implemented yet");
         // $this->setUrl($this->baseUrl());       
         // KurogoDebug::debug($searchString);
         // $this->setOption('action', 'search');
         // 
         // $this->addFilter('q', $searchString);
         // $this->addFilter('output', 'fields');
         // if($this->feed){
         //     $this->addFilter('feed', $this->feed);    
         // }
         // 
         // return $this->getData($response);
     }
     

     
     public function executeQuery($filters, &$response=null) {    
          $this->setFilters($filters);
          

          
          return $this->getData($response);
      }
      
      public function getData(&$response=null) {

         if ($start = $this->getOption('start')) {
              $this->addFilter('page', $start);
          }
          if ($limit = $this->getOption('limit')) {
              $this->addFilter('per_page', $limit);
          }
          if ($sort = $this->getOption('sort')) {
              $this->addFilter('sort', $sort);
          }
          if ($order = $this->getOption('order')) {
              $this->addFilter('order', $order);
          }


          return parent::getData($response);
      }
      

    
}