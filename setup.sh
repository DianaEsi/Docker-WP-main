#!/bin/bash

# Цвета
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${GREEN}"
echo "================================================"
echo "  WordPress Development Environment Setup"
echo "================================================"
echo -e "${NC}"

# Проверка Docker
if ! command -v docker &> /dev/null; then
    echo -e "${RED}❌ Docker не установлен!${NC}"
    echo "Установите Docker: https://docs.docker.com/get-docker/"
    exit 1
fi

# Проверка Docker Compose
if ! command -v docker-compose &> /dev/null; then
    echo -e "${RED}❌ Docker Compose не установлен!${NC}"
    echo "Установите Docker Compose: https://docs.docker.com/compose/install/"
    exit 1
fi

echo -e "${GREEN}✓ Docker установлен${NC}"
echo -e "${GREEN}✓ Docker Compose установлен${NC}"
echo ""

# Создание .env если не существует
if [ ! -f .env ]; then
    echo -e "${YELLOW}Создаю .env файл...${NC}"
    cp .env.example .env
    
    # Генерация случайных паролей
    ROOT_PASS=$(openssl rand -base64 32 | tr -d "=+/" | cut -c1-25)
    WP_PASS=$(openssl rand -base64 32 | tr -d "=+/" | cut -c1-25)
    
    # Замена паролей в .env
    sed -i "s/your_root_password_here/$ROOT_PASS/g" .env
    sed -i "s/your_wordpress_password_here/$WP_PASS/g" .env
    
    echo -e "${GREEN}✓ .env файл создан с безопасными паролями${NC}"
else
    echo -e "${GREEN}✓ .env файл уже существует${NC}"
fi

# Создание необходимых директорий
mkdir -p wordpress php-config backups

echo ""
echo -e "${YELLOW}Запускаю Docker контейнеры...${NC}"
docker-compose up -d

echo ""
echo -e "${GREEN}================================================${NC}"
echo -e "${GREEN}  Установка завершена успешно! 🎉${NC}"
echo -e "${GREEN}================================================${NC}"
echo ""
echo -e "${YELLOW}Доступы:${NC}"
echo -e "  WordPress:   ${GREEN}http://localhost:8000${NC}"
echo -e "  phpMyAdmin:  ${GREEN}http://localhost:8080${NC}"
echo ""
echo -e "${YELLOW}phpMyAdmin логин:${NC}"
echo -e "  Сервер:  ${GREEN}db${NC}"
echo -e "  Логин:   ${GREEN}wordpress${NC}"
echo -e "  Пароль:  ${GREEN}(смотри в .env файле)${NC}"
echo ""
echo -e "${YELLOW}Полезные команды:${NC}"
echo -e "  ${GREEN}make help${NC}          - показать все доступные команды"
echo -e "  ${GREEN}make logs${NC}          - показать логи"
echo -e "  ${GREEN}make down${NC}          - остановить контейнеры"
echo -e "  ${GREEN}make backup${NC}        - создать backup БД"
echo -e "  ${GREEN}docker-compose logs -f${NC} - следить за логами"
echo ""
echo -e "${YELLOW}Дождитесь пока WordPress полностью загрузится (20-30 сек)${NC}"
echo -e "${YELLOW}Затем откройте http://localhost:8000 для установки${NC}"
echo ""
