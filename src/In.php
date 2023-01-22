<?php

namespace Validation;

class In implements ValidationInterface
{

    private array $formData;

    private array $errorMessage;

    private string $field;

    private string $additional;

    public function validate(){
        if(!in_array($this->formData[$this->field], explode(',',$this->additional))){
            return $this->errorMessage;
        }
    }

    public function formData(array $formData){
        $this->formData = $formData;
    }

    public function message(string $errorMessage){
        $this->errorMessage = [$this->field => empty($errorMessage) ? "The field {$this->field} must have one of these {$this->additional} values" : $errorMessage];
    }

    public function field(string $field){
        $this->field = $field;
    }

    public function additionalData(string $additional)
    {
        $this->additional = $additional;
    }
}