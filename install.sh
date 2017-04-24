cp config.env.example config.env
docker-compose up -d
docker-compose exec workspace bash
composer install
vendor/bin/doctrine orm:schema-tool:update --force
vendor/bin/doctrine orm:generate-proxies
exit