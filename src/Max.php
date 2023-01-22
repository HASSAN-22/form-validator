<?php

namespace Validation;

class Max implements ValidationInterface
{

    private array $formData;

    private array $errorMessage;

    private string $field;

    private string $additional;

    public function validate(){
        if(strlen($this->formData[$this->field]) > $this->additional){
            return  $this->errorMessage;
        }
    }

    public function formData(array $formData){
        $this->formData = $formData;
    }

    public function message(string $errorMessage){
        $this->errorMessage = [$this->field => empty($errorMessage) ? "The number of characters in the field `{$this->field}` must be less than or equal to {$this->additional} characters." : $errorMessage];
    }

    public function field(string $field){
        $this->field = $field;
    }

    public function additionalData(string $additional)
    {
        $this->additional = $additional;
    }
}