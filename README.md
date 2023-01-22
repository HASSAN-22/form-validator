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
    
        private array $formData;

        private array $errorMessage;
    
        private string $field;
    
        private string $additional;
    
        public function validate(){
            if(!filter_var($this->formData[$this->field], FILTER_VALIDATE_EMAIL)){
                return $this->errorMessage;
            }
        }
        
         public function formData(array $formData){
            $this->formData = $formData;
        }
        
        public function message(string $errorMessage){
            $this->errorMessage = [$this->field => empty($errorMessage) ? "The `{$this->field}` field is not an email" : $errorMessage];
        }
    
        public function field(string $field){
            $this->field = $field;
        }
        
        public function additionalData(string $additional)
        {
            $this->additional = $additional;
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

### Available validations
| Validtion |                                     Description                                      |          Example          |
|-----------|:------------------------------------------------------------------------------------|:-------------------------:|
| Required  | Checks that the field is not empty, these items are considered empty [ '', 0, null ] |                           |
| Between   |Checks if the field is between two values|       Between:4,10        |
| Email     |Checks if the field is email||
| In        |Checks if the field has a series of values or not| in:admin,customer,vendor  |
| Max       |Checks the field must be less than or equal to a value|          Max:20           |                          |
| Min       |Checks that the field must be greater than or equal to a value|           Min:7           |
| Numeric   |Checks that the field must be a number||
| Str       |Checks that the field must be a string||
