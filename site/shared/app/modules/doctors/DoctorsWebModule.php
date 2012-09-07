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
    private function getSpecialties() {
        $controller = $this->getFeed('Specialties');
        $specialties = array(''=>'-All-');     
        $controller->setOption('sort', 'name');     
        foreach ($controller->items()['resources'] as $specialty) {
          $specialties[$specialty['@url']] = $specialty['name'];
        }
        return $specialties;
    }
    
    private function getLocations() {
        $controller = $this->getFeed('Locations');
        $locations = array();     
        $controller->setOption('sort', 'name');     
        foreach ($controller->items()['resources'] as $location) {
          $locations[$location['@url']] = $location['name'];
        }
        return $locations;
    }
    
    protected function initializeForPage() {
    
      $controller = $this->getFeed('Doctors');
      $this->addExternalCSS('http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css');
      $this->addExternalJavascript('http://code.jquery.com/jquery-1.8.1.min.js');
      $this->addExternalJavascript('http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js');
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
            
            

            $this->assign('specialties', $this->getSpecialties());
          break;
          case 'search':
          case 'search_listings':
   
            $maxPerPage = $this->getOptionalModuleVar('MAX_RESULTS', 10);
            $page = $this->getArg('page', 1);

            $controller->setStart($page);
            $controller->setLimit($maxPerPage);
            $controller->setOption('sort', 'last_name');
     
            $query = BedrockQuery::build();
            $query->add_like_filter('address.city', $this->getArg('city'));
            $query->add_like_filter('first_name', $this->getArg('first_name'));
            $query->add_like_filter('last_name', $this->getArg('last_name'));
            
            $query->add_exact_filter('specialties.url', $this->getArg('specialty'));
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
            
            $this->assign('specialties', $this->getSpecialties());
            $this->assign('locations', $this->getLocations());
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
                $this->assign('item', $item);
                $this->assign('specialties', $this->getSpecialties());
                $this->assign('locations', $this->getLocations());
                $saveUrl = $this->getModuleVar('BASE_URL', 'Doctors', 'feeds');
                $saveUrl = $saveUrl .'/'.$this->getArg('id').'.json';
                $this->assign('saveUrl', $saveUrl);
                $this->setPageTitle($item['first_name'].' '.$item['last_name']);
            } else {
                $this->redirectTo('index');
            }
            break;
  
        }
    }
 }
