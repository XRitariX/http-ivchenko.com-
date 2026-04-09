<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Работа с файлами в PHP</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; background: #f4f4f9; }
        .block { background: #fff; padding: 20px; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { border-bottom: 2px solid #667eea; padding-bottom: 10px; }
        .success { color: #155724; background: #d4edda; padding: 10px; border-radius: 5px; margin: 5px 0; }
        .info { color: #0c5460; background: #d1ecf1; padding: 10px; border-radius: 5px; margin: 5px 0; }
        .error { color: #721c24; background: #f8d7da; padding: 10px; border-radius: 5px; margin: 5px 0; }
    </style>
</head>
<body>

    <h1>📁 Лабораторная работа: Работа с файлами в PHP</h1>

    <!-- ЧАСТЬ 1 -->
    <div class="block">
        <h2>Часть 1: Файловые операции</h2>
        <?php
        // 1. Создайте файл 'test.txt' и запишите в него фразу 'Привет, мир!'.
        $text = "Привет, мир!";
        file_put_contents('test.txt', $text);
        echo "<div class='success'>✅ Файл <b>test.txt</b> создан и записан.</div>";

        // 2. Считайте данные из файла 'test.txt' и выведите их на экран.
        $content = file_get_contents('test.txt');
        echo "<div class='info'>📖 Содержимое test.txt: <b>" . htmlspecialchars($content) . "</b></div>";

        // 3. Переименуйте файл 'test.txt' в 'mir.txt'.
        rename('test.txt', 'mir.txt');
        echo "<div class='success'>✅ Файл переименован в <b>mir.txt</b>.</div>";

        // 4. Создайте папку 'folder' и переместите файл 'mir.txt' в эту папку.
        if (!is_dir('folder')) mkdir('folder');
        rename('mir.txt', 'folder/mir.txt');
        echo "<div class='success'>✅ Папка <b>folder</b> создана, файл перемещен внутрь.</div>";

        // 5. Создайте копию файла 'mir.txt' и назовите ее 'world.txt'.
        copy('folder/mir.txt', 'world.txt');
        echo "<div class='success'>✅ Создана копия: <b>world.txt</b>.</div>";

        // 6. Определите размер файла 'world.txt'. Выведите в байтах, МБ, ГБ.
        $bytes = filesize('world.txt');
        $mb = $bytes / (1024 * 1024);
        $gb = $bytes / (1024 * 1024 * 1024);
        echo "<div class='info'>📏 Размер world.txt: <b>{$bytes} байт</b> | " . number_format($mb, 6) . " МБ | " . number_format($gb, 9) . " ГБ</div>";

        // 7. Удалите файл 'world.txt'.
        unlink('world.txt');
        echo "<div class='success'>✅ Файл <b>world.txt</b> удален.</div>";

        // 8. Проверьте существование файлов 'world.txt' и 'mir.txt'.
        $existsWorld = file_exists('world.txt') ? "✅ Да" : "❌ Нет";
        $existsMir = file_exists('folder/mir.txt') ? "✅ Да (в папке folder)" : "❌ Нет";
        echo "<div class='info'>🔍 Проверка существования:<br> world.txt: {$existsWorld}<br> mir.txt: {$existsMir}</div>";
        ?>
    </div>

    <!-- ЧАСТЬ 2 -->
    <div class="block">
        <h2>Часть 2: Директории и поиск файлов</h2>
        <?php
        // 1. Создайте папку 'test'.
        if (!is_dir('test')) mkdir('test');
        echo "<div class='success'>✅ Папка <b>test</b> создана.</div>";

        // 2. Переименуйте папку 'test' на 'www'.
        rename('test', 'www');
        echo "<div class='success'>✅ Папка переименована в <b>www</b>.</div>";

        // 3. Удалите папку 'www'. (rmdir работает только с пустыми папками)
        rmdir('www');
        echo "<div class='success'>✅ Папка <b>www</b> удалена.</div>";

        // 4. Дан массив со строками. Создайте в папке 'test' папки с именами из массива.
        // Создаем test заново, так как она была удалена в шаге 3
        if (!is_dir('test')) mkdir('test');
        $dirNames = ['photos', 'documents', 'music', 'videos'];
        foreach ($dirNames as $name) {
            $path = "test/{$name}";
            if (!is_dir($path)) {
                mkdir($path);
                echo "<div class='success'>✅ Создана папка: <b>{$path}</b></div>";
            }
        }

        // 5. Выведите все файлы с расширением jpg из текущей папки.
        // Для демонстрации создадим пару тестовых файлов
        touch('photo1.jpg');
        touch('photo2.jpg');
        touch('readme.txt');

        $jpgFiles = glob("*.jpg");
        echo "<div class='info'>🖼️ Найдены файлы .jpg в текущей директории:</div><ul>";
        if (empty($jpgFiles)) {
            echo "<li>Файлов не найдено</li>";
        } else {
            foreach ($jpgFiles as $file) {
                echo "<li>{$file}</li>";
            }
        }
        echo "</ul>";

        // Очистка тестовых файлов (чтобы не засорять директорию)
        foreach ($jpgFiles as $f) unlink($f);
        unlink('readme.txt');
        ?>
    </div>

</body>
</html>