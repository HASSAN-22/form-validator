<?php

namespace Validation;

class Email implements \Validation\ValidationInterface{

    private array $formData;

    private array $errorMessage;

    private string $field;

    private string $additional;

    public function validate(){
        if(!filter_var($this->formData[$this->field], FILTER_VALIDATE_EMAIL)){
            return $this->errorMessage;
        }
    }

    public function formData(array $formData){
        $this->formData = $formData;
    }

    public function message(string $errorMessage){
        $this->errorMessage = [$this->field => empty($errorMessage) ? "The `{$this->field}` field is not an email" : $errorMessage];
    }

    public function field(string $field){
        $this->field = $field;
    }

    public function additionalData(string $additional)
    {
        $this->additional = $additional;
    }
}