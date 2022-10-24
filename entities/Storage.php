<?php
abstract class Storage implements LoggerInterface, EventListenerInterface 
{
    abstract function create($obj); 
    abstract function read ($id, $slug); 
    abstract function update ($id, $slug, $obj); 
    abstract function delete ($id, $slug); 
    abstract function list(); 
    abstract function logMessage($error_text);
    abstract function lastMessages($number_of_messages);
    abstract function attachEvent($method_name);
    abstract function detouchEvent($method_name);
}

interface LoggerInterface
{
    public function logMessage($error_text);
    public function lastMessages($number_of_messages);
}
interface EventListenerInterface
{
    public function attachEvent($method_name);
    public function detouchEvent($method_name);
}

//require_once '../interfaces/EventListenerInterface.php';
require_once '../interfaces/LoggerInterface.php';

