<?php

namespace App\Controller;

use Exception;
use League\Plates\Engine;

class PageController
{

    private $templates,
            $sc,
            $psychic,
            $step;

    public function __construct(Engine $engine, SessionController $sc)
    {
        $this->templates = $engine;
        $this->sc = $sc;
        $this->psychic = 3;

        if (!isset($_SESSION['user_name'])) {
            $this->initData();
        }

        $this->step = $_SESSION['step'];

    }

    //страница с результатами и предложением начать заново
    public function homePage()
    {
        $this->sc::put("user_number", $_GET['user_number']);

        $this->trustLevel();

        echo $this->templates->render('mypage/home_page', ['step_d' => $this->step, 'sc' => $this->sc]);
    }

    //начальная приветственная страница с предложением загадать число
    public function questionNumber()
    {
        $_SESSION['history'][$this->step]["user_number_result"] = $_SESSION["user_number"];
        echo $this->templates->render('mypage/question_number', ['step_d' => $this->step, 'sc' => $this->sc]);
    }

    //страница ввода пользовательского числа и вывода предположений экстрасенсов
    public function resultPage()
    {
            $step = $_SESSION['step'];
            $step++;
            $this->sc::put('step', $step);

        $this->guessworkPsychic();
        $this->sortingResults();

        echo $this->templates->render('mypage/result_page', ['step_d' => $this->step, 'sc' => $this->sc]);
    }

    //функция генерации числового предположения экстрасенсом с записью в сессию
    private function guessworkPsychic()
    {
        for($i = 1; $i <= $this->psychic; $i++) {
            $number = rand(10, 99);
            $this->sc::put("psychic_{$i}_current_result", $number);
        }
    }

    //сборки массива в сессии с числовыми предположениями экстрасенсов
    private function sortingResults()
    {
        $step = $_SESSION['step'];

        for($i = 1; $i <= $this->psychic; $i++) {
            $_SESSION['history'][$step]["psychic_{$i}_result"] = $_SESSION["psychic_{$i}_current_result"];
            $_SESSION['history'][$step]["step"] = $step;
        }
    }

    //обработка и сборка данных в массиве сессии - числовое значение пользователя и определение достоверности экстрасенсов
    private function trustLevel()
    {
        $step = $_SESSION['step'];

        $_SESSION['history'][$step]["user_number_result"] = $_SESSION["user_number"];

        for($i = 1; $i <= $this->psychic; $i++) {
            $trust_level = (($_SESSION["psychic_{$i}_current_result"]) == $_SESSION["user_number"]) ? 'достоверный' : 'недостоверный';
            $_SESSION['history'][$step]["psychic_{$i}"] = $trust_level;
        }

    }

    //очистка сессии и сброс прогресса
    private function clearSession()
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

    //подготовка к работе и установка начальных данных
    private function initData()
    {

        $this->sc::put('user_name', 'Пользователь');
        $this->sc::put('user_number', 0);
        $this->sc::put('step', 0);
        $this->step = $_SESSION['step'];

        $this->sc::put('psychic_1_current_result', 0);
        $this->sc::put('psychic_2_current_result', 0);
        $this->sc::put('psychic_3_current_result', 0);

        $_SESSION['history'][$this->step]["user_number_result"] = $_SESSION["user_number"];

        for($i = 1; $i <= $this->psychic; $i++) {
            $_SESSION['history'][$this->step]["psychic_{$i}_result"] = $_SESSION["psychic_{$i}_current_result"];
            $_SESSION['history'][$this->step]["step"] = $this->step;

            $trust_level = '-';
            $_SESSION['history'][$this->step]["psychic_{$i}"] = $trust_level;
        }

    }


}