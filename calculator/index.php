<?php
    //echo $_POST['username'];
    //echo $_REQUEST['username'];
    //echo 'Привет, ' . htmlspecialchars($_GET["username"]) . '!<br>';	
    //echo $_POST['operation'];

    abstract class Operation
    {
        public $code;
        public $name;
        public $result;

        public function getValue() {
            print($this.__toString());
        }

        public function __toString() {
            return $this->$name . $this.$result;
        }
    }

    class Sum extends Operation
    {
        public $code = "1";
        public $name = 'Сумма';

        public function __constructor(int $x, int $y){
            $result = $x + $y;
        }
    }

    class Subtract extends Operation
    {
        public $code = "2";
        public $name = 'Вычитание';

        public function __constructor(int $x, int $y){
            $result = $x - $y;
        }
    }

    class Multiply extends Operation
    {
        public $code = "3";
        public $name = 'Умножение';

        public function __constructor(int $x, int $y){
            $result = $x * $y;
        }
    }

    class Degree extends Operation
    {
        public $code = "4";
        public $name = 'Деление';

        public function __constructor(int $x, int $y){
            $result = $x / $y;
        }
    }

    class Root extends Operation
    {
        public $code = "5";
        public $name = 'Корень';

        public function __constructor(int $x, int $y){
            $root1 = $x ** 0.5;
            $root2 = $y ** 0.5;
            $result = "$x, $y";
        }
    }

    function main() {
        $num_1 = $_POST['num1'];
        $num_2 = $_POST['num2'];
        $op_index = $_POST['operation'];
        $sum = new Sum($num_1, $num_2);
        $subtract = new Subtract($num_1, $num_2);
        $multiply = new Multiply($num_1, $num_2);
        $degree = new Degree($num_1, $num_2);
        $root = new Root($num_1, $num_2);
        $op = array(1 => $sum, 2 => $subtract, 3 => $multiply, 4 => $degree, 5 => $root);

        print($op[$op_index]->getValue());

        // switch($op_index){
        //     case 1:                
        //         print($op[$op_index]->getValue());
        //         break;
        //     case 2:
        //         $result = $num_1 - $num_2;
        //         print("Вычитание: $result<br/>");
        //         break;
        //     case 3:
        //         $result = $num_1 * $num_2;
        //         print("Умножение: $result<br/>");
        //         break;
        //     case 4:
        //         $result = $num_1 / $num_2;
        //         print("Деление: $result<br/>");
        //         break;
        //     case 5:
        //         $num_1 = pow($num_1, 0.5);
        //         $num_2 = $num_2 ** 0.5;
                
        //         print("Корень первого числа: $num_1<br/>");
        //         print("Корень второго числа: $num_2<br/>");
        //         break;
        //     default:
        //     break;
        // }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My calculator</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>    
    <div class="box">
        <div style="font-size: 30px;">
            <?
                main(); 
            ?>
        </div>

        <input class="glow-button" type="submit" name="submit" value="Вернуться назад" onclick="history.back();"/>

    </div>
</body>
</html>