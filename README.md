# Лабораторная работа №8: Тестирование PHP-приложения с использованием PHPUnit и Guzzle

## 👩‍💻 Автор
ФИО: Телегин Степан Сергеевич

Группа: 2ПМ-3

---

## 📌 Описание задания
Цель работы: научиться устанавливать и использовать PHPUnit, писать unit-тесты для классов, использовать mock-объекты, тестировать HTTP-запросы через Guzzle, работать с переменными окружения (.env) и изолировать тестовую среду.

---

## ⚙️ Как запустить проект

1. Клонировать репозиторий:
   ```bash
   git clone https://github.com/Stepan-Telegin/nginx-lab
   cd tests-lab
   ```

2. Создать файл окружения для тестов `.env.test` (в репозитории он не хранится):
   - создать рядом с `composer.json` файл `.env.test`, например с таким содержанием:
   ```env
   DB_HOST=db
   DB_NAME=test_db
   DB_USER=test_user
   DB_PASSWORD=test_pass
   ```

3. Запустить контейнеры:
   ```bash
   docker compose up -d
   ```

4. Установить зависимости Composer:
   ```bash
   docker compose run --rm composer install
   ```

5. Запустить все тесты PHPUnit:
   ```bash
   docker compose run --rm phpunit
   ```
   Внутри контейнера выполняется команда `php vendor/bin/phpunit`.

---

## 📂 Содержимое проекта

```nginx/default.conf``` — конфигурация Nginx для работы с PHP-FPM

```docker-compose.yml``` — сервисы `nginx`, `php`, а также сервисы `composer` и `phpunit` для установки зависимостей и запуска тестов

```www/index.php``` — тестовая страница (возвращает 200 OK)

```www/Registration.php``` — класс (из прошлых лабораторных) для примера unit-тестирования

```tests/ExampleTest.php``` — первый тест PHPUnit (проверка установки/запуска)

```tests/RegistrationTest.php``` — unit-тесты класса `Registration` (в т.ч. с mock PDO) и `setUp()`

```tests/ApiTest.php``` — HTTP-тест через Guzzle (реальный запрос к `http://nginx/index.php`)

```tests/ApiMockTest.php``` — mock HTTP-тест через Guzzle `MockHandler` (без реального запроса)

```tests/bootstrap.php``` — загрузка переменных окружения из `.env.test` в `$_ENV`

```phpunit.xml``` — конфигурация PHPUnit (подключает bootstrap)

```composer.json``` — зависимости проекта (phpunit + guzzle)

---

## ✅ Результат
Добавлены тесты PHPUnit:
- 2 unit-теста для класса: `tests/RegistrationTest.php` (`testAdd`, `testGetAll`) из варианта 15 из прошлых лаб.
- 1 тест с mock: в `tests/RegistrationTest.php` используется mock `PDO` и `PDOStatement`.
- 1 HTTP тест через Guzzle: `tests/ApiTest.php` делает запрос к `http://nginx/index.php`.
- Проверка добавления данных: `RegistrationTest::testAdd()`.
- Проверка получения данных: `RegistrationTest::testGetAll()`.
