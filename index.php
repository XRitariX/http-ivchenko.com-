<?php
declare(strict_types=1);


class Page {
    private string $name = 'page';
    private string $template = '<div><p>It is a default page</p></div>';

    public function __construct() {}

    
    public function render(): void {
        echo $this->template;
    }

    public function getName(): string {
        return $this->name;
    }
}


class BlogPage extends Page {
    private string $name = 'blog';
    private string $template = '
        <div class="catalog-container">
            <h2>Каталог оружия "РКОД ПШИ"</h2>
            <div class="cards-grid">
                <div class="card">
                    <h3>Карабин Сайга-12К</h3>
                    <p>Гладкоствольное самозарядное оружие, 12 калибр</p>
                    <span class="price">65 000 ₽</span>
                </div>
                <div class="card">
                    <h3>Пистолет МР-443 "Грач"</h3>
                    <p>Служебный пистолет под патрон 9×19 мм</p>
                    <span class="price">42 000 ₽</span>
                </div>
                <div class="card">
                    <h3>Винтовка ТОЗ-8М</h3>
                    <p>Малокалиберная охотничья винтовка, .22 LR</p>
                    <span class="price">28 000 ₽</span>
                </div>
            </div>
        </div>';

    public function __construct() {
        parent::__construct();
    }

    public function render(): void {
        echo $this->template;
    }
}


echo '<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>РКОД ПШИ | Оружейный магазин</title>
    <style>
        body { font-family: system-ui, -apple-system, sans-serif; background: #f5f7fa; color: #333; margin: 0; padding: 20px; }
        nav a { margin-right: 20px; text-decoration: none; color: #0056b3; font-weight: 600; }
        nav a:hover { text-decoration: underline; }
        .theme-buttons { margin: 20px 0; display: flex; gap: 10px; flex-wrap: wrap; }
        .theme-btn { display: inline-block; padding: 12px 24px; background: #d32f2f; color: #fff; text-decoration: none; border-radius: 6px; font-weight: 500; }
        .theme-btn.alt { background: #1976d2; }
        .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px; margin-top: 15px; }
        .card { background: #fff; border: 1px solid #e0e0e0; padding: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .card h3 { margin: 0 0 8px; }
        .price { display: block; margin-top: 10px; font-weight: bold; color: #2e7d32; }
        hr { border: 0; border-top: 1px solid #ccc; margin: 15px 0; }
    </style>
</head>
<body>
    <h1>Оружейный магазин "РыбОхота"</h1>';


echo '<nav>';
echo '<a href="?page=page">Главная страница</a>';
echo '<a href="?page=blog">Каталог оружия</a>';
echo '</nav><hr>';


$pageParam = $_GET['page'] ?? 'page';

if ($pageParam === 'blog') {
    $currentPage = new BlogPage();
} else {
    $currentPage = new Page();
    
    echo '<div class="theme-buttons">
            <a href="?page=license" class="theme-btn"> Оформление лицензии</a>
            <a href="?page=delivery" class="theme-btn alt">Доставка </a>
          </div>';
}

$currentPage->render();

echo '</body></html>';