.PHONY: install start stop remove purge validate bash-db bash-php bash-web

install:
	@mkdir -p ./db
	@docker compose up -d --build

start:
	@docker compose start

stop:
	@docker compose stop

remove:
	@docker compose down

purge:
	@docker compose down
	@rm -rf ./db/*

validate:
	@docker compose config

bash-db:
	@docker compose exec db bash

bash-php:
	@docker compose exec php bash

bash-web:
	@docker compose exec web bash
