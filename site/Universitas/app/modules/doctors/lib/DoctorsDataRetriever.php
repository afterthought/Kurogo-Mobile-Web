<?php

class DoctorsDataRetriever extends URLDataRetriever implements ItemDataRetriever
{
    protected $DEFAULT_PARSER_CLASS = 'JSONDataParser';
    public function getData(&$response=null) {
      $this->setUrl($this->baseUrl() .'.json');
      return parent::getData($response);
    }
    public function getItem($id, &$response = NULL) {
        $this->setUrl($this->baseUrl() .'/'.$id);
        $data = $this->getData();
        return $data;
    }
}