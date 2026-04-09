<?php

echo "1. Преобразование регистра букв:<br>";
$arr1 = ['a', 'b', 'c', 'd', 'e'];
$result1 = array_map('strtoupper', $arr1);
print_r($result1);
echo "<br><br>";


echo "2. Последний элемент массива через count:<br>";
$arr2 = ['apple', 'banana', 'cherry', 'date'];
$lastIndex = count($arr2) - 1;
$lastElement = $arr2[$lastIndex];
echo $lastElement;
echo "<br><br>";


echo "3. Проверка наличия элемента 3:<br>";
$arr3 = [1, 5, 3, 8, 2];
if (in_array(3, $arr3)) {
    echo "Элемент 3 найден в массиве.";
} else {
    echo "Элемент 3 не найден в массиве.";
}
echo "<br><br>";


echo "4. Объединение двух массивов:<br>";
$arr4_1 = [1, 2, 3];
$arr4_2 = ['a', 'b', 'c'];
$result4 = array_merge($arr4_1, $arr4_2);
print_r($result4);
echo "<br><br>";


echo "5. Срез массива (array_slice):<br>";
$arr5 = [1, 2, 3, 4, 5];
$result5 = array_slice($arr5, 1, 3);
print_r($result5);
echo "<br><br>";


echo "6. Получение ключей и значений:<br>";
$arr6 = ['a' => 1, 'b' => 2, 'c' => 3];
$keys = array_keys($arr6);
$values = array_values($arr6);
echo "Keys: ";
print_r($keys);
echo "Values: ";
print_r($values);
echo "<br><br>";


echo "7. Создание ассоциативного массива (array_combine):<br>";
$keys7 = ['a', 'b', 'c'];
$values7 = [1, 2, 3];
$result7 = array_combine($keys7, $values7);
print_r($result7);
echo "<br><br>";


echo "8. Позиция первого элемента '-':<br>";
$arr8 = ['a', '-', 'b', '-', 'c', '-', 'd'];
$position = array_search('-', $arr8);
echo "Позиция: " . $position;
echo "<br><br>";


echo "9. Различные типы сортировки:<br>";
$arr9 = ['3' => 'a', '1' => 'c', '2' => 'e', '4' => 'b'];

$arr9_asort = $arr9;
asort($arr9_asort);
echo "asort (по значениям): ";
print_r($arr9_asort);

$arr9_ksort = $arr9;
ksort($arr9_ksort);
echo "ksort (по ключам): ";
print_r($arr9_ksort);
echo "<br><br>";


echo "10. Сумма цифр строки без цикла:<br>";
$str10 = '1234567890';
$digits = str_split($str10);
$sum = array_sum($digits);
echo "Сумма цифр: " . $sum;
echo "<br><br>";


echo "11. Массив из 10 букв 'x':<br>";
$arr11 = array_fill(0, 10, 'x');
print_r($arr11);
echo "<br><br>";



echo "12. Пересечение массивов (общие элементы):<br>";
$arr12_1 = [1, 2, 3, 4, 5];
$arr12_2 = [3, 4, 5, 6, 7];
$result12 = array_intersect($arr12_1, $arr12_2);
print_r($result12);
echo "<br>";

?>