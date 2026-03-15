# Тестовое для IT_LINK

## Как деплоить

### Первый раз

- `git clone https://github.com/Gobozzz/testovoe-it-link.git testovoe-goboz` 
- `cd testovoe-goboz`
- `docker compose up -d --build`
- `docker compose exec php bash`
- `composer setup`
- `php artisan key:generate`

### Для остальных

`docker compose up -d`

### env.example -> .env

`cp .env.example .env`

### Laravel App
- URL: http://localhost
