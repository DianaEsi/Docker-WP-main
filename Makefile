.PHONY: help up down restart logs clean install backup restore

# Цвета для вывода
GREEN  := \033[0;32m
YELLOW := \033[0;33m
NC     := \033[0m # No Color

help: ## Показать помощь
	@echo "$(GREEN)WordPress Docker Environment - Команды:$(NC)"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "  $(YELLOW)%-15s$(NC) %s\n", $$1, $$2}'

up: ## Запустить все контейнеры
	@echo "$(GREEN)Запуск контейнеров...$(NC)"
	docker-compose up -d
	@echo "$(GREEN)WordPress доступен на http://localhost:8000$(NC)"
	@echo "$(GREEN)phpMyAdmin доступен на http://localhost:8080$(NC)"

down: ## Остановить все контейнеры
	@echo "$(YELLOW)Остановка контейнеров...$(NC)"
	docker-compose down

restart: ## Перезапустить все контейнеры
	@echo "$(YELLOW)Перезапуск контейнеров...$(NC)"
	docker-compose restart

logs: ## Показать логи
	docker-compose logs -f

logs-wp: ## Показать логи WordPress
	docker-compose logs -f wordpress

logs-db: ## Показать логи MySQL
	docker-compose logs -f db

shell-wp: ## Войти в контейнер WordPress
	docker-compose exec wordpress bash

shell-cli: ## Войти в WP-CLI контейнер
	docker-compose exec wpcli bash

shell-db: ## Войти в MySQL CLI
	docker-compose exec db mysql -u wordpress -p

clean: ## Удалить все контейнеры и volumes (ВНИМАНИЕ: удалит все данные!)
	@echo "$(YELLOW)ВНИМАНИЕ: Это удалит все данные!$(NC)"
	@read -p "Вы уверены? [y/N] " -n 1 -r; \
	echo; \
	if [[ $$REPLY =~ ^[Yy]$$ ]]; then \
		docker-compose down -v; \
		rm -rf wordpress/; \
		echo "$(GREEN)Очистка завершена$(NC)"; \
	fi

install: ## Первичная установка
	@echo "$(GREEN)Установка окружения...$(NC)"
	@if [ ! -f .env ]; then \
		cp .env.example .env; \
		echo "$(YELLOW)Создан .env файл. Отредактируйте пароли!$(NC)"; \
	fi
	@mkdir -p wordpress php-config
	docker-compose up -d
	@echo "$(GREEN)Установка завершена!$(NC)"
	@echo "$(GREEN)WordPress: http://localhost:8000$(NC)"
	@echo "$(GREEN)phpMyAdmin: http://localhost:8080$(NC)"

backup: ## Создать backup базы данных
	@echo "$(GREEN)Создание backup...$(NC)"
	@mkdir -p backups
	docker-compose exec db mysqldump -u wordpress -pwordpress_password_change_me wordpress > backups/backup_$$(date +%Y%m%d_%H%M%S).sql
	@echo "$(GREEN)Backup создан в папке backups/$(NC)"

restore: ## Восстановить последний backup (или укажите файл: make restore FILE=backup.sql)
	@if [ -z "$(FILE)" ]; then \
		FILE=$$(ls -t backups/*.sql | head -1); \
	else \
		FILE=$(FILE); \
	fi; \
	echo "$(GREEN)Восстановление из $$FILE...$(NC)"; \
	docker-compose exec -T db mysql -u wordpress -pwordpress_password_change_me wordpress < $$FILE; \
	echo "$(GREEN)Восстановление завершено$(NC)"

ps: ## Показать статус контейнеров
	docker-compose ps

pull: ## Обновить Docker образы
	docker-compose pull

rebuild: ## Пересобрать и перезапустить контейнеры
	docker-compose up -d --build

permissions: ## Исправить права доступа на файлы WordPress
	@echo "$(GREEN)Установка прав доступа...$(NC)"
	sudo chown -R $$USER:www-data ./wordpress
	sudo find ./wordpress -type d -exec chmod 755 {} \;
	sudo find ./wordpress -type f -exec chmod 644 {} \;
	@echo "$(GREEN)Права установлены$(NC)"

# WP-CLI команды
wp-info: ## WP-CLI информация
	docker-compose exec wpcli wp --info

wp-plugins: ## Список плагинов
	docker-compose exec wpcli wp plugin list

wp-themes: ## Список тем
	docker-compose exec wpcli wp theme list

wp-users: ## Список пользователей
	docker-compose exec wpcli wp user list

# Установка популярных плагинов для разработки
dev-plugins: ## Установить полезные плагины для разработки
	@echo "$(GREEN)Установка плагинов для разработки...$(NC)"
	docker-compose exec wpcli wp plugin install query-monitor --activate
	docker-compose exec wpcli wp plugin install debug-bar --activate
	docker-compose exec wpcli wp plugin install regenerate-thumbnails --activate
	@echo "$(GREEN)Плагины установлены$(NC)"
