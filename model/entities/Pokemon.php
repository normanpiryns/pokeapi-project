<?php 

class Pokemon { 
    private $id;
    private $name;
    private $image;
    
    public function __construct ($id, $name, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
    }
    
    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }
    
    public function __set ($prop, $value) {
        if(property_exists($this, $prop)) {
            $this->$prop = $value;
        }
    } 
}

?> 