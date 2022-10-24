<?php
class FileStorage extends Storage
{
    public function logMessage($error_text)
    {
        file_put_contents('error.log', $error_text . PHP_EOL, FILE_APPEND);
    }
    public function lastMessages($number_of_messages) 
    {
        // получаем содержимое файл с логами.
        $logs = file_get_contents('error.log');
        $logs = trim($logs);
        // превратим полученный контент в массив по строкам
        $arr = explode(PHP_EOL, $logs);
        // из этого массива мы получаем данные с конца
        $array = array_slice($arr, -2, $number_of_messages);
        // вернуть массив сообщений
        return $array;
    }
    public function attachEvent($method_name)
    {
        
    }
    public function detouchEvent($method_name)
    {

    }
    public function create($obj)
    {
        $now = new DateTime();
        $date = $now->format('Y-m-d');
        $slug = $obj->slug;
        $slug = explode('.', $slug);
        print_r($slug);
        $fileName = $slug[0] . '_' . $date . '.' . $slug[1];
        $i = 0;
        while (file_exists($fileName)) {
            $i++;
            $fileName = $slug[0] . '_' . $date .  '_' . $i . '.'  . $slug[1];
        }
        $obj->slug = $fileName;
        $serialize = serialize($obj);
        file_put_contents ($fileName, $serialize);
        return $fileName;
    }
    public function read($id, $slug) 
    {   
        if (file_exists($slug)) { 
            $serialize = file_get_contents($slug); 
            $obj = unserialize ($serialize); 
            return $obj;
        } 
        
    }
    public function update($id, $slug, $obj)
    {
        if (file_exists($slug)) {
            $serialize = serialize ($obj);
            file_put_contents ($slug, $serialize);
        }
    }
    public function delete($id, $slug)
    {
        if (file_exists($slug)) {
            unlink($slug);
        }
    }
    public function list()
    {
        $files = scandir(__DIR__);
        print_r($files);
        foreach ($files as $value) {
            $pos = strpos($value, '.txt');
            if ($pos != false) {
                echo $value;
                $serialize = file_get_contents($value); 
                $obj = unserialize ($serialize); 
                $files_true[] = $obj;
            }
        }
        return $files_true; 
    }
}