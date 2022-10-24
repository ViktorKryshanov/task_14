<?php
abstract class User implements EventListenerInterface
{
    protected $id; 
    protected $name; 
    protected $role; 

    abstract function getTextsToEdit(); 
    abstract function attachEvent($method_name);
    abstract function detouchEvent($method_name);
}


require_once '/interfaces/EventListenerInterface.php';
require_once '/interfaces/LoggerInterface.php';
