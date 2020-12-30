set-ids = USERID=$$(id -u) GROUPID=$$(id -g) OSTYPE=$$(uname)
docker-compose-exec = docker-compose exec -u $$(id -u):$$(id -g)

.PHONY: info
info: do-show-commands

# Detect OS
ifeq ($(OS),Windows_NT)
    HOSTFILEPATH := C:/Windows/System32/drivers/etc/hosts
    OSNAME := WINDOWS
else ifdef WSL_DISTRO_NAME
    HOSTFILEPATH := /mnt/c/Windows/System32/drivers/etc/hosts
    OSNAME := WSL
else
    HOSTFILEPATH := /etc/hosts
    UNAME_S := $(shell uname -s)
    ifeq ($(UNAME_S),Linux)
        OSNAME := LINUX
    else ifeq ($(UNAME_S),Darwin)
        OSNAME := MACOSX
    else
        OSNAME := UNKNOWN
    endif
endif

.PHONY: start
start: do-proxy-start do-cms-start do-proxy-connect

.PHONY: stop
stop: do-proxy-stop do-docker-stop

.PHONY: build
build: do-docker-build

.PHONY: install
install: do-docker-build do-setup-hosts-file start composer-install .env do-craft-init do-craft-project-apply

.PHONY: update
update: do-craft-project-apply

.PHONY: frontend
frontend: do-frontend-build

.PHONY: frontend-dev
frontend-dev: do-frontend-dev

shell:
	docker-compose exec cms /bin/sh

composer-install:
	docker-compose exec cms composer install

.env:
	cp cms/.env.dev cms/.env

#--- Docker
do-docker-build:
	@${set-ids} docker-compose build --build-arg USERID=$$(id -u) --build-arg GROUPID=$$(id -g)

do-docker-stop:
	docker-compose down

#--- Proxy
do-proxy-start:
	@echo "\n=== Starting hosts proxy ===\n"
	curl --silent https://gitlab.enrise.com/Enrise/DevProxy/-/raw/master/start.sh | sh

do-proxy-connect:
	@echo "\n=== Connecting to hosts proxy ===\n"
	docker network connect anderwijs enrise-dev-proxy || true

do-proxy-stop:
	@echo "\n=== Stopping hosts proxy ===\n"
	docker container stop enrise-dev-proxy || true

do-proxy-disconnect:
	@echo "\n=== Disconnecting from hosts proxy ===\n"
	docker network disconnect anderwijs enrise-dev-proxy || true

#--- CMS
do-cms-start:
	@${set-ids} docker-compose up -d

do-craft-setup:
	@echo "\n=== Craft CMS: Setup project ===\n"
	sleep 3 # we need to wait on the database to become ready. This can be nicer, but I dont know how
	docker-compose exec cms ./craft setup

do-craft-init:
	@echo "\n=== Craft CMS: Setup project ===\n"
	sleep 3 # we need to wait on the database to become ready. This can be nicer, but I dont know how
	docker-compose exec cms ./craft install/craft \
		--interactive=0 \
		--username="ranonkeltje" \
		--password="ranonkeltje" \
		--email="ranonkeltje@anderwijs.nl" \
		--language="nl-NL"
		--timezone=

do-craft-project-apply:
	docker-compose exec cms ./craft project-config/apply --force

#--- Misc
do-setup-hosts-file:
	@echo "\n=== Adding local hosts ===\n"
	@if [ $(OSNAME) = MACOSX ] && ! grep -q anderwijs.local /etc/hosts; then \
		echo "Copying the contents of dev/hostnames.txt to /etc/hosts..."; \
		sudo bash -c 'cat dev/hostnames.txt >> /etc/hosts'; \
		echo "Done!"; \
		echo ""; \
	fi
	@(cat ${HOSTFILEPATH} | grep -q anderwijs.local \
		&& echo 'No changes: anderwijs.local already available in the hosts file.') \
	|| (docker run --rm \
	 	-v ${HOSTFILEPATH}:/etc/hosts \
	 	-v $$(pwd)/dev/hostnames.txt:/dev/hostnames.txt \
		alpine:latest \
		sh -c 'cat /dev/hostnames.txt >> /etc/hosts' \
		echo "Hosts successfully added")

#--- frontend
do-frontend-build:
	cd frontend && (yarn generate || cd ..)

do-frontend-dev:
	cd frontend && (yarn dev || cd ..)

do-show-commands:
	@echo "\n=== Make commands ===\n"
	@echo "Project commands:"
	@echo "    make install                   Make the project ready for development."
	@echo "\nRun development environment:"
	@echo "    make build                     Build the Docker containers."
	@echo "    make start                     Start the Docker containers."
	@echo "    make stop                      Stop the Docker containers."
	@echo "    make shell                     Open a shell into the CMS Docker"
	@echo "    make frontend                  Builds the frontend"
	@echo "    make serve                     Serves the frontend and recompiles on changes"
