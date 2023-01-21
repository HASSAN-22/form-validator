<?php


require_once __DIR__ . '/vendor/autoload.php';
require_once 'Min.php';

$data = ['name'=>'hassan','age'=>''];
$result = \Validation\Validator::validate(
    [
        'name'=>[
            'rules'=>['Required','Max:20'],
            'messages'=>['custom required msg']
        ],
        'age'=>[
            'rules'=>['Required', 'Numeric'],
            'messages'=>['custom required msg','custom numeric msg']
        ]
    ],$data);

print_r($result);