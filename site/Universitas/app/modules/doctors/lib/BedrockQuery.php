<?php

class BedrockQuery 
{
    protected $filters = [];
    
    protected function init($args) {
        $this->filters = $args;
    }

    public function getFilters() {
      return $this->filters;
    }

    public function add_like_filter($field_name, $search_val) {
        if ($search_val == '') {
            return;
          }

        $this->filters[$field_name.'!match'] = '/'.$search_val.'/i';
        
    }
    
    public function add_exact_filter($field_name, $search_val) {
        if ($search_val == '') {
            return;
        }

        $this->filters[$field_name] = $search_val;
        
    }
    
 
    
    public static function build($filters=[])
    {
        $query = new BedrockQuery();   
        $query->init($filters);
        return $query;
    }
   
    
}