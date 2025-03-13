<?php
namespace App\Providers;
use App\Models;
class Validator{

    private $errors = array();
    private $key;
    private $value;
    private $nom;

    public function field($key, $value, $nom = null){
        $this->key = $key;
        $this->value = $value;
        if($nom == null){
            $this->nom = ucfirst($key);
        }else{
            $this->nom = ucfirst($nom);
        }
        return $this;
    }

    public function required(){
        if(empty($this->value)){
            $this->errors[$this->key]="$this->nom is required!";
        }
        return $this;
    }

    public function max($length){
        if(strlen($this->value) > $length ){
            $this->errors[$this->key]="$this->nom must be less than $length characters!";
        }
        return $this;
    }

    public function min($length){
        if(strlen($this->value) < $length ){
            $this->errors[$this->key]="$this->nom must be more than $length characters!";
        }
        return $this;
    }

    public function number(){
        if(!empty($this->value) && !is_numeric($this->value)){
            $this->errors[$this->key]="$this->nom must be a number!";
        }
        return $this;	    
    }

    public function email(){
        if(!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)){  
            $this->errors[$this->key]="$this->nom invalid!";
        }
        return $this;	    
    }

    public function unique($model){
        $model = 'App\\Models\\'.$model;
        $model = new $model;
        $unique = $model->unique($this->key, $this->value);
        if($unique){
            $this->errors[$this->key]="$this->nom must be unique!";
        }
        return $this;
    }

    public function isSuccess(){
        if(empty($this->errors)) return true;
    }

    public function getErrors(){
        if(!$this->isSuccess()) return $this->errors;
    }

}
