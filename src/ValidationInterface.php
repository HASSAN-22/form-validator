<?php

namespace Validation;

/**
 * @property array $formData
 * @property array $errorMessage
 * @property string $field
 * @property string $additional
 */

interface ValidationInterface
{
    /**
     * Performs validation
     * @param array $data
     * @return mixed
     */
    public function validate();

    /**
     * Get form data
     * @param array $formData
     * @return mixed
     */
    public function formData(array $formData);

    /**
     * Get error manual message
     * @param string $errorMessage
     * @return mixed
     */
    public function message(string $errorMessage);


    /**
     * Gets the name of the field to be validated
     * @param string $field
     * @return mixed
     */
    public function field(string $field);

    /**
     * @param string $additional
     * @return mixed
     */
    public function additionalData(string $additional);
}