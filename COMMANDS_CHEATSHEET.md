# Шпаргалка команд для WordPress Docker окружения

## 🚀 Быстрый старт

```bash
# Первый запуск
./setup.sh

# Или вручную
cp .env.example .env
docker-compose up -d
```

## 📦 Docker команды

```bash
# Запуск
docker-compose up -d

# Остановка
docker-compose down

# Перезапуск
docker-compose restart

# Пересборка
docker-compose up -d --build

# Логи
docker-compose logs -f
docker-compose logs -f wordpress
docker-compose logs -f db

# Статус
docker-compose ps

# Очистка (удалит все данные!)
docker-compose down -v
```

## 🛠 WP-CLI команды

```bash
# Информация о WP
docker-compose exec wpcli wp --info

# Плагины
docker-compose exec wpcli wp plugin list
docker-compose exec wpcli wp plugin install <plugin-name> --activate
docker-compose exec wpcli wp plugin update --all
docker-compose exec wpcli wp plugin deactivate <plugin-name>
docker-compose exec wpcli wp plugin delete <plugin-name>

# Темы
docker-compose exec wpcli wp theme list
docker-compose exec wpcli wp theme install <theme-name> --activate
docker-compose exec wpcli wp theme update --all

# Пользователи
docker-compose exec wpcli wp user list
docker-compose exec wpcli wp user create username email@example.com --role=administrator
docker-compose exec wpcli wp user update 1 --user_pass=newpassword

# База данных
docker-compose exec wpcli wp db export
docker-compose exec wpcli wp db import backup.sql
docker-compose exec wpcli wp db optimize
docker-compose exec wpcli wp db repair

# Поиск и замена (например, при смене домена)
docker-compose exec wpcli wp search-replace 'oldsite.com' 'newsite.com'

# Очистка
docker-compose exec wpcli wp cache flush
docker-compose exec wpcli wp transient delete --all

# Регенерация миниатюр
docker-compose exec wpcli wp media regenerate --yes

# Проверка обновлений
docker-compose exec wpcli wp core check-update
docker-compose exec wpcli wp plugin list --update=available
docker-compose exec wpcli wp theme list --update=available
```

## 💾 Работа с базой данных

```bash
# Backup БД
docker-compose exec db mysqldump -u wordpress -pwordpress_password_change_me wordpress > backup_$(date +%Y%m%d).sql

# Restore БД
docker-compose exec -T db mysql -u wordpress -pwordpress_password_change_me wordpress < backup.sql

# Подключение к MySQL CLI
docker-compose exec db mysql -u wordpress -pwordpress_password_change_me wordpress

# Создать новую БД
docker-compose exec db mysql -u root -proot_password_change_me -e "CREATE DATABASE new_db;"

# Удалить БД
docker-compose exec db mysql -u root -proot_password_change_me -e "DROP DATABASE old_db;"
```

## 📁 Работа с файлами

```bash
# Копировать файлы в контейнер
docker cp local_file.php wordpress_app:/var/www/html/

# Копировать из контейнера
docker cp wordpress_app:/var/www/html/file.php ./

# Права доступа
sudo chown -R $USER:www-data ./wordpress
sudo find ./wordpress -type d -exec chmod 755 {} \;
sudo find ./wordpress -type f -exec chmod 644 {} \;

# Войти в bash контейнера
docker-compose exec wordpress bash
docker-compose exec wpcli bash
```

## 🔍 Отладка и логи

```bash
# Все логи
docker-compose logs -f

# Логи WordPress
docker-compose logs -f wordpress

# Логи MySQL
docker-compose logs -f db

# Debug лог WordPress
tail -f wordpress/wp-content/debug.log

# Логи Nginx (если используется advanced версия)
docker-compose exec nginx tail -f /var/log/nginx/access.log
docker-compose exec nginx tail -f /var/log/nginx/error.log
```

## 🔧 Полезные WP-CLI команды для разработки

```bash
# Создать тестовый контент
docker-compose exec wpcli wp post generate --count=10
docker-compose exec wpcli wp user generate --count=5

# Активировать режим обслуживания
docker-compose exec wpcli wp maintenance-mode activate

# Деактивировать режим обслуживания
docker-compose exec wpcli wp maintenance-mode deactivate

# Проверить файлы WordPress на изменения
docker-compose exec wpcli wp core verify-checksums

# Список всех настроек
docker-compose exec wpcli wp option list

# Изменить URL сайта
docker-compose exec wpcli wp option update home 'http://localhost:8000'
docker-compose exec wpcli wp option update siteurl 'http://localhost:8000'

# Сбросить пароль администратора
docker-compose exec wpcli wp user update 1 --user_pass=newpassword
```

## 📊 Мониторинг и производительность

```bash
# Размер БД
docker-compose exec db mysql -u wordpress -pwordpress_password_change_me wordpress -e "
SELECT 
    table_schema AS 'Database',
    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS 'Size (MB)'
FROM information_schema.tables 
WHERE table_schema = 'wordpress'
GROUP BY table_schema;"

# Использование ресурсов
docker stats

# Место на диске
docker system df
```

## 🔐 Безопасность

```bash
# Изменить соли и ключи WordPress
docker-compose exec wpcli wp config shuffle-salts

# Сканирование плагинов на известные уязвимости (требует установки WP-CLI пакета)
docker-compose exec wpcli wp package install git@github.com:10up/wp-vulnerability-scanner.git

# Проверка прав доступа
docker-compose exec wordpress find /var/www/html -type f -perm 777
docker-compose exec wordpress find /var/www/html -type d -perm 777
```

## 🧪 Тестирование

```bash
# Проверить PHP синтаксис в теме
docker-compose exec wordpress find /var/www/html/wp-content/themes/your-theme -name "*.php" -exec php -l {} \;

# Запустить PHP-тесты (если настроены)
docker-compose exec wordpress vendor/bin/phpunit

# Проверить битые ссылки
docker-compose exec wpcli wp broken-link-checker run
```

## 🌐 Работа с доменами (для staging/production)

```bash
# Изменить домен во всей БД
docker-compose exec wpcli wp search-replace 'http://oldsite.com' 'https://newsite.com' --dry-run
docker-compose exec wpcli wp search-replace 'http://oldsite.com' 'https://newsite.com'

# Очистить кэш после смены домена
docker-compose exec wpcli wp cache flush
docker-compose exec wpcli wp rewrite flush
```

## 📦 Установка популярных плагинов

```bash
# SEO
docker-compose exec wpcli wp plugin install wordpress-seo --activate

# Безопасность
docker-compose exec wpcli wp plugin install wordfence --activate

# Производительность
docker-compose exec wpcli wp plugin install wp-super-cache --activate
docker-compose exec wpcli wp plugin install autoptimize --activate

# Формы
docker-compose exec wpcli wp plugin install contact-form-7 --activate

# Backup
docker-compose exec wpcli wp plugin install updraftplus --activate

# Для разработки
docker-compose exec wpcli wp plugin install query-monitor --activate
docker-compose exec wpcli wp plugin install debug-bar --activate
```

## 🚨 Решение проблем

```bash
# WordPress показывает ошибку БД
docker-compose restart db wordpress

# Сбросить права доступа
sudo chown -R www-data:www-data ./wordpress
# Или для разработки:
sudo chown -R $USER:www-data ./wordpress

# Очистить все кэши
docker-compose exec wpcli wp cache flush
docker-compose exec wpcli wp transient delete --all
docker-compose exec redis redis-cli FLUSHALL  # если используется Redis

# Починить таблицы БД
docker-compose exec wpcli wp db repair

# Переиндексация
docker-compose exec wpcli wp rewrite flush

# Полная очистка и переустановка
docker-compose down -v
rm -rf wordpress/
docker-compose up -d
```

## 📌 Make команды (если используется Makefile)

```bash
make help          # Показать все команды
make up            # Запустить
make down          # Остановить
make logs          # Показать логи
make backup        # Backup БД
make restore       # Восстановить БД
make clean         # Полная очистка
make permissions   # Исправить права доступа
```

## 💡 Советы для команды

1. Всегда делайте backup перед обновлениями
2. Используйте WP-CLI для массовых операций
3. Тестируйте плагины на локальной копии
4. Храните .env в безопасности (не коммитьте в git!)
5. Регулярно обновляйте WordPress и плагины
6. Используйте child темы для кастомизации
7. Включайте Query Monitor для отладки производительности
