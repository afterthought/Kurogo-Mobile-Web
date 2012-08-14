<?php

/*
 * Copyright © 2010 - 2012 Modo Labs Inc. All rights reserved.
 *
 * The license governing the contents of this file is located in the LICENSE
 * file located at the root directory of this distribution. If the LICENSE file
 * is missing, please contact sales@modolabs.com.
 *
 */

class DoctorsWebModule extends WebModule
{
    protected static $defaultModel = 'DoctorsDataModel';
    protected $id='doctors'; 
    protected $feeds = array();

        
    protected function initialize() {
        $this->feeds = $this->loadFeedData();
    }
    protected function getFeed($feed=null) {
        $feed = isset($this->feeds[$feed]) ? $feed : nil;
        $feedData = $this->feeds[$feed];

 
        if (isset($feedData['CONTROLLER_CLASS'])) {
            $modelClass = $feedData['CONTROLLER_CLASS'];
        } else {
            $modelClass = isset($feedData['MODEL_CLASS']) ? $feedData['MODEL_CLASS'] : self::$defaultModel;
        }
        
        $controller = DoctorsDataModel::factory($modelClass, $feedData);
        

        return $controller;
    }
    protected function initializeForPage() {
      
      $defaultFeed = key($this->feeds);
      $controller = $this->getFeed($defaultFeed);
      
      
      switch ($this->page)
      {
         case 'index':
   
            $maxPerPage = $this->getOptionalModuleVar('MAX_RESULTS', 1);
            $start = $this->getArg('start', 0);

            $controller->setStart($start);
            $controller->setLimit(1);
    
            $this->setLogData($defaultFeed, $controller->getTitle());

            $items = $controller->items();
      
            $results = array();
            foreach ($items as $item) {
              $result = array(
                     'title'=> $item['first_name']['value'],
                     'subtitle'=> $item['email']['value'],
                     'url'=> $this->buildBreadcrumbURL('detail', array('id'=>$item['_id']))
                 );
                 $results[] = $result;
             }
            $this->assign('results', $results);
          break;
         
         
          
          case 'detail':
            $this->addInternalCSS('/common/css/mercury.bundle.css');
            $this->addInternalJavascript('/common/javascript/lib/jquery-1.7.js');
            $this->addInternalJavascript('/common/javascript/lib/mercury.js');
            $this->addInternalJavascript('/common/javascript/lib/mercury_dialogs.js');
            $this->addInternalJavascript('/common/javascript/lib/mercury_loader.js');
            
            $id = $this->getArg('id');
                  
                  if ($item = $controller->getItem($id)) {
                    
                      $this->assign('first_name', $item['first_name']);
                      $this->assign('last_name', $item['last_name']);
                      $this->assign('bio', $item['bio']);
                    
                      $this->assign('address', $item['address']);
                      $this->assign('head_shot', $item['head_shot']);
                      $saveUrl = $this->getModuleVar('BASE_URL', $defaultFeed, 'feeds');
                      $saveUrl = $saveUrl .'/'.$this->getArg('id').'.json';
                      $this->assign('saveUrl', $saveUrl);
                  } else {
                      $this->redirectTo('index');
                  }
                  break;
        
        }
    }
 }
