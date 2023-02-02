<?php

namespace Validation;

class Regex implements ValidationInterface
{

    private array $formData;

    private array $errorMessage;

    private string $field;

    private string $additional;

    public function validate(){
        if(preg_match($this->additional,$this->formData[$this->field]) == 0){
            return $this->errorMessage;
        }
    }

    public function formData(array $formData){
        $this->formData = $formData;
    }

    public function message(string $errorMessage){
        $this->errorMessage = [$this->field => empty($errorMessage) ? "The field `{$this->field}` format is invalid" : $errorMessage];
    }

    public function field(string $field){
        $this->field = $field;
    }

    public function additionalData(string $additional)
    {
        $this->additional = $additional;
    }
}