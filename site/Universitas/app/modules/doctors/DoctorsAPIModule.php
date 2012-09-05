<?php



class DoctorsAPIModule extends APIModule
{
    protected $id = 'doctors';
    protected $vmin = 1;
    protected $vmax = 1;
    protected static $defaultModel = 'BedrockDataModel';
    protected $feeds = array();
       
   


    protected function getFeed($feed=null) {
        $feed = isset($this->feeds[$feed]) ? $feed : nil;
        $feedData = $this->feeds[$feed];
 
        if (isset($feedData['CONTROLLER_CLASS'])) {
            $modelClass = $feedData['CONTROLLER_CLASS'];
        } else {
            $modelClass = isset($feedData['MODEL_CLASS']) ? $feedData['MODEL_CLASS'] : self::$defaultModel;
        }
        
        $controller = BedrockDataModel::factory($modelClass, $feedData);
        

        return $controller;
    }
    
    public function initializeForCommand() {  
        $this->feeds = $this->loadFeedData();
        $defaultFeed = key($this->feeds);
        
        $controller = $this->getFeed($defaultFeed);
        
   
        switch ($this->command) {
            case 'autocomplete':
                $term = $this->getArg(array('term'));
                $field = $this->getArg(array('field'));
                if ($term && $field) {
                  $args = $this->args;
                  unset($args['term']);
                  unset($args['field']);
                  $args[$field.'!match'] = '/'.$term.'/i';

                  $query = BedrockQuery::build($args);
                  $items = $controller->executeQuery($query);
            
                  if(!$items)
                      $items = array();
                    	
                  $errorCode = $controller->getResponseCode();
                  if ($errorCode) {
                      // TODO decide on error title
                      $errorTitle = 'Warning';
                      $errorMsg = $controller->getResponseError();
                      $error = new KurogoError($errorCode, $errorTitle, $errorMsg);
                      $this->setResponseError($error);
                  }

                    
                  $this->setResponse($items);
                  $this->setResponseVersion(1);
                        
                } else {
                  $this->invalidCommand();
                  $this->setResponseVersion(1);
                }
                break;
                
           }
    }
}

