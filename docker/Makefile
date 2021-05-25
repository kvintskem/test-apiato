#Набор команд/alias для упрощения их запуска на локальной (тестовой) среде
define compose
	docker-compose $1
endef

define recreate-postgres-volume
	docker volume rm pgdata
	docker volume create --name=pgdata
endef

#ждем пока база будет готова к приему соединений
define db-wait
	$(call about,Waiting for Postgres)
	$(call compose, ps)
	$(call compose, exec -T --user postgres postgres bash -c "until pg_isready 2>/dev/null; do sleep 1 ; done")
endef

up:
	docker-compose up -d
ps:
	docker-compose ps
php:
	docker-compose exec php-dev sh

go: up ps php

machine:
	docker-machine start kann

down:
	docker-compose down

restore:
	cat $(path) | docker exec -i docker_postgres_1 psql -U default

migrate:
	docker-compose exec php-dev php artisan migrate

clear: cache-clear config-clear

cache-clear:
	docker-compose exec php-dev php artisan config:cache

config-clear:
	docker-compose exec php-dev php artisan config:clear

pg-volume-create:
	docker volume create --name=pgdata

#пересоздаёт volume с базой
db-recreate:
	$(call about,Recreate database)
	$(call compose,stop postgres)
	$(call compose,rm -f -v postgres)
	$(call recreate-postgres-volume)
	$(call compose,up -d postgres)

#накатывает миграции и запускает seed
db-seed:
	$(call compose,up -d postgres)
	$(call db-wait)
	$(call compose,exec php-dev php artisan migrate)
	$(call compose,exec php-dev php artisan db:seed)
