<?php

namespace Validation;

class Validator
{
    private static array $errorMessages = [];

    private function __construct(){}

    /**
     * Gets the things you need to start validation
     * @param array $data
     * @param array $rules
     * @return array
     */
    public static function validate(array $rules, array $data): array
    {
        static::runValidation($rules,$data);
        return static::$errorMessages;
    }

    /**
     * Runs all validation classes
     * @param array $data
     * @param array $rules
     * @return void
     */
    private static function runValidation(array $rules, array $data){
        foreach ($rules as $field=>$rule){
            foreach ($rule['rules'] as $key=>$validation){
                list($validation, $additionalData) = self::splitClassAndAdditionalData($validation, $data);
                self::validated($validation, $additionalData, $field, $rule['messages'][$key]??'', $data);
            }
        }
    }

    /**
     * @param ValidationInterface $validation
     * @param string $additionalData
     * @param string $field
     * @param string $rule
     * @param array $data
     * @return void
     */
    private static function validated(ValidationInterface $validation, string $additionalData, string $field, string $rule, array $data): void
    {
        $validation->formData($data);
        $validation->additionalData($additionalData);
        $validation->field($field);
        $validation->message($rule ?? '');
        !is_null($validation->validate()) ? array_push(static::$errorMessages,$validation->validate()) : '';
    }

    /**
     * @param $validation
     * @param $data
     * @return array
     */
    private static function splitClassAndAdditionalData($validation, $data): array
    {
        $data = explode(':', $validation);
        $additionalData = $data[1] ?? '';
        $validation = "\\".__NAMESPACE__."\\".$data[0];
        $validation = class_exists($validation) ? new $validation() : new $data[0];
        return [$validation, $additionalData];
    }
}
