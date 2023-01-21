<?php

namespace Validation;

class Numeric implements ValidationInterface
{

    private array $errorMessage;

    private string $field;

    private string $additional;

    public function validate(array $data){
        if(!is_numeric($data[$this->field])){
            return $this->errorMessage;
        }
    }

    public function message(string $errorMessage){
        $this->errorMessage = [$this->field => empty($errorMessage) ? "Field `{$this->field}` must be a numeric" : $errorMessage];
    }

    public function field(string $field){
        $this->field = $field;
    }

    public function additionalData(string $additional)
    {
        $this->additional = $additional;
    }
}