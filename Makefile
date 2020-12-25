set-ids = USERID=$$(id -u) GROUPID=$$(id -g) OSTYPE=$$(uname)
docker-compose-exec = docker-compose exec -u $$(id -u):$$(id -g)

start:
	@${set-ids} docker-compose up -d

build: do-docker-build

install: do-docker-build start composer-install .env do-craft-init

do-docker-build:
	@${set-ids} docker-compose build --build-arg USERID=$$(id -u) --build-arg GROUPID=$$(id -g)

shell:
	docker-compose exec app /bin/sh

composer-install:
	docker-compose exec app composer install

.env:
	cp .env.dev .env

do-craft-setup:
	@echo "\n=== Craft CMS: Setup project ===\n"
	sleep 3 # we need to wait on the database to become ready. This can be nicer, but I dont know how
	docker-compose exec app ./craft setup

do-craft-init:
	@echo "\n=== Craft CMS: Setup project ===\n"
	sleep 3 # we need to wait on the database to become ready. This can be nicer, but I dont know how
	docker-compose exec app ./craft install/craft \
		--interactive=0 \
		--username="ranonkeltje" \
		--password="ranonkeltje" \
		--email="ranonkeltje@anderwijs.nl" \
		--language="nl-NL"
		--timezone=
