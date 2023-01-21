<?php

namespace Validation;

class Max implements ValidationInterface
{

    private array $errorMessage;

    private string $field;

    private string $additional;

    public function validate(array $data){
        if(strlen($data[$this->field]) > $this->additional){
            return $this->errorMessage;
        }
    }

    public function message(string $errorMessage){
        $this->errorMessage = [$this->field => empty($errorMessage) ? "The field `{$this->field}` must be less than or equal to a maximum value" : $errorMessage];
    }

    public function field(string $field){
        $this->field = $field;
    }

    public function additionalData(string $additional)
    {
        $this->additional = $additional;
    }
}