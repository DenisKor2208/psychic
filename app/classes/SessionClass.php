<?php

namespace App\Classes;

class SessionClass
{
    /**
     * Запись ключа со значением в массив сессии
     *
     * Parameters:
     *   $data array - данные для записи в сессию в виде ассоциативного массива
     */
    public static function put($data = []) {
        if ($data) {
            foreach($data as $keyOne => $valueOne) {
                if (gettype($valueOne) !== 'array') {
                    $_SESSION[$keyOne] = $valueOne;
                } else {
                    foreach($valueOne as $keyTwo => $valueTwo) {
                        if (gettype($valueTwo) !== 'array') {
                            $_SESSION[$keyOne][$keyTwo] = $valueTwo;
                        } else {
                            foreach($valueTwo as $keyThree => $valueThree) {
                                if (gettype($valueThree) !== 'array') {
                                    $_SESSION[$keyOne][$keyTwo][$keyThree] = $valueThree;
                                } else {
                                    foreach($valueThree as $keyFour => $valueFour) {
                                        if (gettype($valueFour) !== 'array') {
                                            $_SESSION[$keyOne][$keyTwo][$keyThree][$keyFour] = $valueFour;
                                        } else {
                                            return false;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {
            return false;
        }
    }

    /**
     * Проверка на существование ключа в массиве сессии
     *
     * Parameters:
     *   $name string - название проверяемого ключа
     */
    public static function exists($name) {
        return (isset($_SESSION[$name])) ? true : false;
    }

    /**
     * Инициализация структуры хранения данных по экстрасенсам и пользователю.
     * Заполнение структуры начальными значениями.
     *
     * Parameters:
     *   $number integer - кол-во экстрасенсов
     */
    public function initializeData($number)
    {
        self::put([
            'current_step' => 0,
            'user_number' => 0,
            'user_name' => 'Пользователь',
            'history' => [
                0 => [
                    'step' => 0,
                    'user_number' => 0,
                ]
            ]
        ]);

        for ($i = 1; $i<=$number; $i++) {
            self::put([
                'current_name_psychic' => [
                    "psychic_{$i}" => "Экстрасенс {$i}"
                ],
                'current_number_psychic' => [
                    "psychic_{$i}" => 0
                ],
                'attempt' => [
                    'successful' => [
                        "psychic_{$i}" => 0
                    ],
                    'unsuccessful' => [
                        "psychic_{$i}" => 0
                    ],
                ],
                'history' => [
                    0 => [
                        'result' => [
                            "psychic_{$i}" => 0
                        ],
                        'trust' => [
                            "psychic_{$i}" => '0/0'
                        ]
                    ]
                ]
            ]);
        }
    }

    /**
     * Получение данных из массива сессии.
     * Если название ключа не передается, то получаем весь массив сессии.
     *
     * Parameters:
     *   $path string - название ключа с необходимыми значениями
     */
    public static function getDataSession($path = null) {
        if ($path) {
            $data_from_session = $_SESSION;

            $path = explode('.', $path);

            foreach($path as $item) {
                if (isset($data_from_session[$item])) {
                    $data_from_session = $data_from_session[$item];
                }
            }
            return $data_from_session;
        } else {
            return $_SESSION;
        }
    }



}