DOCKER_COMPOSE = docker-compose

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