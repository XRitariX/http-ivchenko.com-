<?php
// Задание 1
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 1</h3>';
class Worker {
    public $name;
    private $age;
    public $salary;

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getSalary($otherWorker = null) {
        if ($otherWorker instanceof Worker) {
            return $this->salary + $otherWorker->salary;
        }
        return $this->salary;
    }

    public function setAge($newAge) {
        if ($this->checkAge($newAge)) {
            $this->age = $newAge;
        } else {
            echo "Вам работать в нашей компании еще рано<br>";
        }
    }

    private function checkAge($age) {
        return $age >= 18;
    }
}
echo "Класс Worker создан.<br>";

// Задание 2
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 2</h3>';
$worker1 = new Worker();
$worker1->name = 'Иван';
$worker1->salary = 45000;
$worker1->setAge(25);

$worker2 = new Worker();
$worker2->name = 'Анна';
$worker2->salary = 60000;
$worker2->setAge(30);
echo "Создано 2 объекта. Свойства установлены.<br>";

// Задание 3
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 3</h3>';
echo "Сумма зарплат: " . ($worker1->salary + $worker2->salary) . "<br>";
echo "Сумма возрастов: " . ($worker1->getAge() + $worker2->getAge()) . "<br>";

// Задание 4
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 4</h3>';
echo "getName: " . $worker1->getName() . "<br>";

// Задание 5
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 5</h3>';
echo "getAge: " . $worker2->getAge() . "<br>";

// Задание 6
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 6</h3>';
echo "getSalary (без параметров): " . $worker1->getSalary() . "<br>";

// Задание 7
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 7</h3>';
echo "getSalary (сумма двух объектов): " . $worker1->getSalary($worker2) . "<br>";

// Задание 8, 9, 11
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 8, 9, 11</h3>';
echo "setAge(20): ";
$worker1->setAge(20);
echo "Новый возраст: " . $worker1->getAge() . "<br>";
echo "setAge(16): ";
$worker1->setAge(16);
echo "Возраст остался: " . $worker1->getAge() . "<br>";

// Задание 10
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 10</h3>';
echo "checkAge (логика >= 18):<br>";
echo "Проверка 25: " . var_export($worker1->getAge() >= 18, true) . "<br>";
echo "Проверка 16: " . var_export(16 >= 18, true) . "<br>";
echo "(В задании 11 метод сделан приватным, проверка происходит внутри setAge)<br>";
?>