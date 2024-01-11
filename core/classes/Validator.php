<?php

namespace classes;

class Validator
{
    protected $errors = [];
    protected $data_items;
    protected $rules_list = ['required', 'min', 'max', 'relevance', 'email', 'match', 'unique'];

    protected $messages = [
        'required' => 'Поле :fieldname: обязательное',
        'min' => 'Минимальная длина :fieldname: :rulevalue: символов',
        'max' => 'Максимальная длина :fieldname: :rulevalue: символов',
        'relevance' => 'Дата сдачи не может быть прошедшим число',
        'email' => 'Почта указано некорректно',
        'match' => 'Пароль не совподает',
        'unique' => 'Пользователь с такой почтой уже существует'
    ];

    public function validate($data = [], $rules = []){
        $this->data_items = $data;
        foreach ($data as $fieldname => $value) {
            if(isset($rules[$fieldname])) {
                $this->check([
                    'fieldname' => $fieldname,
                    'value' => $value,
                    'rules' => $rules[$fieldname]

                ]);
            }
        }

        return $this;
    }

    protected function check($field){
        foreach ($field['rules'] as $rule => $rule_value){
            if(in_array($rule, $this->rules_list)){

               if(!call_user_func_array([$this, $rule], [$field['value'], $rule_value])){
                   $this->addError($field['fieldname'], $this->getErrorMessage($field['fieldname'], $rule_value, $rule));

               }else{
//                   echo  "{$field['fieldname']}: {$rule} - success";
//                   echo "<hr/>";
               }
            }
        }
    }

    protected function getErrorMessage($fieldname, $rule_value, $rule){
        return str_replace([':fieldname:', ':rulevalue:' ], [$fieldname, $rule_value], $this->messages[$rule]);

//        str_replace([':fieldname:', ':rulevalue:' ], [$field['fieldname'], $rule_value], $this->messages[$rule])
    }

    protected function addError($fieldname, $error){
        $this->errors[$fieldname][] = $error;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function hasErrors(){
        return !empty($this->errors);
    }


    public function listErrors($fieldname){
        $output = '';
        if(isset($this->errors[$fieldname])){
            $output .=  "<div class='control__messages'>";
               foreach ($this->errors[$fieldname] as $error){
                  $output .= "<p class='control__error'>{$error}</p>";
               }
            $output .=  "</div>";
        }
        return $output;

    }

    protected function required($value, $rule_value) {
     if($rule_value){
         return $value;
     } else {
         return true;
     }
    }

    protected function min($value, $rule_value) {
        return mb_strlen($value, 'UTF-8') >= $rule_value;
    }


    protected function max($value, $rule_value) {
        return mb_strlen($value, 'UTF-8') <= $rule_value;
    }

    protected function relevance($value, $rule_value) {
        $difference = getDifferenceTime($value, $rule_value);
        return $difference->invert > 0;
    }

    protected function email($value, $rule_value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    protected function match($value, $rule_value) {
        return $value === $this->data_items[$rule_value];
    }

    protected function unique($value, $rule_value) {

        $data = explode(':', $rule_value);
        return (!db()->query("SELECT {$data[1]} FROM {$data[0]} WHERE {$data[1]} = ?", [$value])->getColumn());
    }


}