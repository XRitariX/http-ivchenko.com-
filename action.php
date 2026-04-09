<?php
session_start();

// Проверяем, что запрос пришел методом POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Определяем, какая форма отправлена
    $form_type = $_POST['form_type'] ?? '';
    
    // ==================== ОБРАБОТКА ФОРМЫ РЕГИСТРАЦИИ ====================
    if ($form_type === 'registration') {
        
        // Проверка передачи полей email и password
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            $_SESSION['reg_errors'] = ["Ошибка: Обязательные поля email и password не переданы!"];
            header("Location: index.php");
            exit;
        }
        
        // Получаем и очищаем данные
        $name = htmlspecialchars(trim($_POST['name'] ?? ''));
        $email = htmlspecialchars(trim($_POST['email'] ?? ''));
        $gender = htmlspecialchars(trim($_POST['gender'] ?? ''));
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $agree = isset($_POST['agree']);
        
        // Массив для ошибок
        $errors = [];
        
        // Валидация имени
        if (empty($name) || mb_strlen($name) < 2) {
            $errors[] = "Имя должно содержать минимум 2 символа";
        }
        
        // Валидация email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Введите корректный адрес почты";
        }
        
        // Валидация пола
        $valid_genders = ['male', 'female', 'other'];
        if (!in_array($gender, $valid_genders)) {
            $errors[] = "Выберите пол из списка";
        }
        
        // Валидация пароля
        if (empty($password) || mb_strlen($password) < 6) {
            $errors[] = "Пароль должен содержать минимум 6 символов";
        }
        
        // Проверка совпадения паролей
        if ($password !== $confirm_password) {
            $errors[] = "Пароли не совпадают";
        }
        
        // Проверка согласия с условиями
        if (!$agree) {
            $errors[] = "Необходимо согласиться с условиями использования";
        }
        
        // Если есть ошибки - возвращаемся на форму
        if (!empty($errors)) {
            $_SESSION['reg_errors'] = $errors;
            header("Location: index.php");
            exit;
        }
        
        // Если всё хорошо - хешируем пароль
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Показываем успешную регистрацию
        ?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Успешная регистрация</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <div class="container">
                <div class="success-box">
                    <h2>✅ Регистрация успешна!</h2>
                    <div class="user-info">
                        <p><strong>Имя:</strong> <?php echo $name; ?></p>
                        <p><strong>Почта:</strong> <?php echo htmlspecialchars($email); ?></p>
                        <p><strong>Пол:</strong> 
                            <?php 
                                echo match($gender) {
                                    'male' => 'Мужской',
                                    'female' => 'Женский',
                                    'other' => 'Другой',
                                    default => 'Не указан'
                                };
                            ?>
                        </p>
                    </div>
                    <p>На вашу почту отправлено письмо с подтверждением.</p>
                    <a href="index.php" class="btn-home">Вернуться на главную</a>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
    
    // ==================== ОБРАБОТКА КАЛЬКУЛЯТОРА ====================
    elseif ($form_type === 'calculator') {
        
        // Проверяем, существуют ли ключи 'num1' и 'num2'
        if (!isset($_POST['num1']) || !isset($_POST['num2'])) {
            $_SESSION['calc_result'] = '<div class="result error"><p>⛔ Ошибка: Числа не переданы!</p></div>';
            header("Location: index.php");
            exit;
        }
        
        // Получаем значения
        $num1 = floatval($_POST['num1']);
        $num2 = floatval($_POST['num2']);
        $operation = $_POST['operation'] ?? '';
        
        $result = null;
        $error = null;
        $sign = '';
        
        // Логика вычислений
        switch ($operation) {
            case 'add':
                $result = $num1 + $num2;
                $sign = '+';
                break;
            case 'sub':
                $result = $num1 - $num2;
                $sign = '-';
                break;
            case 'mul':
                $result = $num1 * $num2;
                $sign = '*';
                break;
            case 'div':
                // Проверка на деление на ноль
                if ($num2 == 0) {
                    $error = "⛔ Ошибка: Деление на ноль невозможно!";
                } else {
                    $result = $num1 / $num2;
                    $sign = '/';
                }
                break;
            default:
                $error = "Неизвестная операция";
        }
        
        // Формируем вывод результата
        if ($error) {
            $_SESSION['calc_result'] = "<div class='result error'><p>$error</p><p>Вы попытались вычислить: <b>$num1 / 0</b></p></div>";
        } else {
            $_SESSION['calc_result'] = "<div class='result success'><p>Вычисление: <b>$num1 $sign $num2</b></p><p>Результат: <strong>$result</strong></p></div>";
        }
        
        header("Location: index.php");
        exit;
    }
    
    // Если форма не распознана
    else {
        echo "<h3>Ошибка: Неизвестный тип формы!</h3>";
        echo "<a href='index.php'>Вернуться на главную</a>";
        exit;
    }
    
} else {
    // Если файл открыт напрямую без POST-запроса
    header("Location: index.php");
    exit;
}
?>