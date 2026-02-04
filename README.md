# WordPress Development Environment

Профессиональное Docker окружение для разработки WordPress проектов.

## 🚀 Быстрый старт

### Требования
- Docker Engine 20.10+
- Docker Compose 2.0+

### Установка

1. Клонируйте проект:
```bash
git clone <your-repo-url>
cd wordpress-docker
```

2. Создайте .env файл:
```bash
cp .env.example .env
```

3. Отредактируйте `.env` и установите свои пароли:
```bash
nano .env  # или используйте любой редактор
```

4. Запустите контейнеры:
```bash
docker-compose up -d
```

5. Откройте браузер:
- **WordPress**: http://localhost:8000
- **phpMyAdmin**: http://localhost:8080

## 📦 Что включено?

- **WordPress** (latest) - на порту 8000
- **MySQL 8.0** - база данных
- **phpMyAdmin** - на порту 8080
- **WP-CLI** - для управления WordPress через CLI

## 🛠 Основные команды

### Управление контейнерами
```bash
# Запустить все сервисы
docker-compose up -d

# Остановить все сервисы
docker-compose down

# Посмотреть логи
docker-compose logs -f

# Перезапустить
docker-compose restart

# Остановить с удалением volumes (УДАЛИТ ВСЕ ДАННЫЕ!)
docker-compose down -v
```

### Работа с WP-CLI
```bash
# Войти в контейнер WP-CLI
docker-compose exec wpcli bash

# Или выполнить команду напрямую
docker-compose exec wpcli wp --info
docker-compose exec wpcli wp plugin list
docker-compose exec wpcli wp theme list

# Установить плагин
docker-compose exec wpcli wp plugin install contact-form-7 --activate

# Создать пользователя
docker-compose exec wpcli wp user create developer dev@example.com --role=administrator
```

### Работа с базой данных
```bash
# Backup БД
docker-compose exec db mysqldump -u wordpress -pwordpress_password_change_me wordpress > backup.sql

# Restore БД
docker-compose exec -T db mysql -u wordpress -pwordpress_password_change_me wordpress < backup.sql

# Войти в MySQL CLI
docker-compose exec db mysql -u wordpress -pwordpress_password_change_me wordpress
```

### Работа с файлами WordPress
```bash
# Установить права доступа (если нужно)
sudo chown -R www-data:www-data ./wordpress

# Или для разработки (более гибко)
sudo chown -R $USER:www-data ./wordpress
sudo find ./wordpress -type d -exec chmod 755 {} \;
sudo find ./wordpress -type f -exec chmod 644 {} \;
```

## 📁 Структура проекта

```
.
├── docker-compose.yml      # Конфигурация Docker
├── .env                    # Переменные окружения (не в git!)
├── .env.example            # Пример переменных окружения
├── .gitignore             # Git ignore файл
├── php-config/
│   └── uploads.ini        # PHP конфигурация
└── wordpress/             # WordPress файлы (создается автоматически)
    ├── wp-content/        # Ваши темы и плагины здесь
    ├── wp-config.php
    └── ...
```

## 🔧 Настройка для разработки

### Включение Debug режима
Debug режим уже включен по умолчанию. Логи сохраняются в `wordpress/wp-content/debug.log`

### Изменение портов
Отредактируйте `.env` файл или `docker-compose.yml`:
```yaml
ports:
  - "8000:80"  # измените 8000 на нужный порт
```

### Увеличение лимитов PHP
Отредактируйте `php-config/uploads.ini` и перезапустите контейнеры.

## 🔐 Безопасность

**ВАЖНО**: Перед использованием в production:

1. Измените все пароли в `.env`
2. Отключите DEBUG режим
3. Настройте SSL сертификаты
4. Используйте .htaccess для защиты
5. Настройте файрволл
6. Регулярно обновляйте все компоненты

## 🐛 Решение проблем

### Порт уже занят
```bash
# Проверьте, что занимает порт
sudo lsof -i :8000

# Остановите процесс или измените порт в docker-compose.yml
```

### Проблемы с правами доступа
```bash
# Установите правильные права
sudo chown -R $USER:www-data ./wordpress
```

### WordPress не устанавливается
```bash
# Проверьте логи
docker-compose logs wordpress

# Убедитесь что БД запустилась
docker-compose logs db
```

### Очистить все и начать заново
```bash
docker-compose down -v
rm -rf wordpress/
docker-compose up -d
```

## 📚 Полезные ссылки

- [WordPress Codex](https://codex.wordpress.org/)
- [WP-CLI Documentation](https://wp-cli.org/)
- [Docker Documentation](https://docs.docker.com/)
- [phpMyAdmin Documentation](https://docs.phpmyadmin.net/)

## 🤝 Для команды разработчиков

### Workflow для новых разработчиков

1. Получить доступ к репозиторию
2. Клонировать проект
3. Создать .env из .env.example
4. Запустить `docker-compose up -d`
5. Импортировать дамп БД (если есть)
6. Начать разработку в `wordpress/wp-content/`

### Git workflow

```bash
# Не коммитьте в Git:
- wordpress/ (кроме ваших тем/плагинов)
- .env
- db_data/
- *.log

# Коммитьте:
- docker-compose.yml
- .env.example
- php-config/
- README.md
- Ваши кастомные темы из wordpress/wp-content/themes/
- Ваши кастомные плагины из wordpress/wp-content/plugins/
```

## 💡 Советы

- Используйте отдельные .env файлы для каждого проекта
- Регулярно делайте backup БД
- Держите WordPress и плагины обновленными
- Используйте child темы для кастомизации
- Тестируйте на staging перед деплоем в production

## 📞 Поддержка

Если возникли вопросы, обратитесь к тимлиду или создайте issue в репозитории.

---

**Версия**: 1.0  
**Последнее обновление**: 2026
