# Лабораторная работа №9: CI/CD для PHP-приложения с использованием GitHub Actions и Docker

## 👩‍💻 Автор
ФИО: Телегин Степан Сергеевич

Группа: 2ПМ-3

---

## 📌 Описание задания
Цель работы: настроить CI/CD pipeline в GitHub Actions для PHP-проекта в Docker, автоматически устанавливать зависимости Composer и запускать тесты PHPUnit, а также продемонстрировать падение pipeline при ошибке в тестах.

---

## ⚙️ Как запустить проект

1. Клонировать репозиторий:
   ```bash
   git clone https://github.com/Stepan-Telegin/tests-lab
   cd tests-lab
   ```

2. (Локально) Создать файл окружения для тестов `.env.test` (в репозитории он не хранится):
   - создать рядом с `composer.json` файл `.env.test`, например с таким содержанием:
   ```env
   DB_HOST=db
   DB_NAME=test_db
   DB_USER=test_user
   DB_PASSWORD=test_pass
   ```

3. Поднять Docker-контейнеры:
   ```bash
   docker compose up -d --build
   ```

4. Установить зависимости Composer (внутри контейнера `php`):
   ```bash
   docker compose exec -T php composer install
   ```

5. Запустить тесты PHPUnit:
   ```bash
   docker compose exec -T php vendor/bin/phpunit tests
   ```

---

## ✅ CI/CD (GitHub Actions)

Workflow находится в файле:
- `.github/workflows/ci.yml`

Pipeline выполняет:
- запуск контейнеров `docker compose up -d --build`
- `composer install`
- запуск тестов `vendor/bin/phpunit tests`
- остановку контейнеров `docker compose down`

Проверка в GitHub:
- вкладка **Actions** → workflow **PHP docker CI**
- есть успешный запуск (зелёный)
- есть запуск с ошибкой при сломанном тесте (красный)
- после исправления теста pipeline снова проходит (зелёный)

---

## 📂 Содержимое проекта

`Dockerfile` — образ PHP (установка расширений, composer для CI)

`docker-compose.yml` — сервисы `nginx` и `php` для запуска проекта и тестов

`.github/workflows/ci.yml` — CI pipeline (GitHub Actions)

`tests/` — тесты PHPUnit (unit-тесты, mock, HTTP-тест через Guzzle)

`composer.json` — зависимости (phpunit + guzzle)

---

## ✅ Результат
- Настроен CI/CD pipeline в GitHub Actions (`.github/workflows/ci.yml`)
- Добавлен запуск `composer install` и `vendor/bin/phpunit tests` в CI
- Pipeline успешно выполняется (зелёный статус)
- На скринах в папке screenshots_for_lab_9 продемонстрировано падение pipeline при ошибке в тесте (красный статус), затем исправление и повторный зелёный запуск
