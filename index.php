<?php
declare(strict_types=1);

interface FigureInterface {
    public function getArea(): float;
}

// 1, 2) Абстрактный класс Figure со свойствами и абстрактным методом
abstract class Figure {
    protected float $area;
    protected string $color;
    protected int $sidesCount;

    public function __construct(string $color, int $sidesCount) {
        $this->color = $color;
        $this->sidesCount = $sidesCount;
        $this->area = 0.0;
    }

    // 2) Абстрактный метод infoAbout()
    abstract public function infoAbout(): string;
}

// 3, 6, 7, 8, 9) Класс Rectangle
class Rectangle extends Figure implements FigureInterface {
    public const SIDES_COUNT = 4;
    private float $a;
    private float $b;

    public function __construct(string $color, float $a, float $b) {
        parent::__construct($color, self::SIDES_COUNT);
        $this->a = $a;
        $this->b = $b;
    }

    // 9) Метод getArea()
    public function getArea(): float {
        return $this->a * $this->b; // S = a * b
    }

    // 10) Метод infoAbout()
    public function infoAbout(): string {
        return "Это класс прямоугольника. У него " . self::SIDES_COUNT . " стороны.";
    }
}

// 3, 6, 7, 8, 9) Класс Square
class Square extends Figure implements FigureInterface {
    public const SIDES_COUNT = 4;
    private float $a;

    public function __construct(string $color, float $a) {
        parent::__construct($color, self::SIDES_COUNT);
        $this->a = $a;
    }

    // 9) Метод getArea()
    public function getArea(): float {
        return $this->a * $this->a; // S = a * a
    }

    // 10) Метод infoAbout()
    public function infoAbout(): string {
        return "Это класс квадрата. У него " . self::SIDES_COUNT . " стороны.";
    }
}

// 3, 7, 8, 9) Класс Triangle
class Triangle extends Figure implements FigureInterface {
    public const SIDES_COUNT = 3;
    private float $a;
    private float $b;
    private float $c;

    public function __construct(string $color, float $a, float $b, float $c) {
        parent::__construct($color, self::SIDES_COUNT);
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    // 9) Метод getArea() (Формула Герона)
    public function getArea(): float {
        $p = ($this->a + $this->b + $this->c) / 2; // полупериметр
        return sqrt($p * ($p - $this->a) * ($p - $this->b) * ($p - $this->c));
    }

    // 10) Метод infoAbout()
    public function infoAbout(): string {
        return "Это класс треугольника. У него " . self::SIDES_COUNT . " стороны.";
    }
}


echo '<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Фигуры</title>
<style>
    body { font-family: system-ui, sans-serif; background: #f8f9fa; padding: 20px; }
    .result { background: #fff; padding: 15px; margin: 10px 0; border-left: 4px solid #0056b3; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .area { font-weight: bold; color: #2e7d32; }
</style>
</head>
<body>
<h1> Расчёт площадей геометрических фигур</h1>';

// Прямоугольники
$rect1 = new Rectangle('красный', 5.0, 10.0);
$rect2 = new Rectangle('синий', 3.5, 7.0);

// Квадраты
$sq1 = new Square('зелёный', 6.0);
$sq2 = new Square('жёлтый', 4.5);

// Треугольники
$tri1 = new Triangle('оранжевый', 3.0, 4.0, 5.0);
$tri2 = new Triangle('фиолетовый', 7.0, 8.0, 9.0);

// Массив всех фигур для обхода
$figures = [$rect1, $rect2, $sq1, $sq2, $tri1, $tri2];

foreach ($figures as $figure) {
    echo '<div class="result">';
    echo '<p><strong>' . $figure->infoAbout() . '</strong></p>';
    echo '<p class="area">Площадь фигуры: ' . $figure->getArea() . ' кв. ед.</p>';
    echo '</div>';
}

echo '</body></html>';