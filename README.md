### Form data validator

### install

```
composer require hasan-22/form-validator
```

## usage

```
require_once __DIR__ . '/vendor/autoload.php';

$data = ['name'=>'hassan','age'=>''];
$result = \Validation\Validator::validate(
    [
        'name'=>[
            'rules'=>['Required','Max:20'],
        ],
        'age'=>[
            'rules'=>['Required', 'Numeric'],
        ]
    ],$data);
    
print_r($result);

Output: 
[
    [0] => [
        [age] => The field `age` is required
    ],
    [1] => [
        [age] => The field `age` must be numeric
    ]
]

If all validation passes, you get an empty array
```

### with custom message
```
require_once __DIR__ . '/vendor/autoload.php';

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
    
Output: 
[
    [0] => [
        [age] => custom required msg
    ],
    [1] => [
        [age] => custom numeric msg
    ]
]


If all validation passes, you get an empty array
```

### If you want to add custom validation, do so
```
    class Email implements \Validation\ValidationInterface{
    
        private array $errorMessage;

        private string $field;
    
        public function validate(array $data){
            if(!filter_var($data, FILTER_VALIDATE_EMAIL)){
                return $this->errorMessage;
            }
        }
    
        public function message(string $errorMessage){
            $this->errorMessage = [$this->field => empty($errorMessage) ? "The `{$this->field}` field is not an email" : $errorMessage];
        }
    
        public function field(string $field){
            $this->field = $field;
        }
    } 
    
```
#### Now you can use the Email class like this

```
require_once __DIR__ . '/vendor/autoload.php';
require_once 'Email.php';

$formData = ['email'=>'hassan@gmail.com'];
$result = \Validation\Validator::validate(
    [
        'email'=>[
            'rules'=>['Required','Email']
        ],
    ],$data);

Output: 
[] 
If all validation passes, you get an empty array
```
