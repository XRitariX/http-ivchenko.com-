<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Регистрация</h2>
        
        <?php
        session_start();
        if (!empty($_SESSION['errors'])) {
            echo '<div class="error-box">';
            foreach ($_SESSION['errors'] as $error) {
                echo "<p>⚠️ $error</p>";
            }
            echo '</div>';
            unset($_SESSION['errors']);
        }
        ?>
        
        <form action="action.php" method="POST">
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" placeholder="Введите имя" required>
            </div>
            
            <div class="form-group">
                <label for="email">Почта:</label>
                <input type="email" id="email" name="email" placeholder="name@example.ru" required>
            </div>
            
            <div class="form-group">
                <label for="gender">Пол:</label>
                <select id="gender" name="gender" required>
                    <option value="">Выберите пол</option>
                    <option value="male">Мужской</option>
                    <option value="female">Женский</option>
                    <option value="other">Другой</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" placeholder="Введите пароль" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Подтвердите пароль:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Повторите пароль" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn-submit">Зарегистрироваться</button>
            </div>
            
            <div class="form-group checkbox-group">
                <label>
                    <input type="checkbox" name="agree" required>
                    Создавая учетную запись, вы соглашаетесь с нашим 
                    <a href="#">Условиями</a> и 
                    <a href="#">конфиденциальностью</a>.
                </label>
            </div>
        </form>
    </div>
</body>
</html>