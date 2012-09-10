<?php


class SiteHomeWebModule extends HomeWebModule {
   
    
    protected function initializeForPage() {
        $this->addExternalCSS('http://code.jquery.com/mobile/1.1.1/jquery.mobile.structure-1.1.1.min.css');
        $this->addExternalJavascript('http://code.jquery.com/jquery-1.8.1.min.js');
        $this->addExternalJavascript('http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js');
        
        parent::initializeForPage();
    }
}
