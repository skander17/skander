<?php


namespace Core\Validator;



trait Validator
{

    private $defaultMessages = [
        "required"=>"This item is required",
        "int"=> "This item most be a integer",
        "string"=> "This item most be a string",
        "email"=> "This item is not a valid email"
    ];

    private $defaultValidators = [
        "required",
        "int",
        "string",
        "email",
        "unique"
    ];

    /**
     * @param array $data
     * @param array $rules
     * @param array|null $messages
     * @return array
     * @throws ValidatorException
     */
    public function validator(array $data, array $rules, ?array $messages = []): array
    {
        $validatorBag = [];
        foreach ($rules as $item => $rule){
            $validatorBag = array_merge($validatorBag, $this->itemValidator($data, $item, $rule, $messages));
        }
        return $validatorBag;
    }
    public function itemValidator(array $data,string $item,string $rules,array $messages): array
    {
        $itemRules = explode("|",$rules);
        $messagesBag = [];
        foreach ( $itemRules as $validator){
            if (!$this->isValidate($validator) ){
                throw new ValidatorException("The Validator $validator not exist");
            }
            if (!$this->$validator($item,$data)){
                $messagesBag["$item.$validator"] = isset($messages["$item.$validator"])
                    ? $messages["$item.$validator"]
                    : $this->defaultMessage($validator);
            }

        }
        return $messagesBag;
    }

    public function required(string $key, array $data): bool
    {
        return isset($data[$key]) AND !empty($data[$key]);
    }
    public function int(string $key, array $data): bool
    {
        return isset($data[$key]) AND is_integer($data[$key]);
    }
    public function text(string $key, array $data): bool
    {
        return isset($data[$key]) AND is_string($data[$key]);
    }
    public function unique(string $key, array $data): void
    {
        //TODO: Model Resource
    }
    public function email(string $key, array $data): bool
    {
        return isset($data[$key]) AND filter_var($data[$key],FILTER_VALIDATE_EMAIL);
    }

    private function defaultMessage(string $validator): string
    {
        return $this->defaultMessages[$validator];
    }
    public function isValidate($validator){
        return in_array($validator, $this->defaultValidators);
    }
}