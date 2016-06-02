<?php

class validate{
    private $_passed = false,
            $_errors = array(),
            $_db = null;
            
    public function __construct(){
        $this->_db = db::getInstance();
    }
    
    public function check($src, $items = array()){
        foreach ($items as $item => $rules){
            foreach ($rules as $rule => $rule_value){
                $item = escape($item);
                $value = $src[$item];
                
                if ($rule === 'required' && empty($value)){
                    $this->addError("{$item} cannot be left blank");
                } else if (!empty($value)){
                    switch($rule){
                        case 'min':
                            if (strlen($value) < $rule_value){
                                $this->addError("{$item} must be at least {$rule_value} characters long.");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value){
                                $this->addError("{$item} may be no more than {$rule_value} characters long.");
                            }
                            break;
                        case 'matches':
                            if ($value != $src[$rule_value]){
                                $this->addError("{$rule_value} and {$item} must match.");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count()){
                                $this->addError("{$item} is taken.");
                            }
                            break;
                        case 'alpha':
                            if (is_numeric($value)){
                                $this->addError("{$item} must contain at least one letter.");
                            }
                            break;
                        case 'not':
                            if ($value === $rule_value){
                                $this->addError("You must choose a color");
                            }
                            break;
                        case 'maxFileSize':
                            if ($value["size"] > $rule_value){
                                $this->addError("File is too large.");
                            }
                            break;
                        case 'allowedExts':
                            $temp = explode(".", $value["name"]);
                            $ext = strtolower(end($temp));
                            if (!in_array($ext, $rule_value)){
                                $this->addError("Invalid file extension");
                            }
                            break;
                        case 'checkDir':
                            if (file_exists($rule_value . $value["name"])){
                                $this->addError($value["name"] . " already exists.");
                            } 
                            break;
                    }
                }
            }
        }
        
        if (empty($this->_errors)){
            $this->_passed = true;
        } else {
            $this->_passed = false;
        }
    }
   
    private function addError($error){
        $this->_errors[] = $error;
    }
    
    public function errors(){
        return $this->_errors;
    }
    
    public function passed(){
        return $this->_passed;
    }
}

?>
