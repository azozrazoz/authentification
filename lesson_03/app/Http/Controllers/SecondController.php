<?php

namespace App\Http\Controllers;

use App\Exceptions\DoshanException;
use Illuminate\Http\Request;

class SecondController extends Controller
{
    // Example
    // http://127.0.0.1:8000/calculator?num1=3&num2=5&op=1

    public function calc(Request $request)
    {
        $num_1 = $request->num1;
        $num_2 = $request->num2;

        $op_index = $request->op;
        $calc = Calculator::getInstance($num_1, $num_2);

        return $calc->Result($op_index);
    }
}


class Calculator
{
    public $num1;
    public $num2;
    public static bool $instance = false;

    protected function __construct($a, $b) {
        $this->num1 = $a;
        $this->num2 = $b;
    }

    public static function getInstance($a, $b) {
        if (Calculator::$instance == false) {
            Calculator::$instance = true;
            return new Calculator($a, $b);
        }

        throw new DoshanException("It is a singleton pattern!");
    }

    public function Result($op) {
        switch($op) {
            case 1:                
                return "Сложение: ".$this->Sum($this->num1, $this->num2);
                break;
            case 2:
                return "Вычитание: " . $this->Min($this->num1, $this->num2);
                break;
            case 3:
                return "Умножение: " . $this->Multiply($this->num1, $this->num2);
                break;
            case 4:
                return "Деление: " . $this->Divide($this->num1, $this->num2);
                break;
            case 5:
                return "Корень 1: " . $this->Root($this->num1, $this->num2);
                break;
        }
    }

    public function Sum($num1, $num2) {
        return $num1 + $num2;
    }

    public function Min($num1, $num2) {
        return $num1 - $num2;
    }

    public function Multiply($num1, $num2) {
        return $num1 * $num2;
    }

    public function Divide($num1, $num2) {
        return $num1 / $num2;
    }

    public function Root($num1, $num2) {
        return strval($num1 ** 0.5) . "<br>Корень 2: " . strval($num2 ** 0.5);
    }
}