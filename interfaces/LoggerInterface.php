<?php


interface LoggerInterface
{
    public function logMessage($error_text);
    public function lastMessages($number_of_messages);
}


