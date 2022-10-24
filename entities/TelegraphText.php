<?php
class TelegraphText 
{
    private $title; 
    private $text;
    private $author; 
    private $published; 
    private $slug; 
    // $telegraphText->author = 'viktor';
    // в $name поместиться "author"
    // в $value поместиться "viktor"
    public function __construct($author, $slug)
    {
        $this->author = $author;
        $this->slug = $slug;
        $this->published = date('Y-m-d H:i:s');
    }

    public function __set($name, $value) 
    {
        if ($name == 'author') {
            // if(strlen($value) > 120) return;
            // $this->author = $value;
            if (strlen($value) <= 120) {
                $this->author = $value;
        } 
    }
        if ($name == 'slug') {
            if(preg_match('~^[a-z0-9_\-]*$~i', $value)) { 
                $this->slug = $value;
            }
        }
        if ($name == 'published') {
            $now = new DateTime();
            if($this->published >= $now) {
                $this->published = $value;
            }
        }
        if ($name == 'text') {
            $this->text = $value;
            $this->storeText();
        }
    }

    public function __get($name) {
        if ($name == 'author') {
            return $this->author;
        }
        if ($name == 'slug') {
            return $this->slug;
        }
        if ($name == 'published') {
            return $this->published;
        }
        if ($name == 'text') {
            return $this->loadText();
        }
    }

    private function storeText() {
        $storeText = [
            'text' => $this->text, 
            'title' => $this->title, 
            'author' => $this->author, 
            'published' => $this->published
        ];
        $serialize = serialize($storeText);
        file_put_contents($this->slug, $serialize);
    }

    private function loadText()
    {
        $fileStorage = new FileStorage;
        $obj = $fileStorage->read(null, $this->slug);
        if (is_object($obj)) {
            $this->author = $obj->author;
            $this->text = $obj->text;
            $this->title = $obj->title;
            $this->published = $obj->published;
            return $this->text;
        } else {
            return false;
        }
    }
    
    public function editText($text, $title)
    {
        $this->text = $text;
        $this->title = $title;
    }
}

