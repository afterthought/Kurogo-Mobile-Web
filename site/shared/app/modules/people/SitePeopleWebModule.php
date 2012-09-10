<?php

includePackage('Bedrock');

class SitePeopleWebModule extends PeopleWebModule {

 
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
  
    protected function initializeForPage() {
        
        
 
        switch ($this->page) {
        
         
            case 'index':
            case 'pane':
                $controller = $this->getFeed('Contacts');
                  
                $controller->setOption('sort', 'index');   
                $contacts = $controller->items()['resources'];  

                $this->assign('contacts', $contacts);
                
                $this->setAutoPhoneNumberDetection(false);
                if ($this->getOptionalModuleVar('BOOKMARKS_ENABLED', 1)) {
                    $this->generateBookmarkLink();
                }
                $this->assign('feeds', $this->getSearchFeeds());
                $this->assign('placeholder', $this->getLocalizedString("SEARCH"));
                $this->assign('searchTip', $this->getOptionalModuleVar('SEARCH_TIP'));
                $this->assign('contactsSubTitleNewline', $this->getOptionalModuleVar('CONTACTS_SUBTITLE_NEWLINE', false));
                break;
            default:
                parent::initializeForPage();
        }  
    }
}
