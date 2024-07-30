DOCKER_COMPOSE = docker-compose
args = `arg="$(filter-out $@,$(MAKECMDGOALS))" && echo $${arg:-${1}}`

build:
	$(DOCKER_COMPOSE) build

up:
	$(DOCKER_COMPOSE) up -d

stop:
	$(DOCKER_COMPOSE) stop

down:
	$(DOCKER_COMPOSE) down

ssh:
	docker exec -it laravel bash

composer-install:
	docker exec -it laravel sh -c 'cd /var/www/html && composer install'

get-all-keys:
	docker exec -it redis redis-cli -n 1 KEYS '*'

search-key:
	docker exec -it redis redis-cli -n 1 GET "$(args)"