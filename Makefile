.PHONY: up do ex

SHELL = /bin/sh

CURRENT_UID := $(shell id -u)
CURRENT_GID := $(shell id -g)

export CURRENT_UID
export CURRENT_GID

rebuild:
	docker build --no-cache -t ulco-marsrover-bdd .

build:
	docker build -t ulco-marsrover-bdd .

up:
	docker run -it -d --env-file ./docker/xdebug.env --name ulco-marsrover-bdd -v ${CURDIR}:/app -v ${CURDIR}/docker/xdebug.ini:/usr/local/etc/php/conf.d/docker-php-ext-xdebug-20.ini:ro -w=/app ulco-marsrover-bdd
	docker exec -it ulco-marsrover-bdd sh ./docker/setup-xdebug.sh
	docker exec -it ulco-marsrover-bdd composer install

do:
	docker rm -vf ulco-marsrover-bdd

ex:
	docker exec -u $(CURRENT_UID):$(CURRENT_GID) -it ulco-marsrover-bdd sh
