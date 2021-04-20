<?php

namespace App\Classes;

class ValidateClass {

    private $passed = false, $errors = [];

    /**
     * Валидация переданных значений
     *
     * Parameters:
     *   $source array - передаваемые значения для валидации
     *   $items array - передаваемые параметры для валидации
     */
    public function check($source, $items = []) {
        foreach($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $value = $source[$item];

                if ($rule == 'required' && empty($value)) {
                    $this->addError("{$item} является обязательным!");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'type':
                            $pattern = '#^[0-9]+$#';
                                if(!preg_match($pattern, $value)) {
                                    $this->addError("Введенное значение в {$item} должно быть типа {$rule_value}.");
                                }
                            break;
                        case 'min':
                            if (strlen($value) < $rule_value) { //strlen($value) - кол-во символов в значении $value
                                $this->addError("Введенное значение в {$item} должно состоять минимум из {$rule_value} символов.");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("Введенное значение в {$item} должно состоять максимум из {$rule_value} символов.");
                            }
                            break;
                    }
                }
            }
        }

        // если ошибок нет, то валидация прошла успешно
        if (empty($this->errors)) {
            $this->passed = true;
        }
    }

    /**
     * Запись текста ошибок валидации.
     *
     * Parameters:
     *   $error string - текст ошибок валидации
     */
    private function addError($error) {
        $this->errors[] = $error;
    }

    /**
     * Получение ошибок валидации в виде массива
     */
    public function errors() {
        return $this->errors;
    }

    /**
     * Получение результатов валидации
     */
    public function passed() {
        return $this->passed;
    }
}