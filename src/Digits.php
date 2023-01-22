<?php

namespace Validation;

class Digits implements ValidationInterface
{

    private array $formData;

    private array $errorMessage;

    private string $field;

    private string $additional;

    public function validate(){
        $values = explode(',',$this->additional);
        $data = strlen($this->formData[$this->field]);
        if(!($values[0] <= $data and $values[1] == $data)){
            return $this->errorMessage;
        }
    }

    public function formData(array $formData){
        $this->formData = $formData;
    }

    public function message(string $errorMessage){
        $this->errorMessage = [$this->field => empty($errorMessage) ? "The field `{$this->field}` must be between {$this->additional} characters" : $errorMessage];
    }

    public function field(string $field){
        $this->field = $field;
    }

    public function additionalData(string $additional)
    {
        $this->additional = $additional;
    }
}