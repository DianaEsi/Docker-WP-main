# 🚀 Быстрый старт WordPress Docker

## Что включено:

✅ **WordPress** (latest)  
✅ **MySQL 8.0** - база данных  
✅ **phpMyAdmin** - графический интерфейс для БД  
✅ **WP-CLI** - управление WordPress из командной строки  
✅ **Nginx** (в расширенной версии)  
✅ **Redis** (в расширенной версии)  
✅ **Mailhog** (в расширенной версии)  

---

## 📦 Установка за 3 шага:

### 1️⃣ Распакуйте файлы
```bash
unzip wordpress-docker-setup.zip
cd wordpress-docker
```

### 2️⃣ Запустите скрипт установки
```bash
chmod +x setup.sh
./setup.sh
```

### 3️⃣ Откройте браузер
- **WordPress**: http://localhost:8000
- **phpMyAdmin**: http://localhost:8080

---

## 🎯 Альтернативный запуск (без скрипта):

```bash
# 1. Создайте .env из примера
cp .env.example .env

# 2. Отредактируйте пароли в .env
nano .env

# 3. Запустите контейнеры
docker-compose up -d

# 4. Проверьте статус
docker-compose ps
```

---

## 📚 Доступные версии:

### Базовая (рекомендуется для начала):
```bash
docker-compose up -d
```

### Расширенная (с Nginx, Redis, Mailhog):
```bash
docker-compose -f docker-compose.advanced.yml up -d
```
**Дополнительные порты:**
- Mailhog UI: http://localhost:8025
- Redis: localhost:6379

---

## 🛠 Полезные команды (с Makefile):

```bash
make help          # Показать все команды
make up            # Запустить контейнеры
make down          # Остановить контейнеры
make logs          # Показать логи
make backup        # Создать backup БД
make restore       # Восстановить БД
make shell-wp      # Войти в WordPress контейнер
```

---

## 📝 Структура проекта:

```
wordpress-docker/
├── docker-compose.yml              # Основная конфигурация
├── docker-compose.advanced.yml     # Расширенная версия
├── setup.sh                        # Скрипт быстрого старта
├── Makefile                        # Упрощенные команды
├── .env.example                    # Пример переменных окружения
├── .gitignore                      # Git ignore
├── README.md                       # Полная документация
├── COMMANDS_CHEATSHEET.md         # Шпаргалка команд
├── php-config/
│   └── uploads.ini                # PHP настройки
└── nginx-config/
    └── wordpress.conf             # Nginx конфигурация
```

---

## 🔐 Доступы по умолчанию:

### phpMyAdmin:
- **URL**: http://localhost:8080
- **Сервер**: db
- **Логин**: wordpress
- **Пароль**: смотри в `.env` файле

### WordPress:
- **URL**: http://localhost:8000
- Создайте админа при первом входе

---

## 📖 Документация:

- **README.md** - Полная документация со всеми деталями
- **COMMANDS_CHEATSHEET.md** - Шпаргалка всех команд для разработки

---

## ⚠️ Важно для безопасности:

1. ✅ Измените пароли в `.env` файле
2. ✅ Не коммитьте `.env` в git
3. ✅ Для production используйте SSL сертификаты
4. ✅ Отключите DEBUG режим в production

---

## 🆘 Проблемы?

**Порт занят:**
```bash
# Измените порт в docker-compose.yml или .env
ports:
  - "8001:80"  # вместо 8000
```

**Контейнеры не запускаются:**
```bash
docker-compose logs
```

**Начать с чистого листа:**
```bash
docker-compose down -v
rm -rf wordpress/
docker-compose up -d
```

---

## 👥 Для команды разработчиков:

Каждый разработчик должен:
1. Клонировать репозиторий
2. Создать свой `.env` из `.env.example`
3. Запустить `./setup.sh` или `make install`
4. Начать работу в `wordpress/wp-content/themes/` или `plugins/`

---

## 🎓 Полезные ресурсы:

- [WordPress Codex](https://codex.wordpress.org/)
- [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)
- [Docker Documentation](https://docs.docker.com/)

---

**Создано для веб-студии** | Версия 1.0 | 2026
