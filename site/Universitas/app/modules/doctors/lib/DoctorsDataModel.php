<?php



/**
  * @package Doctors
  */
  
/**
  * @package Doctors
  */
includePackage('DataModel');
class DoctorsDataModel extends ItemListDataModel
{
    // protected $RETRIEVER_INTERFACE = 'PeopleRetriever';
    protected $DEFAULT_RETRIEVER_CLASS = 'DoctorsDataRetriever';
    protected $personClass = 'Person';



}
