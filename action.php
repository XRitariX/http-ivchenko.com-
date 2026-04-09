<?php
// Проверяем, что форма отправлена методом POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
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
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
    
    // Если есть ошибки - возвращаемся на форму с сообщениями
    if (!empty($errors)) {
        // Сохраняем ошибки в сессии (если нужна)
        session_start();
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $_POST;
        header("Location: index.php");
        exit;
    }
    
    // Если всё хорошо - хешируем пароль и "регистрируем" пользователя
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Здесь обычно код сохранения в базу данных:
    // $pdo->prepare("INSERT INTO users (...) VALUES (...)")->execute([...]);
    
    // Для демонстрации покажем успешную регистрацию
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Успешная регистрация</title>
        <link rel="stylesheet" href="style.css">
        <style>
            .success-box {
                text-align: center;
                padding: 30px;
                background: #d4edda;
                border: 1px solid #c3e6cb;
                border-radius: 10px;
                color: #155724;
                max-width: 400px;
            }
            .success-box h2 {
                margin-bottom: 15px;
                color: #155724;
            }
            .user-info {
                text-align: left;
                margin: 20px 0;
                padding: 15px;
                background: white;
                border-radius: 5px;
            }
            .user-info p {
                margin: 8px 0;
                color: #333;
            }
            .btn-home {
                display: inline-block;
                padding: 10px 25px;
                background: #667eea;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 15px;
            }
            .btn-home:hover {
                background: #5568d3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="success-box">
                <h2>✅ Регистрация успешна!</h2>
                <div class="user-info">
                    <p><strong>Имя:</strong> <?php echo $name; ?></p>
                    <p><strong>Почта:</strong> <?php echo $email; ?></p>
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
    
} else {
    // Если файл открыт напрямую без POST-запроса
    header("Location: index.php");
    exit;
}
?>