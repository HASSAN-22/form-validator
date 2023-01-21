<?php

namespace Validation;

class Required implements ValidationInterface
{

    private array $errorMessage;

    private string $field;

    private string $additional;

    public function validate(array $data){
        if(empty($data[$this->field])){
            return $this->errorMessage;
        }
    }

    public function message(string $errorMessage){
        $this->errorMessage = [$this->field => empty($errorMessage) ? "Field `{$this->field}` is required" : $errorMessage];
    }

    public function field(string $field){
        $this->field = $field;
    }

    public function additionalData(string $additional)
    {
        $this->additional = $additional;
    }
}