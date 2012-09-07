<?php

/*
 * Copyright © 2010 - 2012 Modo Labs Inc. All rights reserved.
 *
 * The license governing the contents of this file is located in the LICENSE
 * file located at the root directory of this distribution. If the LICENSE file
 * is missing, please contact sales@modolabs.com.
 *
 */
includePackage('Bedrock');

class DoctorsWebModule extends WebModule
{
    protected static $defaultModel = 'BedrockDataModel';
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
        
        $controller = BedrockDataModel::factory($modelClass, $feedData);
        

        return $controller;
    }
    protected function initializeForPage() {
      
      $defaultFeed = key($this->feeds);
      $controller = $this->getFeed($defaultFeed);
      
      $this->addExternalCSS('http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css');
      // $this->addInternalJavascript('/common/javascript/lib/jquery-1.8.1.js');
      // $this->addInternalJavascript('/common/javascript/lib/jquery.mobile-1.1.1.js');
      
      $this->addExternalJavascript('http://code.jquery.com/jquery-1.7.1.min.js');
      $this->addExternalJavascript('http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js');
      switch ($this->page)
      {
          case 'index':
             
            $this->addInternalJavascript('/common/javascript/lib/jqm.autoComplete-1.4.1.js');
          
            $query = BedrockQuery::build();
            $query->add_distinct_filter('address.city', 'city');
            $cities = $controller->executeQuery($query);
            $cities = array_merge(array(''=>'-All-'), array_combine($cities['distinct_values'], $cities['distinct_values']));
            // KurogoDebug::debug($cities);
            $this->assign('cities', $cities);
            $this->assign('genders', array(''=>'-All-', 'Male'=>'Male', 'Female'=>'Female'));
          break;
          case 'search':
          case 'search_listings':
   
            $maxPerPage = $this->getOptionalModuleVar('MAX_RESULTS', 10);
            $page = $this->getArg('page', 1);

            $controller->setStart($page);
            $controller->setLimit($maxPerPage);
            $controller->setOption('sort', 'last_name');
            $this->setLogData($defaultFeed, $controller->getTitle());

            $query = BedrockQuery::build();
            $query->add_like_filter('address.city', $this->getArg('city'));
            $query->add_like_filter('first_name', $this->getArg('first_name'));
            $query->add_like_filter('last_name', $this->getArg('last_name'));
            
            $query->add_exact_filter('gender', $this->getArg('gender'));
            $query->add_exact_filter('accepting_new_patients', $this->getArg('accepting_new_patients'));
    
                
        
            $items = $controller->executeQuery($query)['resources'];
            $totalItems = $controller->getTotalItems();
 
            $results = array();
            foreach ($items as $item) {
                $item['url'] = $this->buildBreadcrumbURL('detail', array('id'=>$item['id']));  
                $results[] = $item;  
             }
           
            $offset = $page * $maxPerPage;
            $moreURL = null;
       
            $args = $this->args;
            if (($totalItems - $offset)  > 0) {
                $args['page'] = $page + 1;
                $moreURL = $this->buildBreadcrumbURL('search_listings', $args, false);
            }
            
            $this->assign('results', $results);
            $this->assign('maxPerPage', $maxPerPage);
            $this->assign('moreURL', $moreURL);
           
          break;
         
         
          
          case 'detail':
            $this->addInternalCSS('/common/css/mercury.bundle.css');
            $this->addInternalJavascript('/common/javascript/lib/jquery-1.7.js');
            $this->addInternalJavascript('/common/javascript/lib/mercury.js');
            $this->addInternalJavascript('/common/javascript/lib/mercury_dialogs.js');
            $this->addInternalJavascript('/common/javascript/lib/mercury_loader.js');
            
            $id = $this->getArg('id');
                  
                  if ($item = $controller->getItem($id)['entry']) {
                    // KurogoDebug::debug($item);
                      $this->assign('first_name', $item['first_name']);
                      $this->assign('last_name', $item['last_name']);
                      $this->assign('gender', $item['gender']);
                      $this->assign('bio', $item['bio']);
                    
                      $this->assign('location', $item['location']);
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
