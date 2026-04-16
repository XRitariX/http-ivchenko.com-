<?php
date_default_timezone_set('Europe/Moscow');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Задание 1
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 1</h3>';
$filename = 'nonexistent_file.txt';
set_error_handler(function($severity, $message, $file, $line) {
    throw new ErrorException($message, 0, $severity, $file, $line);
});
try {
    $handle = fopen($filename, 'r');
    if ($handle === false) {
        throw new Exception("Не удалось открыть файл: $filename");
    }
    fclose($handle);
} catch (Throwable $ex) {
    echo 'Ошибка: ' . $ex->getMessage() . '<br>';
} finally {
    restore_error_handler();
}


// Задание 2
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 2</h3>';
function safeDivide($a, $b) {
    try {
        if ($b == 0) {
            throw new DivisionByZeroError("Деление на ноль: $a / $b");
        }
        return $a / $b;
    } catch (Throwable $ex) {
        $logMessage = date('Y-m-d H:i:s') . ' - ОШИБКА: ' . $ex->getMessage() . PHP_EOL;
        @file_put_contents('log.txt', $logMessage, FILE_APPEND);
        return 'Ошибка: ' . $ex->getMessage();
    }
}
echo safeDivide(10, 0) . '<br>';


// Задание 3
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 3</h3>';
function getArrayValue($array, $key, $default = null) {
    try {
        if (!array_key_exists($key, $array)) {
            throw new OutOfBoundsException("Ключ '$key' не существует в массиве");
        }
        return $array[$key];
    } catch (OutOfBoundsException $ex) {
        return 'Ошибка: ' . $ex->getMessage();
    }
}
$countries = ['Spain' => 'Madrid', 'Russia' => 'Moscow'];
echo getArrayValue($countries, 'Germany', 'Неизвестно') . '<br>';


// Задание 4
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 4</h3>';
$countries = ['Spain' => 'Madrid', 'Russia' => 'Moscow'];
$requestKey = 'Germany';
try {
    if (!isset($countries[$requestKey])) {
        throw new Exception("Страна '$requestKey' не найдена в базе данных");
    }
    echo 'Столица: ' . $countries[$requestKey];
} catch (Exception $ex) {
    echo 'Исключение: ' . $ex->getMessage();
}
echo '<br>';


// Задание 5
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 5</h3>';
$timestamp = mktime(10, 25, 0, 3, 15, 2025);
echo 'Timestamp: ' . $timestamp . '<br>';
echo 'Проверка: ' . date('Y-m-d H:i:s', $timestamp) . '<br>';


// Задание 6
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 6</h3>';
$pastTimestamp = strtotime('1990-10-02 08:05:59');
$currentTimestamp = time();
$difference = $currentTimestamp - $pastTimestamp;
echo 'Разница в секундах: ' . $difference . '<br>';
echo 'Разница в днях: ' . round($difference / 86400, 2) . '<br>';


// Задание 7
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 7</h3>';
echo date('Y.m.d H:i:s') . '<br>';


// Задание 8
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 8</h3>';
$currentYear = date('Y');
$septemberFirst = mktime(0, 0, 0, 9, 1, $currentYear);
echo date('Y.m.d', $septemberFirst) . '<br>';


// Задание 9
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 9</h3>';
$timestamp = strtotime('2000-02-02');
$daysRu = [
    'Monday' => 'Понедельник',
    'Tuesday' => 'Вторник',
    'Wednesday' => 'Среда',
    'Thursday' => 'Четверг',
    'Friday' => 'Пятница',
    'Saturday' => 'Суббота',
    'Sunday' => 'Воскресенье'
];
$dayEn = date('l', $timestamp);
echo ($daysRu[$dayEn] ?? $dayEn) . '<br>';


// Задание 10
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 10</h3>';
$week = [
    0 => 'Воскресенье',
    1 => 'Понедельник',
    2 => 'Вторник',
    3 => 'Среда',
    4 => 'Четверг',
    5 => 'Пятница',
    6 => 'Суббота'
];
$currentDayIndex = date('w');
echo 'Сегодня: ' . $week[$currentDayIndex] . '<br>';
$birthdayTimestamp = strtotime('2016-06-12');
$birthdayDayIndex = date('w', $birthdayTimestamp);
echo '12.06.2016 было: ' . $week[$birthdayDayIndex] . '<br>';


// Задание 11
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 11</h3>';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['date1'], $_POST['date2'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);
    if ($ts1 === false || $ts2 === false) {
        echo 'Ошибка: некорректный формат даты';
    } elseif ($ts1 > $ts2) {
        echo 'Большая дата: ' . $date1;
    } elseif ($ts2 > $ts1) {
        echo 'Большая дата: ' . $date2;
    } else {
        echo 'Даты равны: ' . $date1;
    }
    echo '<br>';
}
echo '<form method="POST" style="margin: 10px 0;">
    Дата 1: <input type="date" name="date1" required>
    Дата 2: <input type="date" name="date2" required>
    <button type="submit">Сравнить</button>
</form>';


// Задание 12
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 12</h3>';
$inputDate = '2025-12-31';
$timestamp = strtotime($inputDate);
$formattedDate = date('d-m-Y', $timestamp);
echo 'Исходная: ' . $inputDate . ' -> Результат: ' . $formattedDate . '<br>';


// Задание 13
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 13</h3>';
$dt = new DateTime('2000-02-03');
echo 'Исходная: ' . $dt->format('Y-m-d') . '<br>';
$dt->modify('+2 days');
echo '+2 дня: ' . $dt->format('Y-m-d') . '<br>';
$dt->modify('+1 month')->modify('+3 days');
echo '+1 месяц +3 дня: ' . $dt->format('Y-m-d') . '<br>';
$dt->modify('+1 year');
echo '+1 год: ' . $dt->format('Y-m-d') . '<br>';
$dt->modify('-3 days');
echo '-3 дня: ' . $dt->format('Y-m-d') . '<br>';


// Задание 14
echo '<hr style="border: 2px solid red;">';
echo '<h3>Задание 14</h3>';
$currentYear = date('Y');
$nextNewYear = strtotime("$currentYear-12-31 23:59:59");
if (time() > $nextNewYear) {
    $nextNewYear = strtotime(($currentYear + 1) . "-12-31 23:59:59");
}
$secondsLeft = $nextNewYear - time();
$daysLeft = floor($secondsLeft / 86400);
echo 'До Нового Года осталось: ' . $daysLeft . ' дней<br>';
echo 'Точнее: ' . $daysLeft . ' дн. ' . floor(($secondsLeft % 86400) / 3600) . ' час.<br>';
?>