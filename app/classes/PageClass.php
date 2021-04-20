<?php

namespace App\Classes;

use League\Plates\Engine;

class PageClass
{

    private $templates,
            $session,
            $validate,
            $psychic;

    public function __construct(Engine $engine, ValidateClass $validate, SessionClass $session)
    {
        $this->templates = $engine;
        $this->session = $session;
        $this->validate = $validate;
        $this->psychic = 3;

        if (!$this->session::exists('user_name')) {
            $this->session->initializeData($this->psychic);
        }
    }

    //очистка сессии и сброс прогресса
    public function clearSession()
    {
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        header('Location:/');
        die();
    }

    /**
     * Открываем первую страницу
     */
    public function openOnePage()
    {
        //формирование верстки для таблицы с именами экстрасенсов
        $name_psychic_in_HTML = $this->namePsychicInHTML();

        //формирование верстки для таблицы с показателями доверия экстрасенсов
        $trust_psychic_in_HTML = $this->trustPsychicInHTML();

        //формирование верстки для таблицы из истории шагов
        $history_step_data_in_HTML = $this->historyStepDataInHTML();

        echo $this->templates->render('page/one_page', [
                                                                    'name_psychic_in_HTML' => $name_psychic_in_HTML,
                                                                    'history_step_data_in_HTML' => $history_step_data_in_HTML,
                                                                    'trust_psychic_in_HTML' => $trust_psychic_in_HTML
                                                                   ]);
    }

    /**
     * Открываем вторую страницу
     */
    public function openTwoPage()
    {

        //генерация предположений экстрасенсов
        $array_number_psychic = $this->guessworkPsychic();

        //формирование верстки с предположениями экстрасенсов
        $guesswork_psychics_in_HTML = $this->guessworkPsychicsInHTML($array_number_psychic);


        //формирование верстки для таблицы с именами экстрасенсов
        $name_psychic_in_HTML = $this->namePsychicInHTML();

        //формирование верстки для таблицы с показателями доверия экстрасенсов
        $trust_psychic_in_HTML = $this->trustPsychicInHTML();

        //формирование верстки для таблицы из истории шагов
        $history_step_data_in_HTML = $this->historyStepDataInHTML();

        echo $this->templates->render('page/two_page', [
                                                                        'guesswork_psychics_in_HTML' => $guesswork_psychics_in_HTML,
                                                                        'name_psychic_in_HTML' => $name_psychic_in_HTML,
                                                                        'history_step_data_in_HTML' => $history_step_data_in_HTML,
                                                                        'trust_psychic_in_HTML' => $trust_psychic_in_HTML
                                                                    ]);
    }

    /**
     * Открываем третью страницу
     */
    public function openThreePage()
    {
        //проверка было ли введено пользователем загаданное число
        if (!empty($_GET['user_number'])) {
            $this->validate->check($_GET, [
                'user_number' => [
                    'required' => true,
                    'type' => 'integer',
                    'min' => 2,
                    'max' => 2,
                ],
            ]);

            //проверка была ли пройдена валидация
            if ($this->validate->passed()) {

                //устанавливаем текущий шаг
                $current_step = $this->session::getDataSession('current_step');
                $current_step++;
                $this->session::put(['current_step' => $current_step]);

                $this->formingResultsAttempts($_GET);
                $this->formatResultsAttempt();

                //записываем в историю текущего шага
                $this->session::put([
                    'history' => [
                        $current_step => [
                            'step' => $current_step,
                            'user_number' => $_GET['user_number']
                        ]
                    ]
                ]);

                for ($i = 1; $i<=$this->psychic; $i++) {
                    $this->session::put([
                        'history' => [
                            $current_step => [
                                'result' => [
                                    "psychic_{$i}" => $_GET["psychic_{$i}_guess"]
                                ]
                            ]
                        ]
                    ]);
                }

                //формирование верстки для таблицы с именами экстрасенсов
                $name_psychic_in_HTML = $this->namePsychicInHTML();

                //формирование верстки для таблицы с показателями доверия экстрасенсов
                $trust_psychic_in_HTML = $this->trustPsychicInHTML();

                //формирование верстки для таблицы из истории шагов
                $history_step_data_in_HTML = $this->historyStepDataInHTML();

                echo $this->templates->render('page/three_page', [
                    'name_psychic_in_HTML' => $name_psychic_in_HTML,
                    'history_step_data_in_HTML' => $history_step_data_in_HTML,
                    'trust_psychic_in_HTML' => $trust_psychic_in_HTML
                ]);

            } else {
                //Если валидация не пройдена, то выводим предыдущую страницу с ошибками валидации
                flash()->error($this->validate->errors());
                $this->openTwoPage();
                die();
            }
        } else {
            //Если число пользователя не было введено, то выводим предыдущую страницу с ошибкой
            flash()->error('Не введено загаданное число!');
            $this->openTwoPage();
            die();
        }

    }
    /**
     * Запись в историю текущего шага результатов экстрасенсов в отформатированном виде
     */
    private function formatResultsAttempt()
    {
        //получаем текущий шаг
        $current_step = $this->session::getDataSession('current_step');

        //получаем успешные и неудачные попытки экстрасенсов в массиве
        $attempt_successful = $this->session::getDataSession('attempt.successful');
        $attempt_unsuccessful = $this->session::getDataSession('attempt.unsuccessful');

        for ($i = 1; $i <= $this->psychic; $i++) {

            //записываем историю текущего шага с результатами попыток экстрасенсов в отформатированном виде
            $this->session::put([
                'history' => [
                    $current_step => [
                        'trust' => [
                            "psychic_{$i}" => "{$attempt_successful["psychic_{$i}"]}/{$attempt_unsuccessful["psychic_{$i}"]}"
                        ]
                    ]
                ]
            ]);
        }

    }

    /**
     * Формирование результатов успешных и неуспешных догадок экстрасенсов
     *
     * Parameters:
     *   $psychic_number array - массив чисел экстрасенсов и пользователя с формы
     */
    private function formingResultsAttempts($psychic_number)
    {
        //получаем данные успешных и неуспешных попыток по всем экстрасенсам
        $attempt_successful = $this->session::getDataSession('attempt.successful');
        $attempt_unsuccessful = $this->session::getDataSession('attempt.unsuccessful');

        //отделяем число пользователя от предположений экстрасенсов
        $user_number = array_shift($psychic_number);

        for ($i = 1; $i <= count($psychic_number); $i++) {

            //получаем успешный и неуспешный результат одного экстрасенса
            $item_psychic_attempt_successful = $attempt_successful["psychic_{$i}"];
            $item_psychic_attempt_unsuccessful = $attempt_unsuccessful["psychic_{$i}"];

            //сравниваем предположение экстрасенса с загаданным числом пользователя
            if ($psychic_number["psychic_{$i}_guess"] === $user_number) {

                //если угадано, то записываем успех
                $item_psychic_attempt_successful++;
                $this->session::put([
                    'attempt' => [
                        'successful' => [
                            "psychic_{$i}" => $item_psychic_attempt_successful
                        ]
                    ]
                ]);
            } else {

                //если не угадано, то записываем неудачу
                $item_psychic_attempt_unsuccessful++;
                $this->session::put([
                    'attempt' => [
                        'unsuccessful' => [
                            "psychic_{$i}" => $item_psychic_attempt_unsuccessful
                        ]
                    ]
                ]);
            }
        }
    }

    /**
     * Формирование верстки для таблицы с именами экстрасенсов
     */
    private function namePsychicInHTML()
    {
        //получаем текущий шаг
        $current_step = $this->session::getDataSession('current_step');

        //получаем имена всех экстрасенсов
        $result = $this->session::getDataSession("current_name_psychic");

        $name_psychic_in_HTML = '';

        //формируем верстку с именами экстрасенсов
        foreach ($result as $item) {
            $name_psychic_in_HTML .= "<th>{$item}</th>";
        }

        //возвращаем сформированную верстку с данными
        return $name_psychic_in_HTML;
    }

    /**
     * Формирование верстки для таблицы с показателями доверия экстрасенсов
     */
    private function trustPsychicInHTML()
    {
        //получаем текущий шаг
        $current_step = $this->session::getDataSession('current_step');

        //получаем данные по достоверности экстрасенсов
        $result = $this->session::getDataSession("history.{$current_step}.trust");

        $trust_in_HTML = '';

        foreach ($result as $item) {
            $item = explode('/', $item);
            $trust_in_HTML .= "
                    <td>
                        <div class='row p-1'>
                            <div class='col bg-success'>
                                <span class='badge pill bg-success'>{$item[0]}</span>
                            </div> 
                            <div class='col bg-danger'>
                                <span class='badge pill bg-danger'>{$item[1]}</span>
                            </div>
                        </div>
                    </td>
            ";
        }

        return $trust_in_HTML;
    }

    /**
     * Формирование верстки для таблицы из истории шагов
     */
    private function historyStepDataInHTML()
    {
        //получаем историю всех шагов с результатами
        $history_step_all = $this->session::getDataSession("history");
        $history_step_in_HTML = '';

        //перебираем каждый шаг из истории шагов по отдельности
        for ($i = 0; $i < count($history_step_all); $i++) {
            //выбираем один шаг
            $history_step_one = $history_step_all[$i];

            //выбираем номер шага и вписываем его в верстку
            $history_step_in_HTML .= "<tr class='bg-light'><th>Шаг {$history_step_one['step']}</th>";

            //выбираем числовые предположения экстрасенсов и вписываем их в верстку
            foreach ($history_step_one['result'] as $key => $value) {
                $history_step_in_HTML .= "<td>{$value}</td>";
            }

            //выбираем число пользователя и вписываем его в верстку
            $history_step_in_HTML .= "<td>{$history_step_all[$i]['user_number']}</td></tr>";
        }

        //возвращаем сформированную верстку с данными
        return $history_step_in_HTML;
    }

    /**
     * Формирование верстки с предположениями экстрасенсов
     */
    private function guessworkPsychicsInHTML($number_psychic = [])
    {
        $guesswork_psychic_in_HTML = '';
        $i = 1;

        foreach ($number_psychic as $item) {
            $guesswork_psychic_in_HTML .= "
            <div class='col-4'>
                    <label for='psychic_{$i}_guess'>Предположение экстрасенса {$i}</label>
                    <input class='form-control form-control-lg' id='psychic_{$i}_guess' name='psychic_{$i}_guess' type='text' value='$item' readonly>
            </div>
            ";
            $i++;
        }

        //возвращаем сформированную верстку предположений экстрасенсов
        return $guesswork_psychic_in_HTML;
    }

    /**
     * Генерация предположения экстрасенсов
     */
    private function guessworkPsychic()
    {
        $array_number_psychic = [];
        for($i = 1; $i <= $this->psychic; $i++) {
            $number = rand(10, 99);
            $array_number_psychic["psychic_{$i}_guess"] = $number;
        }
        return $array_number_psychic;
    }

}