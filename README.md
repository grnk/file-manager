<h1>Тестовое задание DIKIDI</h1>

<p>
    <h2>PHP</h2>
    Написать что-то наподобие файлового менеджера. Вывести список файлов текущей папки с возможностью перехода по папкам и без возможности выхода за пределы рабочей папки сайта. Скрипт должен отображать только папки и картинки.
    Выслать написанный скрипт и примеры файлов в архиве.
</p>

<p>
    <h2>Верстка</h2>
    Используя bootstrap v 3.4 (getbootstrap.com) сверстать страницу авторизации. По центру страницы должна быть блок-форма (с внешней тенью) с вводом: логина, пароля, стилизованный чекбокс «Чужой ПК» и кнопкой входа.
    Пример: http://www.info-proekt.ru/upload/medialibrary/48a/48aed57ffd6637777074f56b8328cbab.jpg
    Выслать архив с файлами
</p>

<p>
    <h2>MySQL</h2>
    Есть таблица мотоциклов (Название, Снят с производства) и таблица их типов (Название).
    Нужно отобразить все типы и кол-во мотоциклов в каждом типе и учесть, что мотоцикл может быть уже снят с производства.
    Выслать дамп БД и запрос.
</p>

<h2>Решение</h2>

<p>Склонировать репозиторий</p>
<p>Выполнить в корне проекта <code>docker compose up -d</code></p>

<h2>PHP</h2>

<p>Для реалицации использовался паттерн-проектирования итератор</p>
<p>Файловый менеджер <code>http://localhost:8095</code></p>
<p>Путь к файлам PHP <code>file-manager/www/app/src</code></p>

<h2>Вёрстка</h2>

<p>Форма <code>http://localhost:8095/form/auth-form.html</code></p>
<p>Путь к форме <code>file-manager/www/app/form</code></p>

<h2>MySql</h2>
<p>Создание таблиц</p>

<p>Создание таблицы motorbike_type</p>

<code>CREATE TABLE motorbike_type (
id INT AUTO_INCREMENT PRIMARY KEY,
type VARCHAR(255) NOT NULL
);</code>

<p>Создание таблицы motorbike</p>

<code>CREATE TABLE motorbike (
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
discontinued BOOLEAN NOT NULL,
type_id INT,
FOREIGN KEY (type_id) REFERENCES motorbike_type(id)
);</code>

<p>Заполнение таблиц</p>

<code>INSERT INTO motorbike_type (type) VALUES
('Sport'),
('Cruiser'),
('Touring');</code>

<code>INSERT INTO motorbike (title, discontinued, type_id) VALUES
('Motorbike 1', 0, 1),
('Motorbike 2', 0, 2),
('Motorbike 3', 0, 3),
('Motorbike 4', 0, 1),
('Motorbike 5', 1, 2),
('Motorbike 6', 0, 3),
('Motorbike 7', 1, 1),
('Motorbike 8', 0, 2),
('Motorbike 9', 1, 3),
('Motorbike 10', 0, 1),
('Motorbike 11', 0, 2),
('Motorbike 12', 1, 3),
('Motorbike 13', 0, 1),
('Motorbike 14', 0, 2),
('Motorbike 15', 1, 3),
('Motorbike 16', 0, 1),
('Motorbike 17', 0, 2),
('Motorbike 18', 1, 3),
('Motorbike 19', 0, 1),
('Motorbike 20', 0, 2);</code>

<p>Запрос</p>

<code>SELECT
mt.`type`,
count(m.id) as number_of_motorcycles
from motorbike_type mt
LEFT JOIN motorbike m ON mt.id = m.type_id
WHERE m.discontinued != 1
GROUP BY mt.`type`;</code>
